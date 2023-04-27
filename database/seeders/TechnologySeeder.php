<?php

namespace Database\Seeders;

use App\Models\Technology;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class TechnologySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $technologies = ['HTML', 'CSS', 'Bootstrap', 'Tailwind', 'JavaScript', 'VueJs', 'Php', 'Laravel', 'MySql'];

        foreach ($technologies as $tec_name) {
            $tec = new Technology();
            $tec->name = $tec_name;
            $tec->slug = Str::slug($tec_name);
            $tec->save();
        }
    }
}
