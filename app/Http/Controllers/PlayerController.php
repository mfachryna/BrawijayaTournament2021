<?php

namespace App\Http\Controllers;

use App\Player;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class PlayerController extends Controller
{
    public function create(Request $request)
    {

        try {
            $data = $request->all();


            $this->validate($request, [
                'team_id' => 'bail|required',
                'competition_name' => 'bail|required',
                'nim' => 'bail|required',
                'nim' => 'bail|required',
                'nama' => 'bail|required',
                'faculty' => 'bail|required',

                'avatar' => 'bail|required',
                'ktm' => 'bail|required',
                'krs' => 'bail|required',
            ]);

            if ($data['competition_name'] == 'ml') {
                if (Player::where('nim', $data['nim'])->where('competition_name', 'pubg')->first()) {
                    // Ada player yg mendaftar ML dan PUBG
                    return response()->json([
                        'status' => 'error',
                        'errors' => 'Player telah mendaftar di cabang lomba PUBG'
                    ], 420);
                } elseif (Player::where('nim', $data['nim'])->where('competition_name', 'catur')->first()) {
                    // Ada player yg mendaftar ML dan CATUR
                    return response()->json([
                        'status' => 'error',
                        'errors' => 'Player telah mendaftar di cabang lomba CATUR'
                    ], 420);
                }
            } elseif ($data['competition_name']  == 'pubg') {
                if (Player::where('nim', $data['nim'])->where('competition_name', 'ml')->first()) {
                    // Ada player yg mendaftar PUBG dan ML
                    return response()->json([
                        'status' => 'error',
                        'errors' => 'Player telah mendaftar di cabang lomba Mobile Legends'
                    ], 420);
                }
            } elseif ($data['competition_name']  == 'catur') {
                if (Player::where('nim', $data['nim'])->where('competition_name', 'ml')->first()) {
                    // Ada player yg mendaftar CATUR dan ML
                    return response()->json([
                        'status' => 'error',
                        'errors' => 'Player telah mendaftar di cabang lomba Mobile Legends'
                    ], 420);
                }
            }

            Player::create($data);

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

            $item = Player::findOrFail($id);

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
        Player::destroy($id);
        return response()->json([
            'status' => 'success'
        ]);
    }
}
