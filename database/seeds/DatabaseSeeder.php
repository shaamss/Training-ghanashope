<?php

use App\Address;
use App\Image;
use Illuminate\Database\Seeder;
use App\User;
use App\Product;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        //$this->call(UsersTableSeeder::class);
        factory(Address::class, 1000 )->create();
        factory(User::class, 500 )->create();
        factory(Product::class, 1500)->create();
        factory(Image::class, 3500)->create();

    }
}
