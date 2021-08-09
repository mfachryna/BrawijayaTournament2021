<?php

namespace App\Http\Controllers;

use App\Official;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class OfficialController extends Controller
{
    public function create(Request $request)
    {

        try {
            $data = $request->all();


            $this->validate($request, [
                'team_id' => 'bail|required',
                // 'nim' => 'bail|required',
                'handphone' => 'bail|required',
                'email' => 'bail|required',
                'nama' => 'bail|required',

                'avatar' => 'bail|required',
                'ktm' => 'bail|required',

            ]);

            Official::create($data);

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
        // $id = Auth::user()->id;
        // $type = $request->input('type');
        // if (isset($type) && isset($id)) {
        //     $item = Player::with(['players', 'officials'])->where('created_by', $id)->where('type', $type)->first();
        //     return $item;
        // } else {
        //     $item = Competition::where('created_by', $id)->get();
        //     return $item;
        // }
    }

    public function update(Request $request, $id)
    {
        try {
            $data = $request->all();


            $item = Official::findOrFail($id);
            $item->update($data);

            return response()->json([
                'status' => 'success'
            ]);
        } catch (ValidationException $th) {

            return response()->json([
                'status' => 'error',
                'error' => $th->errors()
            ], 423);
        }
    }

    public function delete($id)
    {
        Official::destroy($id);
        return response()->json([
            'status' => 'success'
        ]);
    }
}
