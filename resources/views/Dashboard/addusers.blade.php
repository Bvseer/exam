@extends('layouts.header')
@section('content')
    @if(session('response'))
        <p class="link">
            {{ __(session('response')) }}
        </p>
    @endif
    <a @class('link') href="{{ route('dashboard') }}">{{__('Админ панель')}}</a>
    <h1 @class('link center')>{{__('Форма для добавления пользователя')}}</h1>
    <form action="{{ route('addusers') }}" method="post" @class('link fblack') style="width: fit-content; font-size: 40px; margin: auto">
        @csrf
        <input type="text" placeholder="Name" name="name" style="width: 100%"><br>
        @if($errors->has('name'))
            <p style="font-size: medium; margin-block: 0 !important;">{{ $errors->first('name') }}</p>
        @endif
        <input type="email" placeholder="Email" name="email" style="width: 100%"><br>
        @if($errors->has('email'))
            <p style="font-size: medium; margin-block: 0 !important;">{{ $errors->first('email') }}</p>
        @endif
        <input type="password" placeholder="Password" name="password" style="width: 100%"><br>
        @if($errors->has('password'))
            <p style="font-size: medium; margin-block: 0 !important;">{{ $errors->first('password') }}</p><br>
        @endif
        <label for="is_admin">{{__('Администратор')}}</label>
        <input type="checkbox" id="is_admin" name="is_admin"><br>
        <button type="submit" @class('button') style="width: 100%">{{__('Добавить')}}</button>
    </form>
@endsection
