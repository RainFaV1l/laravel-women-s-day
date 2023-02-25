@extends('layouts.app')

@section('content')
    <div class="admin">
        <div class="admin__container container">
            <h1>Админ панель</h1>
            <div class="admin__buttons">
                <a class="button" href="{{ route('admin.create') }}">Добавить продукт</a>
            </div>
            <div class="admin__tables">
                <div class="admin-table__populars">
                    <h3>Популярные товары</h3>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Название</th>
                                <th>Цена</th>
                                <th>Кол-во заказов</th>
                                <th>Дата создания</th>
                                <th>Дата изменения</th>
                                <th>Изменение</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($topProducts as $topProduct)
                                <tr>
                                    <td>{{ $topProduct['name'] }}</td>
                                    <td>{{ $topProduct['price'] }}</td>
                                    <td>{{ $topProduct['order_count'] }}</td>
                                    <td>{{ $topProduct['created_at'] }}</td>
                                    <td>{{ $topProduct['updated_at'] }}</td>
                                    <td>
                                        <div class="control">
                                            <a href="{{ route('admin.edit', $topProduct['id']) }}" class="edit">Редактировать</a>
                                            <form action="{{ route('admin.destroy', $topProduct['id']) }}" method="post">
                                                @csrf
                                                <button type="submit" class="delete">Удалить</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="admin-table__all">
                    <h3>Все товары</h3>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Название</th>
                                <th>Цена</th>
                                <th>Дата создания</th>
                                <th>Дата изменения</th>
                                <th>Изменение</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($products as $product)
                                <tr>
                                    <td>{{ $product['name'] }}</td>
                                    <td>{{ $product['price'] }}</td>
                                    <td>{{ $product['created_at'] }}</td>
                                    <td>{{ $product['updated_at'] }}</td>
                                    <td>
                                        <div class="control">
                                            <a href="{{ route('admin.edit', $product['id']) }}" class="edit">Редактировать</a>
                                            <form action="{{ route('admin.destroy', $product['id']) }}" method="post">
                                                @csrf
                                                <button type="submit" class="delete">Удалить</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
