@extends('layouts.app')
@section('page_title', 'Edit Hobby')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Edit Hobby</div>
                <div class="card-body">
                    <form method="POST" action="/hobby/{{ $hobby->id }}" enctype="multipart/form-data" autocomplete="off">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control {{ $errors->has('name') ? 'border-danger' : '' }}" id="name" name="name" value="{{old('name') ?? $hobby['name'] }}">
                            <small class="form-text text-danger">{!! $errors->first('name') !!}</small>
                        </div>
                        <div class="mb-2">
                            @if (file_exists('img/hobbies/'.$hobby->id.'_large.jpg'))
                                <img style="max-width: 400px; max-height:300px;" src="/img/hobbies/{{$hobby->id}}_large.jpg" alt="Hobby Image">
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="image">Image</label>
                            <input type="file" class="form-control {{ $errors->has('image') ? 'border-danger' : '' }}" id="image" name="image" value="">
                            <small class="form-text text-danger">{!! $errors->first('image') !!}</small>
                        </div>
                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea class="form-control {{ $errors->has('description') ? 'border-danger' : '' }}" id="description" name="description" rows="5">{{old('description') ?? $hobby['description'] }}</textarea>
                            <small class="form-text text-danger">{!! $errors->first('description') !!}</small>
                        </div>
                        <input class="btn btn-primary mt-4" type="submit" value="Update Hobby">
                    </form>
                    <a class="btn btn-primary float-right" href="/hobby"><i class="fas fa-arrow-circle-up"></i> Back</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
