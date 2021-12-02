@extends('layouts.header')
@section('content')

    <audio controls>
        <source src="{{ $sound[0]->path }}">
    </audio>

@endsection
