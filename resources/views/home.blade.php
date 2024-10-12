@extends('Layouts/app')

@section('content')
    <a href="{{ route('login') }}">Login</a>
    <a href="{{ route('login') }}">Register</a>
    <a href="{{ route('dashboard') }}">Dashboard</a>
@endsection
