<?php

namespace Database\Seeders;

use App\Models\Show;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Http;

class ShowsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $request = Http::get('https://api.themoviedb.org/3/movie/popular?api_key=2a306467371e2e8d9fe666754fe69c7f');
        if($request->ok()){
            foreach ($request->json('results') as $movie)
            {
                Show::create(
                    [
                        'title'         => $movie['original_title'],
                        'overview'      =>  $movie['overview'],
                        'type'          =>  'movies',
                        'popularity'    =>  $movie['popularity'],
                        'release_date'  =>  $movie['release_date'],
                    ]
                );
            }
        }

        $request = Http::get('https://api.themoviedb.org/3/tv/popular?api_key=2a306467371e2e8d9fe666754fe69c7f');
        if($request->ok()){
            foreach ($request->json('results') as $series)
            {
                Show::create(
                    [
                        'title'         =>  $series['original_name'],
                        'overview'      =>  $series['overview'],
                        'type'          =>  'series',
                        'popularity'    =>  $series['popularity'],
                        'release_date'  =>  $series['first_air_date'],
                    ]
                );
            }
        }
    }
}
