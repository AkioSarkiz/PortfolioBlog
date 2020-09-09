<?php

/** @var Factory $factory */

use App\Models\Post;
use App\Models\User;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;

$factory->define(Post::class, function (Faker $faker) {
    return [
        "title" => $faker->text,
        "id_author" => rand(1, User::all()->count()),
        "content" => $faker->realText(1000),
        "description" => $faker->text,
        "media" => [
            "cover" => $faker->image(__DIR__ . '/../../storage/app/public/uploads', 1280, 720, [
                'abstract', 'animals', 'business', 'cats', 'city', 'food', 'nightlife',
                'people', 'nature', 'technics', 'transport',
            ][rand(0, 10)], false),
        ],
    ];
});
