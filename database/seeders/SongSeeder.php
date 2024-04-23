<?php

namespace Database\Seeders;

use App\Models\Album;
use App\Models\Song;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SongSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $song = new Song();
        $song->album_id = Album::where('title', '=', 'Blue Hawaii')->first()->id;
        $song->title = "No more";
        $song->link = "http://localhost:8000/albums/blue-hawaii/no-more";
        $song->preview = "https://radiologrono.es/wp-content/uploads/2020/06/Elvis-Presley.jpg";
        $song->duration = 156;
        $song->save();

        $song = new Song();
        $song->album_id = Album::where('title', '=', 'Bleach')->first()->id;
        $song->title = "Blew";
        $song->link = "http://localhost:8000/albums/bleach/blew";
        $song->preview = "https://www.biografiasyvidas.com/biografia/c/fotos/cobain_kurt_4.jpg";
        $song->duration = 175;
        $song->save();

        $song = new Song();
        $song->album_id = Album::where('title', '=', 'Thriller')->first()->id;
        $song->title = "Beat it";
        $song->link = "http://localhost:8000/albums/thriller/beat-it";
        $song->preview = "https://es.web.img3.acsta.net/c_310_420/pictures/16/01/08/13/47/146452.jpg";
        $song->duration = 363;
        $song->save();
    }
}
