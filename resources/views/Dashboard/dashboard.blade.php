@extends('layouts.header')
@section('content')
    @if(session('response'))
        <h1 style="color: white">{{ __(session('response')) }}</h1>
    @endif
    <a href="/" @class('link')>{{ __('Главная') }}</a>
    <a href="{{ route('complaints') }}" @class('link')>{{ __('Жалобы') }}</a>
    <a href="{{ route('categories') }}" @class('link')>{{ __('Категории') }}</a>
    <a href="{{ route('users') }}" @class('link')>{{ __('Пользователи') }}</a>
    <div @class('sound_checking')>
        <div>
    @if($sounds)
            <h2>{{__('Одобренные')}}</h2>
        @foreach($sounds as $s)
            @if($s->is_available)
            <div @class('covering_div width_100')>
                <p @class('sound_name')>{{ $s->name }}</p>
                <p @class('sound_name')>{{ __($s->category->name) }}</p>
                <form action="{{ route('dashboard') }}" method="post">
                    @csrf
                    <input type="hidden" name="action" value="change">
                    <input type="hidden" name="sound_id" value="{{ $s->id }}">
                    <select name="category" id="" @class('button')>
                    @foreach($categories as $c)
                    <option value="{{ $c->id }}">{{ __($c->name) }}</option>
                    @endforeach
                    </select>
                    <button type="submit" @class('button')>{{__('Поменять')}}</button>
                </form>
                <form action="{{ route('dashboard') }}" method="post">
                    @csrf
                    <input type="hidden" name="action" value="delete">
                    <input type="hidden" name="id" value="{{ $s->id }}">
                    <button @class('button') type="submit">{{__('Удалить')}}</button>
                </form>
            </div>
            @endif
        @endforeach
        </div>
        <div>
            <h2>{{ __('Ожидающие одобрения') }}</h2>
            @foreach($sounds as $s)
                @if(!$s->is_available)
                    <div @class('covering_div width_100')>
                    <p @class('sound_name')>{{ $s->name }}</p>
                        <p @class('sound_name')>{{ __($s->category->name) }}</p>
                    <form action="{{ route('dashboard') }}" method="post">
                        @csrf
                        <input type="hidden" name="action" value="approve">
                        <input type="hidden" name="id" value="{{ $s->id }}">
                        <button @class('button') type="submit">{{ __('Одобрить') }}</button>
                    </form>
                    <form action="{{ route('dashboard') }}" method="post">
                        @csrf
                        <input type="hidden" name="action" value="delete">
                        <input type="hidden" name="id" value="{{ $s->id }}">
                        <button @class('button') type="submit">{{__('Удалить')}}</button>
                    </form>
                    </div>
                @endif
            @endforeach
    @endif
        </div>
    </div>
@endsection
