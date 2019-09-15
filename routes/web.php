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
    Route::get('units','UnitController@index')->name('units');
    Route::get('add-unit', 'UnitController@showAdd')->name('new-unit');
});
