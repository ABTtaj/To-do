<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Project;
use App\Sprint;
use Faker\Generator as Faker;

$factory->define(Sprint::class, function (Faker $faker) {
    return [
        'project_id'=> function(){
            return factory(Project::class)->create();
        },
        'title' => $faker->sentence,
        'description' => $faker->text
    ];
});
