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
        $user = User::findOrFail(1);

        $morning = new Daytime;
        $morning->name = 'Morning';
        $morning->description = 'before lunch';

        $afternoon = new Daytime;
        $afternoon->name = 'Afternoon';
        $afternoon->description = 'after lunch/before dinner';

        $evening = new Daytime;
        $evening->name = 'Evening';
        $evening->description = 'after dinner';

        $user->daytimes()->saveMany([$morning, $afternoon, $evening]);
    }
}
