@extends('layouts.mainLayout')

@section('content')

    <h1>WELCOME TO PAGE 3!</h1>
    <hr>
    <h3>O valor é: {{ $value }}</h3>
    <a href="http://127.0.0.1:8000/main/000">Main</a><br>
    <a href="http://127.0.0.1:8000/page2/000">Page 2</a><br>

    @endsection
