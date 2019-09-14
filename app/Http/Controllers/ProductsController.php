<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    public function index(Request $request)
    {
        $products = Product::orderBy('name')->paginate(25);

        return view('products.index', compact('products'));
    }

    public function update(Request $request)
    {
        $id = $request->post('pk');
        $product = Product::findOrFail($id);

        $name = $request->post('name');
        $value = $request->post('value');

        $product->$name = $value;
        $product->save();
    }
}
