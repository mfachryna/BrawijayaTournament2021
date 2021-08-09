<?php

namespace App\Http\Controllers;

use App\Gallery;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class GalleryController extends Controller
{
    public function index(Request $request)
    {
        return Gallery::all();
    }

    public function create(Request $request)
    {
        try {
            $this->validate($request, [
                'title' => 'bail|required',
                'url' => 'bail|required',
            ]);
            $data = $request->all();
            return Gallery::create($data);
        } catch (ValidationException $th) {
            return response()->json([
                'status' => 'error',
                'errors' => $th->errors()
            ]);
        }
    }

    public function delete($id)
    {
        return Gallery::destroy($id);
    }
}
