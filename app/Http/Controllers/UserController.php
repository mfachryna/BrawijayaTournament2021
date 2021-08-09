<?php

namespace App\Http\Controllers;

use App\MobileLegend;
use App\MobileLegendPlayer;
use App\Official;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class UserController extends Controller
{
    public function upload_pembayaran(Request $request)
    {
        $this->validate($request, [
            'file' => 'bail|required|image'
        ]);
        $image = $request->file('file')->store('/assets/pembayaran', 'public');

        if ($image) {
            return response()->json([
                'url' => '/storage/' . $image
            ]);
        }
        return response()->json([
            'status' => false
        ], 403);
    }

    public function delete_pembayaran(Request $request)
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

    public function upload_lampiran(Request $request)
    {
        $this->validate($request, [
            'file' => 'bail|required'
        ]);
        $image = $request->file('file')->store('/assets/lampiran', 'public');

        if ($image) {
            return response()->json([
                'url' => '/storage/' . $image
            ]);
        }
        return response()->json([
            'status' => false
        ], 403);
    }

    public function delete_lampiran(Request $request)
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

    public function upload_avatar(Request $request)
    {
        $this->validate($request, [
            'file' => 'bail|required|image'
        ]);
        $image = $request->file('file')->store('/assets/avatar', 'public');

        if ($image) {
            return response()->json([
                'url' => '/storage/' . $image
            ]);
        }
        return response()->json([
            'status' => false
        ], 403);
    }

    public function delete_avatar(Request $request)
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

    public function upload_ktm(Request $request)
    {
        $this->validate($request, [
            'file' => 'bail|required|image'
        ]);
        $image = $request->file('file')->store('/assets/ktm', 'public');

        if ($image) {
            return response()->json([
                'url' => '/storage/' . $image
            ]);
        }
        return response()->json([
            'status' => false
        ], 403);
    }

    public function delete_ktm(Request $request)
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

    public function upload_krs(Request $request)
    {
        $this->validate($request, [
            'file' => 'bail|required|image'
        ]);
        $image = $request->file('file')->store('/assets/krs', 'public');

        if ($image) {
            return response()->json([
                'url' => '/storage/' . $image
            ]);
        }
        return response()->json([
            'status' => false
        ], 403);
    }

    public function delete_krs(Request $request)
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
