<?php

namespace App\Http\Controllers;

use App\Http\Resources\ShowResource;
use App\Models\Show;
use Illuminate\Http\Request;

class FavoritesController extends Controller
{
    public function add($show_id)
    {
        $show = Show::findOrFail($show_id);
        auth()->user()->favorites()->attach($show->id);
        return response(['message' => __("$show->title added to favorite successfully")]);
    }

    public function delete($show_id)
    {
        $show = Show::findOrFail($show_id);
        auth()->user()->favorites()->detach($show->id);
        return response(['message' => __("$show->title deleted from favorite successfully")]);
    }

    public function getFavorites()
    {
        return ShowResource::collection(auth()->user()->favorites()->paginate(10));
    }
}
