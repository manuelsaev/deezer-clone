<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Song extends Model
{
    use HasFactory;

    protected $fillable = [
        'album_id',
        'title',
        'link',
        'preview',
        'duration'
    ];

    public function album()
    {
        return $this->hasOne(Album::class, 'id', 'album_id');
    }
}
