<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

$factory->define(Iba\User::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->email,
        'password' => bcrypt(str_random(10)),
        'remember_token' => str_random(10),
    ];
});



$factory->define(Iba\Models\Object::class, function (Faker\Generator $faker) {
    return [
        'issn'          => str_random(10),
        'active'        => 1,
        'license_id'    => 1,
        'type_id'       => 1,
        'filetype_id'   => 1,
        'thread_id'     => 1,
        'topic_id'      => 1,
        'subtopic_id'   => 1,
        'created_by'    => 1
    ];
});


$factory->define(Iba\Models\ObjectTranslation::class, function (Faker\Generator $faker) {
    return [
        'title'     => $faker->sentence($nbWords = 6, $variableNbWords = true),
        'preamble'  => $faker->text($maxNbChars = 200),
        'source'    => $faker->text($maxNbChars = 200),
        'locale'    => 'pt_br'
    ];
});


$factory->define(Iba\Models\News::class, function (Faker\Generator $faker) {
    return [
        'status'    => 1,
        'date'       => $faker->date($format = 'Y-m-d', $max='now'),
        'news_editorial_id'   => 1
    ];
});


$factory->define(Iba\Models\NewsTranslation::class, function (Faker\Generator $faker) {
    return [
        'title'             => $faker->sentence($nbWords = 6, $variableNbWords = true),
        'featured_title'    => $faker->text($maxNbChars = 200),
        'source'            => $faker->text($maxNbChars = 200),
        'content'           => $faker->paragraph($nbSentences = 15, $variableNbSentences = true),
        'locale'            => 'pt_br'
    ];
});

$factory->define(Iba\Models\NewsImage::class, function (Faker\Generator $faker) {
    return [
        'image'             => $faker->image($dir = '/var/www/Locness_HTDOCS/iba/trunk/public/uploads/noticias', $width = 165, $height = 92)
    ];
});