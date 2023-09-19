@extends('layouts.app')
@section('content')
    <div class="container">
        <home-component :user_id={{auth()->user()->id}}></home-component>
    </div>
@endsection
