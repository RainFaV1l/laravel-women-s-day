@extends('layouts.app')

@section('content')
    <div class="login">
        <div class="login__container container">
            <h1>Добавить товар</h1>
            <form action="{{ route('admin.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="input__div" >
                    <input class="@error('name') error_active @enderror" value="{{ old('name') }}" type="text" name="name" placeholder="Название">
                    @error('name')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>
                <div class="input__div" >
                    <input class="@error('price') error_active @enderror" value="{{ old('price') }}" type="text" name="price" placeholder="Цена">
                    @error('price')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>
                <div class="input__div" >
                    <input class="@error('path') error_active @enderror" type="file" name="path">
                    @error('path')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>
                <button type="submit" class="button">Добавить</button>
            </form>
        </div>
    </div>
@endsection
