<?php

use App\User;
use App\Admin;
use App\Category;
use App\Product;
use Illuminate\Support\Str;
use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(User::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'address'=> $faker->address,
        'phone_number'=>$faker->e164PhoneNumber,
        'email_verified_at' => now(),
        'password' => Hash::make('11111111'), // password
        'confirmed'=>'0',
        'locked'=>'0',
        'remember_token' => Str::random(10),
    ];
});
$factory->define(Admin::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        'remember_token' => Str::random(10),
    ];
});

$factory->define(Category::class, function (Faker $faker) {
    $name = $faker->unique()->word;
    return [
        'slug' => $name,
        'name' => $name,
    ];
});

$factory->define(Product::class, function (Faker $faker) {
    $name = $faker->unique()->word;
    return [
        'admin_id' => function () {
            return factory('App\Admin')->create()->id;
        },
        'category_id' => function () {
            return factory('App\Category')->create()->id;
        },
        'thumnail'=>'http://localhost/Laravel/shop/public/photos/1/download.jpg',
        'image'=>json_encode(['http://localhost/Laravel/shop/public/photos/1/download.jpg','http://localhost/Laravel/shop/public/photos/1/55560418_2085099621559601_5143407298999222272_n.jpg']),
        'product_name' => $name,
        'slug' => $name,
        'published'=>false,
        'short_description'=>$faker->text,
        'full_description'=>$faker->text,
        'price'=>$faker->numberBetween(0,1000000),
        'tax'=>$faker->numberBetween(0,1000000),
        'fee_ship'=>$faker->numberBetween(0,1000000),

    ];
});
