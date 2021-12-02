@extends('layouts.header')
@section('content')
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
            <option value="1">Аплодисменты</option>
            <option value="2">Бары, кафе и рестораны</option>
            <option value="3">Транспорт, машины, авто</option>
            <option value="4">Природа</option>
        </select>
        <button type="submit">Submit</button>
    </form>
@endsection
