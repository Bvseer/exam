@extends('layouts.header')
@section('content')

    <audio controls>
        <source src="{{ $sound->path }}">
    </audio>
    <a href="{{ $sound->path }}">DOWNLOAD</a>
@endsection
