<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

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

    protected function categoryNmaeExist($categoryNmae)
    {
        $categories =Category::where(
            'name', '=', $categoryNmae
        )->get();

        if(count($categories) > 0 )
        {
            return true;
        }
        return false ;
    }

    public function store(Request $request)
    {
        $request->validate([
            'category_name' => 'required'
        ]);

        $categoryName = $request->input('category_name');

        if( $this->categoryNmaeExist($categoryName))
        {
            Session::flash('message', 'This Category [ ' . $categoryName . ' ] Already Exist !!');
            return back();
        }

        $category = new Category();
        $category->name = $categoryName ;
        $category->save();

        Session::flash('message', 'This Category [ ' . $categoryName . ' ] Has Been Added !!');
        return redirect()->back();
    }

    public function update(Request $request)
    {
        $request->validate([
            'category_name' => 'required',
            'category_id' => 'required'
        ]);

        $categoryName = $request->input('category_name');
        $categoryID = $request->input('category_id');

        if($this->categoryNmaeExist($categoryName))
        {
            Session::flash('message', 'This Category [ ' . $categoryName . ' ] Is Already Name Exist ');
            return redirect()->back();
        }

        $category = Category::find($categoryID);
        $category->name = $categoryName ;
        $category->save();

        Session::flash('message', 'This Category [ ' . $categoryName . ' ] Has Been Updated !! ');
        return redirect()->back();
    }

    public function delete(Request $request)
    {
        $request->validate([
            'category_id' => 'required',
        ]);

        $categoryID = $request->input('category_id');

        $category = Category::destroy($categoryID);
        Session::flash('message', 'This Category Has Been Deleted !!');
        return redirect()->back();
    }

    public function search(Request $request)
    {
        $request->validate([
            'category_search' => 'required',
        ]);

        $searchTerm = $request->input('category_search');

        $categories = Category::where(
            'name', 'LIKE', '%' . $searchTerm . '%'
        )->get();

            if(count($categories) > 0)
            {
                return view('admin.categories.categories')->with([
                    'categories' => $categories,
                    'showLinks' => false ,
                ]);
            }

            Session::flash('message', ' Nothing Found !!');
            return redirect()->back();

    }
}
