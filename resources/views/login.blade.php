@extends('layouts.app')

@section('content')
    <div class="login">
        <div class="login__container container">
            <h1>Авторизация</h1>
            @error('invalid') <div class="error__text">{{ $message }}</div> @enderror
            <form action="{{ route('auth.login') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="input__div" >
                    <input class="@error('email') error_active @enderror" value="{{ old('email') }}" type="text" name="email" placeholder="Email">
                    @error('email')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>
                <div class="input__div">
                    <input class="@error('password') error_active @enderror" type="password" name="password" placeholder="Пароль">
                    @error('password')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>
                <button type="submit" class="button">Авторизоваться</button>
            </form>
        </div>
    </div>
@endsection
