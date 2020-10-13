<?php

namespace App\Http\Controllers;

use App\Hobby;
use App\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Intervention\Image\Facades\Image;
//use Illuminate\Support\Carbon; // Used to format time/dates

class HobbyController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth')->except(['index', 'show']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //dd($hobbies); // Helper function in Laravel - die and dump - Prints and stops
        // $hobbies = Hobby::all();
        // $hobbies = Hobby::paginate(10);
        $hobbies = Hobby::orderBy('created_at', 'DESC')->paginate(10);

        return view('hobby.index')->with([
            'hobbies' => $hobbies
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('hobby.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|min:3',
            'description' => 'required|min:5',
            'image' => 'mimes:jpeg,bmp,png,gif,jpg',
        ]);

        $newHobby = new Hobby([
            'name' => $request->name,
            'description' => $request['description'], // same as $request->description
            'user_id' => auth()->id()
        ]);
        $newHobby->save();
        /*
        return $this->index()->with([
            'message_success' => 'The hobby <b>' . $newHobby->name . '</b> was successfully added.'
        ]); // Call index method to display hobbies
        */
        return redirect('/hobby/' . $newHobby->id)->with([
            'message_warning' => 'Please add tags to your hobby.'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Hobby  $hobby
     * @return \Illuminate\Http\Response
     */
    public function show(Hobby $hobby)
    {
        $allTags = Tag::all();
        $usedTags = $hobby->tags;
        $availableTags = $allTags->diff($usedTags);

        return view('hobby.show')->with([
            'hobby' => $hobby,
            'availableTags' => $availableTags,
            'message_success' => Session::get('message_success'),
            'message_warning' => Session::get('message_warning')
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Hobby  $hobby
     * @return \Illuminate\Http\Response
     */
    public function edit(Hobby $hobby)
    {
        return view('hobby.edit')->with([
            'hobby' => $hobby
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Hobby  $hobby
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Hobby $hobby)
    {
        $request->validate([
            'name' => 'required|min:3',
            'description' => 'required|min:5',
            'image' => 'mimes:jpeg,bmp,png,gif,jpg',
        ]);

        if ($request->image) {
            $image = Image::make($request->image);
            if ($image->width() > $image->height()) { // Landscape format
                $image
                    ->widen(1200)->save(public_path() . "/img/hobbies/" . $hobby->id . "_large.jpg")
                    ->widen(400)->pixelate(12)->save(public_path() . "/img/hobbies/" . $hobby->id . "_pixelated.jpg");
                $image = Image::make($request->image);
                $image->widen(60)->save(public_path() . "/img/hobbies/" . $hobby->id . "_thumb.jpg");
            } else { // Portrait format
                $image
                    ->heighten(900)->save(public_path() . "/img/hobbies/" . $hobby->id . "_large.jpg")
                    ->heighten(400)->pixelate(12)->save(public_path() . "/img/hobbies/" . $hobby->id . "_pixelated.jpg");
                $image = Image::make($request->image);
                $image->heighten(60)->save(public_path() . "/img/hobbies/" . $hobby->id . "_thumb.jpg");
            }
        }

        $hobby->update([
            'name' => $request->name,
            'description' => $request['description']
        ]);
        return $this->index()->with([
            'message_success' => 'The hobby <b>' . $hobby->name . '</b> was successfully updated.'
        ]); // Call index method to display hobbies
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Hobby  $hobby
     * @return \Illuminate\Http\Response
     */
    public function destroy(Hobby $hobby)
    {
        $oldName = $hobby->name;
        $hobby->delete();
        return $this->index()->with([
            'message_success' => 'The hobby <b>' . $oldName . '</b> was successfully deleted.'
        ]);
    }
}
