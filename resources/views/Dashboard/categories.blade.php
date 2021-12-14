@extends('layouts.header')
@section('content')
    <a @class('link') href="dashboard">{{__('Админ панель')}}</a>
    @if(session('response'))
        <h1 class="link center">{{ __(session('response')) }}</h1>
    @endif
    <h1 @class('link center')>{{__('Категории')}}</h1>
    <div @class('covering_div margin-block')>
        <form action="{{ route('categories') }}" method="post" @class('link margin-block')>
            <p>{{__('Добавить категорию')}}</p>
            @csrf
            <input type="hidden" name="action" value="add">
            <input type="text" placeholder="{{__('Категория')}}" name="category">
            <button type="submit" @class('button')>{{__('Добавить')}}</button>
        </form>
    </div>
    @if(!empty($categories))
        @foreach($categories as $c)
        <div class="link">
        <p>{{ __($c->name) }}</p>
            <form action="{{ route('categories') }}" method="post">
                @csrf
                <input type="hidden" name="action" value="delete">
                <input type="hidden" name="id" value="{{ $c->id }}">
                <button @class('button') type="submit">{{__('Удалить')}}</button>
            </form>
        </div><br>
        @endforeach
    @endif
@endsection
