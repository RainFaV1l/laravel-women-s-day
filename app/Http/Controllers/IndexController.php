<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index(Request $request) {
        $products = Product::all();

        $searchQuery = $request['search'];

        if($searchQuery) {
            $products = Product::query()->where('name', 'LIKE', '%' . $searchQuery . '%')->get();
            back()->withInput($request->all());
        }

        return view('welcome', compact('products'));
    }

    public function login() {
        return view('login');
    }

    public function register() {
        return view('register');
    }
}
