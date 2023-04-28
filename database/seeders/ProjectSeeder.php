<?php

namespace Database\Seeders;

use App\Models\Project;
use App\Models\Technology;
use App\Models\Type;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        $type_ids = Type::all()->pluck('id')->all();
        $tec_ids = Technology::all()->pluck('id')->all();
        $user_ids = User::all()->pluck('id')->all();

        for ($i = 0; $i < 25; $i++) {

            $first_name = $faker->firstName();
            $last_name = $faker->lastName();

            $project = new Project();
            $project->title = $faker->unique()->words(5, true);
            $project->slug = Str::slug($project->title, '-');
            $project->customer = $first_name . ' ' . $last_name;
            $project->description = $faker->optional()->text();
            $project->url = $faker->optional()->url();
            $project->type_id = $faker->optional()->randomElement($type_ids);
            $project->user_id = $faker->randomElement($user_ids);
            $project->save();

            $project->technologies()->attach($faker->optional()->randomElements($tec_ids, rand(0, 9)));
        }
    }
}
