<?php

namespace App\Http\Controllers;

use App\Jadwal;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class JadwalController extends Controller
{
    public function index(Request $request)
    {

        return Jadwal::orderBy('tanggal', 'asc')->get();
    }

    public function create(Request $request)
    {
        try {
            $this->validate($request, [
                'judul' => 'bail|required',
                'lomba' => 'bail|required',
                'tanggal' => 'bail|required|date',
            ]);
            $data = $request->all();
            return Jadwal::create($data);
        } catch (ValidationException $th) {
            return response()->json([
                'status' => 'error',
                'errors' => $th->errors()
            ]);
        }
    }

    public function delete($id)
    {
        return Jadwal::destroy($id);
    }
}
