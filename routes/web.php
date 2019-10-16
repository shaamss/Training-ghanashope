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
use App\Http\Controllers\DataImportController;
use App\Http\Controllers\ProductController;
use App\User;
use App\Image;
use App\Product;
use App\Role;
use App\State;
use App\Tag;

// Route::get('import-test', 'DataImportController@importUnits' );



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


// Route::get('test-email', function(){
//     return 'Hello';
// })->middleware(['auth', 'user_is_admin' ,'user_is_support']);


Route::group(['Auth','user_is_admin'], function () {
    // units
    Route::get('units','UnitController@index')->name('units');
    Route::post('units','UnitController@store');
    Route::delete('units','UnitController@delete');
    Route::put('units','UnitController@update');
    Route::get('search-units','UnitController@search')->name('search-units');

    // categories
    Route::get('categories','CategoryController@index')->name('categories');
    Route::post('categories','CategoryController@store');
    Route::delete('categories','CategoryController@delete');
    Route::put('categories','CategoryController@update');
    Route::get('search-categories','CategoryController@search')->name('search-categories');

    // products
    Route::get('products','ProductController@index')->name('products');

    Route::get('new-product', 'ProductController@newProduct')->name('new-product');
    Route::post('new-product','ProductController@store');
    Route::get('update-product/{id}', 'ProductController@newProduct')->name('update-product');

    Route::put('update-product', 'ProductController@update')->name('update-product');
    Route::delete('products/{id}','ProductController@delete');

    // tags
    Route::get('tags','TagController@index')->name('tags');
    Route::post('tags','TagController@store');
    Route::delete('tags','TagController@delete');
    Route::put('tags','TagController@update');
    Route::post('search-tags','TagController@search')->name('search-tags');
    // orders
    // payments
    // shipments

    // countries
    Route::get('countries','CountryController@index')->name('countries');

    // states

    Route::get('states', 'StateController@index')->name('states');

    // cities
    Route::get('cities', 'CityController@index')->name('cities');

    // reviews
    Route::get('reviews', 'ReviewController@index')->name('reviews');

    // tickets
    Route::get('tickets','TicketController@index')->name('tickets');

    // roles
    Route::get('roles','RoleController@index')->name('roles');

});
