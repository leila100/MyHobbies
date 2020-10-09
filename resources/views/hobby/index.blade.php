@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-11">
            <div class="card">
                <div class="card-header">Hobbies</div>

                <div class="card-body">
                    <ul class="list-group">
                        @foreach($hobbies as $hobby)
                        <li class="list-group-item">
                            <a title="Show Details" href="/hobby/{{ $hobby->id }}">{{ $hobby -> name }}</a>
                            @auth
                            <a class="btn btn-light btn-sm ml-2" href="/hobby/{{ $hobby->id }}/edit" title="Edit hobby"><i class="fas fa-pen"></i> Edit</a>
                            @endauth
                            <span class="mx-2">Posted by {{ $hobby->user->name }} ({{ $hobby->user->hobbies->count() }} hobbies)</span>
                            @auth
                            <form class="float-right" action="/hobby/{{ $hobby->id }}" method="POST" style="display:inline">
                                @csrf
                                @method('DELETE')
                                <input type="submit" class="btn btn-outline-danger btn-sm" value="Delete">
                            </form>
                            @endauth
                            <span class="float-right mx-2">{{ $hobby->created_at->diffForHumans() }}</span>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="mt-3">
                {{ $hobbies->links() }}
            </div>
            @auth
            <div class="mt-2">
                <a href="/hobby/create" class="btn btn-success btn-sm"><i class="fas fa-plus-circle"></i> Add New Hobby</a>
            </div>
            @endauth
        </div>
    </div>
</div>
@endsection
