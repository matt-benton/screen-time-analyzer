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
        $green = new EyeCondition;
        $green->name = 'green';
        $green->definition = 'No irritation';
        $green->numeric_value = 3;
        $green->save();

        $yellow = new EyeCondition;
        $yellow->name = 'yellow';
        $yellow->definition = 'Some irritation';
        $yellow->numeric_value = 2;
        $yellow->save();

        $red = new EyeCondition;
        $red->name = 'red';
        $red->definition = 'Severe irritation to the point where I have to stop and do something else.';
        $red->numeric_value = 1;
        $red->save();
    }
}
