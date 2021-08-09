<?php

namespace App\Http\Controllers;

use App\Announcement;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Str;

class AnnouncementController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $status = $request->input('status');
            if (isset($status)) {
                return Announcement::where('status', 'publish')->orderBy('updated_at', 'DESC')->get();
            }
            return Announcement::orderBy('posted_on', 'DESC')->get();
        }
        return abort(403);
    }

    public function show(Request $request, $id)
    {
        if ($request->ajax()) {
            return Announcement::findOrFail($id);
        }
        return abort(403);
    }

    public function slug($slug)
    {
        return Announcement::where('slug', $slug)->first();
    }

    public function create(Request $request)
    {
        try {
            $data = $request->all();
            return Announcement::create($data);
        } catch (ValidationException $th) {
            return response()->json([
                'status' => 'error',
                'errors' => $th->errors()
            ]);
        }
    }

    public function update(Request $request, $id)
    {
        $data = $request->all();
        $status = $request->input('status');



        $item = Announcement::findOrFail($id);

        if (isset($status) && $status == 'publish') {
            $data['posted_on'] = \Carbon\Carbon::now()->toDateString();
            $data['slug'] =  Str::slug($item['id'] . " " . $item['title']);
        }

        $item->update($data);

        return response()->json([
            'announcement' => $item
        ]);
    }

    public function delete($id)
    {
        return Announcement::destroy($id);
    }
}
