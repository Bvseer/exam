@extends('layouts.header')
@section('content')
    <a href="dashboard" @class('link')>{{__('Админ панель')}}</a>
    <a href="complaints" @class('link')>{{__('Показать непрочитнные жалобы')}}</a>
    @if(session('response'))
        <h1 @class('link center black')>{{ __(session('response')) }}</h1>
    @endif
    <div>
        @if(!empty($complaints))
            <h1 @class('link center')>{{__('Все жалобы')}}</h1>
            @foreach($complaints as $c)
                <div @class('covering_div')>
                    <h2>{{__('Причина')}}</h2>
                    <h2>{{ $c->reason }}</h2>
                    <h3>{{__('Текст жалобы')}}</h3>
                    <h3>{{ $c->complaint }}</h3>
                    @if(!$c->is_viewed)
                        <form action="{{ route('complaints') }}" method='post'>
                            @csrf
                            <input type="hidden" name="action" value="edit">
                            <input type="hidden" name="id" value="{{ $c->id }}">
                            <button type="submit" @class('button')>{{__('Прочитано')}}</button>
                        </form>
                    @endif
                    <form action="{{ route('complaints') }}" method='post'>
                        @csrf
                        <input type="hidden" name="action" value="delete">
                        <input type="hidden" name="id" value="{{ $c->id }}">
                        <button type="submit" @class('button')>{{__('Удалить')}}</button>
                    </form>
                </div><br>
            @endforeach
        @else
            <h1>{{__('Жалоб нет!')}}</h1>
        @endif
    </div>
@endsection
