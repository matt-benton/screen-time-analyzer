<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Activity;

class ActivitiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::findOrFail(1);

        $coding = new Activity;
        $coding->name = 'Coding';
        $coding->description = 'Writing code';

        $errands = new Activity;
        $errands->name = 'Errands';
        $errands->description = 'Checking email, using Excel, paying bills, etc.';

        $gaming = new Activity;
        $gaming->name = 'Gaming';
        $gaming->description = 'Playing a videogame';

        $user->activities()->saveMany([$coding, $errands, $gaming]);
    }
}
