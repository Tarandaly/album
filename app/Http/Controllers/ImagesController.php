<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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
        function generateRandomString($length = 10) {
            $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $charactersLength = strlen($characters);
            $randomString = '';
            for ($i = 0; $i < $length; $i++) {
                $randomString .= $characters[rand(0, $charactersLength - 1)];
            }
            return $randomString;
        }
        $user = Auth::user();
        $uid = $user->uid;

        $album = Auth::user()->albums->find($album_id);
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $imageName = generateRandomString(9);
        $ext = $request->image->extension();
        $request->image->move(public_path('users/'.$uid.'/albums/'.$album->id), $imageName.'.'.$ext);
        
        $album->img_count = $album->img_count + 1;

        Image::create([
            "name" => $imageName,
            "ext" => $ext,
            "album_id" => $album->id,
        ]);

        $album->save();
        return response()->json([
            'name'=>$imageName,
            'ext'=>$ext,
        ]);
    }

    public function update_image(Request $request, $album_id, $img_name, $img_ext){
        $user = Auth::user();
        $uid = $user->uid;
        $album = $user->albums->find($album_id);

        $image = $album->images->where('name',$img_name)->firstOrFail();
        $old_name = $image->name;
        $path = public_path('users/'.$uid.'/albums/'.$album->id . '/' . $image->name.'.'.$image->ext);
        if (file_exists($path)) {
            rename($path, public_path('users/'.$uid.'/albums/'.$album->id . '/' . $request->new_img_name.'.'.$image->ext));
        }

        $image->name = $request->new_img_name;
        $image->save();

        return response()->json([
            'old_name' => $old_name,
            'new_name' => $request->new_img_name,
            'ext' => $image->ext,
        ]);
    }

    public function delete_image(Request $request, $album_id){
        $user = Auth::user();
        $uid = $user->uid;
        $album = $user->albums->find($album_id);

        $image = $album->images->where('name',$request->img_name)->firstOrFail();

        $path = public_path('users/'.$uid.'/albums/'.$album->id . '/' . $image->name.'.'.$image->ext);
        if (file_exists($path)) {
            unlink($path);
        }
        $image->delete();

        $album->img_count = $album->img_count - 1;
        $album->save();
        return 'success!';  

    }
}
