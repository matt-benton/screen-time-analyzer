<?php

use Illuminate\Database\Seeder;
use App\Daytime;
use App\User;

class DaytimesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $morning = new Daytime;
        $morning->name = 'Morning';
        $morning->description = 'before lunch';
        $morning->save();

        $afternoon = new Daytime;
        $afternoon->name = 'Afternoon';
        $afternoon->description = 'after lunch/before dinner';
        $afternoon->save();

        $evening = new Daytime;
        $evening->name = 'Evening';
        $evening->description = 'after dinner';
        $evening->save();
    }
}
