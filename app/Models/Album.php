<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Album extends Model
{
    use HasFactory;

    protected $fillable = [
        'artist_id',
        'title',
        'link',
        'duration',
        'release_date'
    ];

    public function artist()
    {
        return $this->hasOne(Artist::class, 'id', 'artist_id');
    }

    public function songs()
    {
        return $this->hasMany(Song::class, 'album_id', 'id');
    }
}
