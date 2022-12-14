<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Album;
use App\Models\Image;
use App\Models\User;
use Illuminate\Support\Facades\Storage;

class PublicController extends Controller
{
  public function get_public_image(Request $request, $album_id, $file_name){
    $album = Album::findOrFail($album_id);
    $file_ext = pathinfo($file_name)['extension'];
    $image_name = pathinfo($file_name)['filename'];
    $image = Image::where('name',$image_name)
      ->where('ext',$file_ext)
      ->where('token',$request->token)
      ->where('is_public',1)
      ->firstOrFail();

    $u_id = $album->user_id;
    $user = User::findOrFail($u_id);

    $path = 'users/'.$user->uid.'/albums/'.$album_id . '/' . $image->name . '.' . $image->ext;

    if(Storage::exists($path)){
      return Storage::response($path);
    }else{
      abort(404);
    }
  }
}