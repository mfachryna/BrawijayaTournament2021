<?php

namespace App\Http\Controllers;

use App\Competition;
use App\Official;
use App\Player;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class CompetitionController extends Controller
{
    public function create(Request $request)
    {
        $id = Auth::user()->id;

        try {
            $data = $request->all();
            $data['created_by'] = $id;

            $this->validate($request, [
                'type' => 'bail|required'
            ]);

            Competition::create($data);

            return response()->json([
                'status' => 'success'
            ]);
        } catch (ValidationException $th) {
            return response()->json([
                'status' => 'error',
                'errors' => $th->errors()
            ], 423);
        }
    }

    public function show(Request $request)
    {
        $id = Auth::user()->id;
        if ($request->ajax()) {
            $type = $request->input('type');
            if (isset($type) && isset($id)) {
                $item = Competition::with(['players', 'officials'])->where('created_by', $id)->where('type', $type)->first();
                return $item;
            } else {
                $item = Competition::where('created_by', $id)->get();
                return $item;
            }
        }
        return redirect('/');
    }

    public function update(Request $request, $id)
    {
        try {
            $data = $request->all();
            if ($request->ajax()) {
                $item = Competition::findOrFail($id);

                $item->update($data);

                return response()->json([
                    'status' => 'success'
                ]);
            }
            return redirect('/');
        } catch (ValidationException $th) {

            return response()->json([
                'status' => 'error',
                'error' => $th->errors()
            ], 423);
        }
    }

    public function delete($id)
    {
        $user_id = Auth::user()->id;

        if (Competition::where('created_by', $user_id)->where('id', $id)->delete()) {
            Player::where('team_id', $id)->delete();
            Official::where('team_id', $id)->delete();
        }

        return response()->json([
            'status' => 'success'
        ]);
    }
}
