<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Album;
use App\Models\Image;
use Auth;

class ImagesController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }

    public function view_album_images($album_id){
        $user = Auth::user();
        $uid = $user->uid;
        $album = Auth::user()->albums->find($album_id);
        $images = $album->images;

        return view('album_images', compact('album','images','uid'));
    }

    public function store_images(Request $request, $album_id){
        $user = Auth::user();
        $uid = $user->uid;

        $album = Auth::user()->albums->find($album_id);
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $imageName = time();
        $ext = $request->image->extension();
        $request->image->move(public_path('usres/'.$uid.'/albums/'.$album->id), $imageName.'.'.$ext);
        
        $album->img_count = $album->img_count + 1;

        Image::create([
            "name" => $imageName,
            "ext" => $ext,
            "album_id" => $album->id,
        ]);

        $album->save();
        return response()->json(['success'=>$imageName.'.'.$ext]);
    }

    public function delete_image(Request $request, $album_id){
        $user = Auth::user();
        $uid = $user->uid;
        $album = $user->albums->find($album_id);

        $image = $album->images->where('name',$request->img_name)->firstOrFail();

        $path = public_path('usres/'.$uid.'/albums/'.$album->id . '/' . $image->name.'.'.$image->ext);
        if (file_exists($path)) {
            unlink($path);
        }
        $image->delete();

        $album->img_count = $album->img_count - 1;
        $album->save();
        return 'success!';  

    }
}
