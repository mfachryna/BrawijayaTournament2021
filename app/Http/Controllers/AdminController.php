<?php

namespace App\Http\Controllers;

use App\Competition;
use App\MobileLegend;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class AdminController extends Controller
{

    public function index(Request $request)
    {
        $type = $request->input('type');
        $verify = $request->input('verify');

        if ($request->ajax()) {
            if (isset($type) && isset($verify)) {
                if ($verify == 1) {
                    return Competition::whereNotNull('team_verified_at')->where('type', $type)
                        ->where('status', 'sended')->orderBy('team_verified_at', 'desc')->get();
                } else {
                    return Competition::whereNull('team_verified_at')->where('type', $type)
                        ->where('status', 'sended')->orderBy('updated_at', 'asc')->get();
                }
            } elseif (isset($type)) {
                return Competition::where('type', $type)->where('status', 'sended')->orderBy('updated_at', 'asc')->get();
            } else {
                return Competition::all();
            }
        }
        return redirect('/');
    }

    public function countCompetition(Request $request)
    {

        return DB::table('competitions')
            ->select('type', DB::raw('count(*) as total'),  DB::raw('count(team_verified_at) as verified'))->where('status', 'sended')
            ->groupBy('type')
            ->get();
    }

    public function update(Request $request, $id)
    {
        try {
            $data = $request->all();
            if ($request->ajax()) {


                $item = Competition::findOrFail($id);
                if (isset($data['team_verified_at'])) {
                    $data['team_verified_at'] = \Carbon\Carbon::now();
                    $data['status'] = 'sended';
                }
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

    public function show($id)
    {
        return Competition::with(['players', 'officials'])->findOrFail($id);
    }
}
