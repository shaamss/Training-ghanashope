<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories =Category::paginate(env('PAGINATION_COUNT'));

        return view('admin.categories.categories')->with([
            'categories' => $categories,
            'showLinks' => true,
        ]);
    }


    public function store(Request $request)
    {

    }

    public function update(Request $request)
    {

    }

    public function delete(Request $request)
    {

    }

    public function search(Request $request)
    {

    }
}
