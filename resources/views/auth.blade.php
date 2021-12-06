@extends('layouts.header')
@section('content')
<form action="" method="post">
    @csrf
    <h1>Registration form</h1>
    <label for="">Login</label><br>
    @error('login')
    <div class="alert alert-danger" style="color: red">{{ $message }}</div>
    @endif
    <input type="text" name="login" placeholder="Login"><br>
    <label for="">Password</label><br>
    @error('password')
    <div class="alert alert-danger" style="color: red">{{ $message }}</div>
    @endif
    <input type="text" name="password" placeholder="Password"><br>
    <label for="">Email</label><br>
    @error('email')
    <div class="alert alert-danger" style="color: red">{{ $message }}</div>
    @endif
    <input type="text" name="email" placeholder="Email"><br>
    <button type="submit">Registrate</button>
</form>
@endsection
