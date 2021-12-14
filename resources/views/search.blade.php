@extends('layouts.header')
@section('content')
    @if(session('response'))
        <h2 style="color: red">
            {{ session('response') }}
        </h2>
    @endif
    <h2>
        <a href="/">{{ __('Главная') }}</a>
    </h2>
    <div @class('parentDivForSounds')>
@foreach($sound as $s)
        <div @class('soundDiv covering_div')>
            <h2>{{$s->name}}</h2>
            <audio controls @class('audio')>
                <source src="{{asset($s->path) }}">
            </audio>
            <br><br>

            <form action="{{ route('complaint') }}" method="post" @class('complaintForm')>
                @csrf
                <input type="hidden" name="id" value="{{ $s->id }}">
                <div @class('formContent')>
                    <h1>Пожаловаться</h1>
                    <label for="reason">Суть жалобы</label><br>
                    <input type="text" name="reason" id="reason"><br><br>
                    <label for="complaint">Текст жалобы</label><br>
                    <textarea @class('textarea') name="complaint" id="complaint" cols="" rows="10"></textarea><br>
                    <button type="submit" @class('button')>Отправить</button>
                </div>
            </form>
        </div>
@endforeach
    </div>
@endsection
