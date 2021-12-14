@extends('layouts.header')
@section('content')
    @if(session('response'))
    <p class="link black center">
        {{ __(session('response')) }}
    </p>
    @endif
    <div @class('margin-block')>
    <a href="dashboard" @class('link block')>{{__('Админ панель')}}</a>
    <a href="addusers" @class('link block')>{{__('Добавить пользователя')}}</a>
    </div>
    <div @class('covering_div flex') style="margin-top: 25px;">
    @foreach($users as $u)
        <div @class('fblack link margin-block block margin-10 width-20')>
            <h3>{{ $u->id }} - {{ $u->name }}
            @if($u->is_blocked)
                <p>
                    {{__('Status')}} - {{__('Blocked')}}
                </p>
                    <form action="{{ route('users') }}" method="post">
                        @csrf
                        <input type="hidden" name="id" value="{{ $u->id }}">
                        <input type="hidden" name="action" value="unblock">
                        <button @class('button width_120') type="submit">{{__('Разблокировать')}}</button>
                    </form>
                @else
                    <p>
                        {{__('Status')}} - {{__('Not Blocked')}}
                    </p>
                    <form action="{{ route('users') }}" method="post">
                        @csrf
                        <input type="hidden" name="id" value="{{ $u->id }}">
                        <input type="hidden" name="action" value="block">
                        <button @class('button width_120') type="submit">{{__('Заблокировать')}}</button>
                    </form>
            @endif
            </h3>
            <form action="{{ route('users') }}" method="post">
                @csrf
                <input type="hidden" name="id" value="{{ $u->id }}">
                <input type="hidden" name="action" value="delete">
                <button @class('button width_120') type="submit">{{__('Удалить')}}</button>
            </form>
        </div>
    @endforeach
    </div>
@endsection
