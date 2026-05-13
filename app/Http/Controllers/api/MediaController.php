<?php

namespace App\Http\Controllers\api;

use App\Models\Media;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MediaController extends Controller
{
    public function index()
    {
        $medias = Media::orderBy('id', 'desc')->get();
        return response()->json([
            'medias' => $medias
        ],200);
    }

    public function store(Request $request)
    {
        $media = new Media();
        $media->link = $request->link;
        $media->icon = $request->icon;
        $media->save();
    }

    public function destroy($id)
    {
        $media = Media::find($id);
        $media->delete();
    }
}