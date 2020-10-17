<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tag;
use App\Hobby;
use Illuminate\Support\Facades\Gate;

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

    public function attachTag($hubby_id, $tag_id)
    {
        $hobby = Hobby::find($hubby_id);
        // Make sure the hobby belongs to the user looged in.
        if (Gate::denies('connect_hobbyTag', $hobby)) {
            abort(403, 'No! This hobby is not yours!');
        }
        $tag = Tag::find($tag_id);
        $hobby->tags()->attach($tag_id);
        return back()->with([
            'message_success' => 'The tag <b>' . $tag->name . '</b> was successfully added to the hobby <b>' . $hobby->name . '</b>.'
        ]);
    }

    public function detachTag($hubby_id, $tag_id)
    {
        $hobby = Hobby::find($hubby_id);
        // Make sure the hobby belongs to the user looged in.
        if (Gate::denies('connect_hobbyTag', $hobby)) {
            abort(403, 'No! This hobby is not yours!');
        }
        $tag = Tag::find($tag_id);
        $hobby->tags()->detach($tag_id);
        return back()->with([
            'message_success' => 'The tag <b>' . $tag->name . '</b> was successfully removed from the hobby ' . $hobby->name . '</b>.'
        ]);
    }
}
