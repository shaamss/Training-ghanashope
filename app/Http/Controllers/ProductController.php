<?php

namespace App\Http\Controllers;

use App\Product;
use App\Unit;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with(['category', 'images'])->paginate(env('PAGINATION_COUNT'));
        $currencyCode = env("CURRENCY_CODE", "$");
        return view('admin.products.products')->with([
            'products' => $products,
            'currency_code' => $currencyCode,
        ]);
    }

    public function newProduct($id = null)
    {
        $product = null ;

        if(!is_null($id))
        {
            $product = Product::with([
                'hasUnit'
            ])->find($id);

        }

        $units = Unit::all();

        return view('admin.products.new-prodect')->with([
            'product' => $product,
            'units' => $units,
        ]);

    }


    public function delete($id)
    {

    }

    public function update( $id,  Request $request )
    {

    }


    public function store(Request $request)
    {

    }



}
