@extends('layouts.app')
@section('page_title', 'User Details')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-11">
            <div class="card">
                <div class="card-header" style="font-size: 150%">{{ $user->name }}</div>
                <div class="card-body">
                    <h5><b>My motto:</b></h5>{{ $user->motto }}
                    <br>
                    <p class="mt-2">
                        <h5><b>About Me:</b></h5>
                        {{ $user->about_me }}
                    </p>
                    @if ($user->hobbies->count() == 0)
                        <h5><b>{{ $user->name }} has no hobbies.</b></h5>
                    @else
                        <h5><b>{{ $user->name }}'s hobbies</b></h5>
                        <ul class="list-group">
                            @foreach($user->hobbies as $hobby)
                                <li class="list-group-item">
                                    <a title="Show Details" href="/hobby/{{ $hobby->id }}">{{ $hobby -> name }}</a>
                                    <span class="float-right mx-2">{{ $hobby->created_at->diffForHumans() }}</span>
                                    <br>
                                    @foreach ($hobby->tags as $tag)
                                    <a href="/hobby/tag/{{$tag->id}}"><span class="badge badge-{{$tag->style}}">{{$tag->name}}</span></a>
                                    @endforeach
                                </li>
                            @endforeach
                        </ul>
                    @endif
                </div>
            </div>
            <div class="mt-4">
                <a href="{{URL::previous()}}" class="btn btn-primary btn-sm"><i class="fas fa-arrow-circle-left"></i> Back to Hobbies</a>
            </div>
        </div>
    </div>
</div>
@endsection
