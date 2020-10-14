<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Intervention\Image\Facades\Image;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return view('user.show')->with([
            'user' => $user,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('user.edit')->with([
            'user' => $user,
            'message_success' => Session::get('message_success'),
            'message_warning' => Session::get('message_warning')
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'motto' => 'min:3',
            'about_me' => 'min:5',
            'image' => 'mimes:jpeg,bmp,png,gif,jpg',
        ]);

        if ($request->image) {
            $this->saveImages($request->image, $user->id);
        }

        $user->update([
            'motto' => $request->motto,
            'about_me' => $request->about_me
        ]);
        return $this->show($user)->with([
            'message_success' => 'The information for user <b>' . $user->name . '</b> was successfully updated.'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }

    public function saveImages($imageInput, $userId)
    {
        $image = Image::make($imageInput);
        $userPath = "/img/users/" . $userId;
        if ($image->width() > $image->height()) { // Landscape format
            $image
                ->widen(1200)->save(public_path() . $userPath . "_large.jpg")
                ->widen(400)->pixelate(12)->save(public_path() . $userPath . "_pixelated.jpg");
            $image = Image::make($imageInput);
            $image->widen(60)->save(public_path() . $userPath . "_thumb.jpg");
        } else { // Portrait format
            $image
                ->heighten(900)->save(public_path() . $userPath . "_large.jpg")
                ->heighten(400)->pixelate(12)->save(public_path() . $userPath . "_pixelated.jpg");
            $image = Image::make($imageInput);
            $image->heighten(60)->save(public_path() . $userPath . "_thumb.jpg");
        }
    }
}
