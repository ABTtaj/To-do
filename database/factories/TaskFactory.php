<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Sprint;
use App\Task;
use Faker\Generator as Faker;

$factory->define(Task::class, function (Faker $faker) {
    return [
        'sprint_id'=> function(){
            return factory(Sprint::class)->create();
        },
        'title' => $faker->sentence,
        'description' => $faker->text,
        'is_done' => false
    ];
});
