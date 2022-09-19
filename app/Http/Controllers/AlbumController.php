<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Album;
use Auth;

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

        // if(!$album)abort(404);

        $album->name = $request->album_name;

        $album->save();
        return 'success!';
    }
}
