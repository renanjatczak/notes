@extends('layouts.mainLayout')

@section('content')

    <h1>BEM VINDO A MINHA PÁGINA!</h1>
    <hr>
    <h3>O valor é: {{ $value }}</h3>
    <a href="http://127.0.0.1:8000/page2/000">Page 2</a><br>
    <a href="http://127.0.0.1:8000/page3/000">Page 3</a><br>

@endsection
