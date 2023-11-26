<?php

namespace App\Http\Controllers;

use App\Enums\ShowType;
use App\Http\Resources\ShowResource;
use App\Models\Show;
use Illuminate\Http\Request;

class ShowsController extends Controller
{

    public function store(Request $request)
    {
        Show::create($request->all());
    }
    public function getSeries()
    {
        $series = Show::filter()->where('type', ShowType::SERIES)->paginate(10);
        return ShowResource::collection($series);
    }

    public function getMovies()
    {
        $movies = Show::filter()->where('type', ShowType::MOVIE)->paginate(10);
        return ShowResource::collection($movies);
    }

    public function getTopSeries()
    {
        $series = Show::filter()->where('type', ShowType::SERIES)->latest('popularity')->take(5)->get();
        return ShowResource::collection($series);
    }

    public function getTopMovies()
    {
        $movies = Show::filter()->where('type', ShowType::MOVIE)->latest('popularity')->take(5)->get();
        return ShowResource::collection($movies);
    }

    public function getShowDetails($show_id)
    {
        $show = Show::findOrFail($show_id);
        return new ShowResource($show);
    }

}
