@extends('layouts.app')
@section('page_title', 'User Details')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-11">
            <div class="card">
                <div class="card-header">{{ $user->name }}</div>
                <div class="card-body">
                    <b>My motto:</b><br>{{ $user->motto }}
                    <br>
                    <p class="mt-2"><b>About Me:</b><br>{{ $user->about_me }}</p>
                    <h4>Hobbies</h4>
                    <ul>
                    @foreach ($user->hobbies as $hobby)
                        <li>{{$hobby->name}}</li>
                    @endforeach
                    </ul>
                </div>
            </div>
            <div class="mt-2">
                <a href="{{URL::previous()}}" class="btn btn-primary btn-sm"><i class="fas fa-arrow-circle-left"></i> Back to Hobbies</a>
            </div>
        </div>
    </div>
</div>
@endsection
