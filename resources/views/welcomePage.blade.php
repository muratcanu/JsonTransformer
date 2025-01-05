@extends('layouts.app')

@section('content')
    <div class="container text-center my-5">
        <div class="jumbotron">
            <h1 class="display-4">Welcome to {{ config('app.name') }}</h1>
            <p class="lead">This is a simple welcome page built with Laravel and Bootstrap.</p>
            <hr class="my-4">
        </div>
    </div>
@endsection