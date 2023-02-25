@extends('layouts.app')

@section('content')
    <div class="login">
        <div class="login__container container">
            <h1>Редактировать товар</h1>
            <form action="{{ route('admin.update', $product) }}" method="post" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="id" value="{{ $product['id'] }}">
                <div class="input__div" >
                    <input class="@error('name') error_active @enderror" value="{{ $product['name'] }}" type="text" name="name" placeholder="Название">
                    @error('name')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>
                <div class="input__div" >
                    <input class="@error('price') error_active @enderror" value="{{ $product['price'] }}" type="text" name="price" placeholder="Цена">
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
                <button type="submit" class="button">Сохранить</button>
            </form>
        </div>
    </div>
@endsection
