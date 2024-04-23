<?php

namespace Database\Seeders;

use App\Models\Artist;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ArtistSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $artist = new Artist();
        $artist->name = "Elvis Presley";
        $artist->link = "http://localhost:8000/artists/elvis-presley";
        $artist->picture = "https://radiologrono.es/wp-content/uploads/2020/06/Elvis-Presley.jpg";
        $artist->save();

        $artist = new Artist();
        $artist->name = "Kurt Cobain";
        $artist->link = "http://localhost:8000/artists/kurt-cobain";
        $artist->picture = "https://www.biografiasyvidas.com/biografia/c/fotos/cobain_kurt_4.jpg";
        $artist->save();

        $artist = new Artist();
        $artist->name = "Michael Jackson";
        $artist->link = "http://localhost:8000/artists/michael-jackson";
        $artist->picture = "https://es.web.img3.acsta.net/c_310_420/pictures/16/01/08/13/47/146452.jpg";
        $artist->save();
    }
}
