<?php

use Illuminate\Database\Seeder;
use App\User;
use App\EyeCondition;

class EyeConditionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::findOrFail(1);

        $green = new EyeCondition;
        $green->name = 'Green';
        $green->definition = 'No irritation';

        $orange = new EyeCondition;
        $orange->name = 'Orange';
        $orange->definition = 'Some irritation';

        $red = new EyeCondition;
        $red->name = 'Red';
        $red->definition = 'Severe irritation to the point where I have to stop and do something else.';

        $user->eyeConditions()->saveMany([$green, $orange, $red]);
    }
}
