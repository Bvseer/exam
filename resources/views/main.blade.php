@extends('layouts.header')
@section('content')
    @if(Auth::check())
        @if(Auth::user()->is_blocked)
        <h1 @class('error black')>{{ __('YOU ARE BLOCKED') }}</h1>
        @endif
    @endif
    @if(Auth::guest())
        <br>
        <div>
            <a href="/login" @class('link')>{{ __('Войти') }}</a>
            <a href="/register" @class('link')>Зарегистрироваться</a>
        </div><br>
    @endif
    @if(Auth::check())
        <a href="{{ route('logout') }}" @class('link')>{{ __('Quit') }}</a><br><br>
    @endif
    @if(Auth::check() && Auth::user()->is_admin)
        <a href="{{ route('dashboard') }}" @class('link')>{{ __('Admin panel') }}</a><br><br>
    @endif
    @if(session('response'))
        <h2 @class('covering_div')>
            {{ session('response') }}
        </h2>
    @endif
    <div class="covering_div">
        @foreach($categories as $c)
            <div @class('category')>
                <a href="/search/{{ $c->id }}" >{{ __($c->name) }}</a><br>
            </div><br>
        @endforeach
        <div @class('formsDiv')>
            <form action="search" method="get" @class('searchForm')>
                @csrf
                <p>{{ __('Sound search') }}</p>
                <input type="text" required name="sound" placeholder="{{ __('Title') }}" @class('soundInput')><br>
                <button type="submit" @class('button')>{{ __('Search') }}</button>
            </form>
            @if(Auth::check() && !Auth::user()->is_blocked)
                <form action="add" @class('searchForm') method="post" enctype="multipart/form-data">
                    @csrf
                    <p>{{ __('Adding sound') }}</p>
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <input type="file" name="newSound" ><br>
                    <input type="text" name="name" required placeholder="{{ __('Title') }}"><br>
                    <select name="category_id" @class('button')>
                        @foreach($categories as $c)
                            <a>
                                <option value="{{ $c->id }}">{{ __($c->name) }}</option>
                            </a>
                        @endforeach
                    </select><br>
                    <button type="submit" @class('button')>{{ __('Add') }}</button>
                </form>
            @endif
        </div>
    </div>
@endsection
