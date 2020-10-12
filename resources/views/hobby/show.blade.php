@extends('layouts.app')
@section('page_title', 'Hobby Details')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-11">
            <div class="card">
                <div class="card-header">Hobby Details</div>
                <div class="card-body">
                    <strong>{{ $hobby->name }}</strong>
                    <p>{{ $hobby->description }}</p>
                    <br>
                    <strong>Used Tags (click to remove)</strong>
                    <p>
                    @foreach ($hobby->tags as $tag)
                        <span class="badge badge-{{$tag->style}}">{{$tag->name}}</span>
                    @endforeach
                    </p>
                    <strong>Available Tags (click to add)</strong>
                    <p>
                    @foreach ($availableTags as $tag)
                        <span class="badge badge-{{$tag->style}}">{{$tag->name}}</span>
                    @endforeach
                    </p>
                </div>
            </div>
            <div class="mt-2">
                <a href="{{URL::previous()}}" class="btn btn-primary btn-sm"><i class="fas fa-arrow-circle-left"></i> Back to Hobbies</a>
            </div>
        </div>
    </div>
</div>
@endsection
