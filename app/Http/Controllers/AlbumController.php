<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Album;
use App\Models\Image;
use Auth;
use File;

class AlbumController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }

    public function view_albums(){
        $albums = Auth::user()->albums;

        return view('dashboard', compact('albums'));
    }

    public function new_album(Request $request){
        $request->validate([
            'album_name' => 'required|string|min:2|max:50',
        ]);

        $user = Auth::user();

        Album::create([
            "name" => $request->album_name,
            "user_id" => $user->id,
            "img_count" => 0,
        ]);

        return ('success!');
    }

    public function set_album_data(Request $request, $album_id){
        $request->validate([
            'album_name' => 'required|string|min:2|max:50',
        ]);

        $user = Auth::user();
        
        $album = Auth::user()->albums->find($album_id);

        $album->name = $request->album_name;

        $album->save();
        return 'success!';
    }

    public function delete_album_and_images($album_id){
        $uid = Auth::user()->uid;
        $album = Auth::user()->albums->find($album_id);

        File::deleteDirectory(public_path('users/'.$uid.'/albums/'.$album->id));

        $images = Image::where('album_id',$album_id);
        $images->delete();
        $album->delete();
        return 'success!';
    }

    public function delete_album_and_transfer_images(Request $request, $album_id){
        $uid = Auth::user()->uid;
        $album = Auth::user()->albums->find($album_id);
        $another_album = Auth::user()->albums->find($request->another_album_id);

        $images = Image::where('album_id',$album_id)->orderby('id', 'desc')->paginate(999);

        if (!file_exists('users/'.$uid.'/albums/'.$request->another_album_id)) {
            File::makeDirectory('users/'.$uid.'/albums/'.$request->another_album_id, $mode = 0777, true, true);
        }

        foreach($images as $image){
            $sourcePath = public_path('users/'.$uid.'/albums/'.$album->id . '/' . $image->name.'.'.$image->ext);
            $destinationPath = public_path('users/'.$uid.'/albums/'.$request->another_album_id . '/' . $image->name.'.'.$image->ext);
         
            if (!file_exists($destinationPath)) {
                File::move($sourcePath,$destinationPath);
            }
            $image->album_id = $request->another_album_id;
            $another_album->img_count += 1;
            $image->save();
            $another_album->save();
        }

        File::deleteDirectory(public_path('users/'.$uid.'/albums/'.$album->id));

        $album->delete();

        return 'success!';
    }
}
