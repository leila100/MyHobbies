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
                    @if ($hobby->tags->count() > 0)
                        <strong>Used Tags (click to remove)</strong>
                        <p>
                        @foreach ($hobby->tags as $tag)
                            <a href="/hobby/{{$hobby->id}}/tag/{{$tag->id}}/detach"><span class="badge badge-{{$tag->style}}">{{$tag->name}}</span></a>
                        @endforeach
                        </p>
                    @endif
                    @if ($availableTags->count() > 0)
                        <strong>Available Tags (click to add)</strong>
                        <p>
                            @foreach ($availableTags as $tag)
                                <a href="/hobby/{{$hobby->id}}/tag/{{$tag->id}}/attach"><span class="badge badge-{{$tag->style}}">{{$tag->name}}</span></a>
                            @endforeach
                        </p>
                    @endif
                </div>
            </div>
            <div class="mt-2">
                <a href="/hobby" class="btn btn-primary btn-sm"><i class="fas fa-arrow-circle-left"></i> Back to Hobbies</a>
            </div>
        </div>
    </div>
</div>
@endsection
