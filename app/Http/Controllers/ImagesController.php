<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Image;
use Auth;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\keyGenerator;

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

        $ext = $request->image->extension();
        $imageName = str_replace('.'.$ext,'',$request->image->getClientOriginalName());
        $request->image->move(storage_path('app/users/'.$uid.'/albums/'.$album->id), $imageName.'.'.$ext);
        
        $album->img_count = $album->img_count + 1;
        $token = keyGenerator::key(21);

        Image::create([
            "name" => $imageName,
            "ext" => $ext,
            "album_id" => $album->id,
            "token" => $token,
            "is_public" => 0,
        ]);

        $album->save();
        return response()->json([
            'name' => $imageName,
            'ext' => $ext,
            'token' => $token,
        ]);
    }

    public function update_image(Request $request, $album_id, $img_name){
        $user = Auth::user();
        $uid = $user->uid;
        $album = $user->albums->find($album_id);

        $image = $album->images->where('name',$img_name)->firstOrFail();
        $old_name = $image->name;

        $path = storage_path('app/users/'.$uid.'/albums/'.$album->id . '/' . $image->name.'.'.$image->ext);
        if (file_exists($path)) {
            rename($path, storage_path('app/users/'.$uid.'/albums/'.$album->id . '/' . $request->new_img_name.'.'.$image->ext));
        }

        $image->name = $request->new_img_name;
        $image->is_public = $request->is_public;
        $image->save();

        return response()->json([
            'old_name' => $old_name,
            'new_name' => $request->new_img_name,
            'ext' => $image->ext,
            'token' => $image->token,
            'is_public' => $request->is_public,
        ]);
    }

    public function get_private_image($user_uid, $album_id, $file_name){
        $user = Auth::user();
        $uid = $user->uid;
        
        $path = 'users/'.$uid.'/albums/'.$album_id . '/' . $file_name;
        if(Storage::exists($path)){
            return Storage::response($path);
        }else{
            abort(404);
        }
    }

    public function reset_img_token($album_id, $img_name){
        $user = Auth::user();
        $uid = $user->uid;
        $album = $user->albums->find($album_id);

        $image = $album->images->where('name',$img_name)->firstOrFail();
        $token = keyGenerator::key(21);

        $image->token = $token;
        $image->save();

        return response()->json([
            'token' => $token
        ]);
    }

    public function delete_image(Request $request, $album_id){
        $user = Auth::user();
        $uid = $user->uid;
        $album = $user->albums->find($album_id);

        $image = $album->images->where('name',$request->img_name)->firstOrFail();

        $path = storage_path('app/users/'.$uid.'/albums/'.$album->id . '/' . $image->name.'.'.$image->ext);
        if (file_exists($path)) {
            unlink($path);
        }
        $image->delete();

        $album->img_count = $album->img_count - 1;
        $album->save();
        return 'success!';  

    }
}
