<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use App\City;
use App\Country;
use App\User;
use App\Image;
use App\Product;
use App\Role;
use App\State;
use App\Tag;

Route::get('states', function () {

    return State::with(['country', 'cities'])->paginate(5);

});

Route::get('users', function () {
    return User::paginate(50);
});

Route::get('product', function () {
    return Product::with(['images'])->paginate(50);
});

Route::get('images', function () {
    return Image::with(['product'])-> paginate(100);
});


Route::get('/', function () {
    return view('welcome');
});


Route::get('role-test', function () {
    // $user =User::find(1);
    // return $user->roles;

    $role =Role::find(2);
    return $role->users;
});

Route::get('tag-test', function () {
    // $tag = Tag::find(5);
    // return $tag->products;

    $product = Product::find(2);
    return $product->tags;
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


Route::get('test-email', function(){
    return 'Hello';
})->middleware(['auth', 'user_is_admin' ,'user_is_support']);
