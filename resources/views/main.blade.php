@extends('layouts.header')
@section('content')
    <a href="/home">Log out</a><br>
    @if(session('status'))
        <h2 style="color: red">
            {{ session('status') }}
        </h2>
    @endif
    @foreach($categories as $c)
        <div @class('category')>
            <a href="/search/{{ $c->id }}" >{{ $c->name }}</a><br>
        </div>
    @endforeach
    <div @class('formsDiv')>
        <form action="search" method="get" @class('searchForm')>
            @csrf
            <p>Поиск звука</p>
            <input type="text" required name="sound" placeholder="Название" @class('soundInput')><br>
            <button type="submit" @class('button')>Найти</button>
        </form>
        <form action="add" @class('searchForm') method="post" enctype="multipart/form-data">
            @csrf
            <p>Добавление звука</p>
            <input type="file" name="newSound" id=""><br>
            <input type="text" name="name" required><br>
            <select name="category_id" @class('button')>
                @foreach($categories as $c)
                <a>
                    <option value="{{ $c->id }}">{{ $c->name }}</option>
                </a>
                @endforeach
            </select><br>
            <button type="submit" @class('button')>Submit</button>
        </form>
    </div>
@endsection
