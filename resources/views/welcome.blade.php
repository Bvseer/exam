@extends('layouts.header')
@section('content')
    @foreach($categories as $c)
        <a href="/show/{{ $c->id }}" >{{ $c->name }}</a><br>
    @endforeach
    <form action="show" method="get">
        @csrf
        <p>Поиск звука</p>
        <input type="text" name="sound" placeholder="sound" style="border: 5px solid">
        <input type="text" name="category" placeholder="category" style="border: 5px solid">
        <button type="submit">Submit</button>
    </form>
    <form action="add" method="post" enctype="multipart/form-data" style="border: 3px solid black; margin: 10px; padding: 12px">
        @csrf
        <p>Добавление звука</p>
        <input type="file" name="newSound" id="">
        <input type="text" name="name" id="" style="border: 5px solid">
        <select name="category_id" id="">
            @foreach($categories as $c)
            <a>
                <option value="{{ $c->id }}">{{ $c->name }}</option>
            </a>
            @endforeach
        </select>
        <button type="submit">Submit</button>
    </form>
@endsection
