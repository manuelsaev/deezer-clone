<?php

namespace Database\Seeders;

use App\Models\Album;
use App\Models\Artist;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AlbumSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $album = new Album();
        $album->artist_id = Artist::where('name', '=', 'Elvis Presley')->first()->id;
        $album->title = "Blue Hawaii";
        $album->link = "http://localhost:8000/albums/blue-hawaii";
        $album->duration = 1921;
        $album->release_date = '1961-10-01';
        $album->save();

        $album = new Album();
        $album->artist_id = Artist::where('name', '=', 'Kurt Cobain')->first()->id;
        $album->title = "Bleach";
        $album->link = "http://localhost:8000/albums/bleach";
        $album->duration = 2233;
        $album->release_date = '1989-06-15';
        $album->save();

        $album = new Album();
        $album->artist_id = Artist::where('name', '=', 'Michael Jackson')->first()->id;
        $album->title = "Thriller";
        $album->link = "http://localhost:8000/albums/thriller";
        $album->duration = 2530;
        $album->release_date = '1982-11-29';
        $album->save();

    }
}
