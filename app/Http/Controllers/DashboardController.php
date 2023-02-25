<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class DashboardController extends Controller
{

    public function show() {
        $topProducts = Product::query()->withCount('order')->orderBy('order_count', 'DESC')->get();
        $products = Product::all();
        return view('showAdmin', compact('products', 'topProducts'));
    }

    public function createProductView() {
        return view('create');
    }

    public function editProductView($id) {
        $product = Product::find($id);
        return view('edit', compact('product'));
    }

    public function store(Request $request) {

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'price' => 'required|numeric',
            'path' => 'required|mimes:png,jpeg,jpg',
        ], [
            'required' => 'Обязательна к заполнению',
            'email.unique' => 'Данный email уже зарегистрирован',
            'email.email' => 'Некорректный email',
            'password.min' => 'Минимальная длина 6 символов',
            'password.same' => 'Пароли не совпадают',
            'path.mimes' => 'Данный формат изображения не поддерживается',
            'price.numeric' => 'Цена должна быть в числовом формате',
            'name.unique' => 'Товар сданным названием уже существует'
        ]);

        if($validator->fails()) {
            return back()->withErrors($validator->errors())->withInput($request->all());
        }

        if($request->file('path')) {
            $image_path = $request->file('path')->store('public/images');;
        }

        Product::query()->create(
            ['path' => $image_path] + $validator->validated()
        );

        return redirect(route('admin.show'));
    }

    public function update(Request $request, Product $product) {

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'price' => 'required',
        ], [
            'required' => 'Обязательна к заполнению',
            'path.mimes' => 'Данный формат изображения не поддерживается',
            'price.numeric' => 'Цена должна быть в числовом формате',
        ]);

        if($validator->fails()) {
            return back()->withErrors($validator->errors())->withInput($request->all());
        }

        $validated = $validator->validated();

        if($request->file('path')) {

            $request->validate(['path' => 'mimes:jpg,jpeg,png']);

            $image_path = $request->file('path')->store('storage/images');;

            $validated['path'] = $image_path;
        }

//        DB::table('products')->update($validated);
        $product::query()->update($validated);

        return back();
    }

    public function destroy($id) {
        Product::destroy($id);
        return redirect(route('admin.show'));
    }

}
