<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ImageController extends Controller
{
    public function upload_images(Request $request)
    {
        $this->validate($request, [
            'image' => 'bail|required|image'
        ]);
        $image = $request->file('image')->store('/assets/images', 'public');

        if ($image) {
            return response()->json([
                'success' => 1,
                'file' => [
                    'url' => '/storage/' . $image
                ]
            ]);
        }

        return response()->json([
            'success' => 0,
            'file' => [
                'url' => '0'
            ]
        ]);
    }
    public function upload_image_byurl(Request $request)
    {
        return response()->json([
            'success' => 1,
            'file' => [
                'url' => $request->input('image')
            ]
        ]);
    }

    public function delete_images(Request $request)
    {
        $filename = $request->input('filename');

        $filepath = public_path() . $filename;

        $res = false;

        if (file_exists($filepath)) {
            @unlink($filepath);
            $res = true;
        }

        return response()->json([
            'status' => $res,

        ]);
    }
}
