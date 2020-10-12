<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tag;

class HobbyTagController extends Controller
{
    public function filterHobbies($tag_id)
    {
        $tag = new Tag();
        $hobbies = $tag::findOrFail($tag_id)->filteredHobbies()->paginate(10);
        $filter = $tag::find($tag_id);
        return view('hobby.index', [
            'hobbies' => $hobbies,
            'filter' => $filter
        ]);
    }
}
