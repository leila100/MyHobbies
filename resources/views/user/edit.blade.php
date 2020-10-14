@extends('layouts.app')
@section('page_title', 'Edit User Profile')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Edit User Profile</div>
                <div class="card-body">
                    <form method="POST" action="/user/{{ $user->id }}" enctype="multipart/form-data" autocomplete="off">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="motto">Motto</label>
                            <input type="text" class="form-control {{ $errors->has('motto') ? 'border-danger' : '' }}" id="motto" name="motto" value="{{old('motto') ?? $user['motto'] }}">
                            <small class="form-text text-danger">{!! $errors->first('motto') !!}</small>
                        </div>
                        @if (file_exists('img/users/'.$user->id.'_large.jpg'))
                            <div class="mb-2">
                                <img style="max-width: 300px; max-height:200px;" src="/img/users/{{$user->id}}_large.jpg" alt="User Image">
                                <a href="/delete_images/user/{{$user->id}}" class="btn btn-danger btn-sm float-right">Delete Image</a>
                            </div>
                        @endif
                        <div class="form-group">
                            <label for="image">Image</label>
                            <input type="file" class="form-control {{ $errors->has('image') ? 'border-danger' : '' }}" id="image" name="image" value="">
                            <small class="form-text text-danger">{!! $errors->first('image') !!}</small>
                        </div>
                        <div class="form-group">
                            <label for="about_me">About Me</label>
                            <textarea class="form-control {{ $errors->has('about_me') ? 'border-danger' : '' }}" id="about_me" name="about_me">{{old('about_me') ?? $user['about_me'] }}</textarea>
                            <small class="form-text text-danger">{!! $errors->first('about_me') !!}</small>
                        </div>
                        <input class="btn btn-primary mt-4" type="submit" value="Update User">
                    </form>
                    <a class="btn btn-primary float-right" href="/user/{{$user->id}}"><i class="fas fa-arrow-circle-up"></i> Back</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
