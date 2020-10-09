<?php

namespace App\Http\Controllers;

use App\Hobby;
use Illuminate\Http\Request;

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
        $hobbies = Hobby::paginate(10);

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
        ]);

        $newHobby = new Hobby([
            'name' => $request->name,
            'description' => $request['description'], // same as $request->description
            'user_id' => auth()->id()
        ]);
        $newHobby->save();
        return $this->index()->with([
            'message_success' => 'The hobby <b>' . $newHobby->name . '</b> was successfully added.'
        ]); // Call index method to display hobbies
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Hobby  $hobby
     * @return \Illuminate\Http\Response
     */
    public function show(Hobby $hobby)
    {
        return view('hobby.show')->with([
            'hobby' => $hobby
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
            'description' => 'required|min:5'
        ]);

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
