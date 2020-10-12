@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-11">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>
                <div class="card-body">
                    <h2>Hello {{ auth()->user()->name }}</h2>
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <br>
                    @isset($hobbies)
                        @if ($hobbies->count() == 0)
                            No hobbies.
                        @else
                            <h3>Your hobbies</h3>
                            <ul class="list-group">
                                @foreach($hobbies as $hobby)
                                <li class="list-group-item">
                                    <a title="Show Details" href="/hobby/{{ $hobby->id }}">{{ $hobby -> name }}</a>
                                    @auth
                                    <a class="btn btn-light btn-sm ml-2" href="/hobby/{{ $hobby->id }}/edit" title="Edit hobby"><i class="fas fa-pen"></i> Edit</a>
                                    @endauth
                                    @auth
                                    <form class="float-right" action="/hobby/{{ $hobby->id }}" method="POST" style="display:inline">
                                        @csrf
                                        @method('DELETE')
                                        <input type="submit" class="btn btn-outline-danger btn-sm" value="Delete">
                                    </form>
                                    @endauth
                                    <span class="float-right mx-2">{{ $hobby->created_at->diffForHumans() }}</span>
                                    <br>
                                    @foreach ($hobby->tags as $tag)
                                    <a href="/hobby/tag/{{$tag->id}}"><span class="badge badge-{{$tag->style}}">{{$tag->name}}</span></a>
                                    @endforeach
                                </li>
                                @endforeach
                            </ul>
                        @endif
                    @endisset
                    <br>
                    <a href="/hobby/create" class="btn btn-success btn-sm"><i class="fas fa-plus-circle"></i> Create New Hobby</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
