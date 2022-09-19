<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Album extends Model
{
    use HasFactory;

    protected $fillable=["name","user_id","img_count","avatar"];

    public function images() {
        return $this->hasMany(Image::class, 'album_id', 'id');
    }
}
