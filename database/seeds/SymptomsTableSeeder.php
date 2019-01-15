<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Symptom;

class SymptomsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::findOrFail(1);

        $dryness = new Symptom;
        $dryness->name = 'Dryness';
        $dryness->description = 'Dry, itchy, crusty eyes.';

        $soreness = new Symptom;
        $soreness->name = 'Soreness';
        $soreness->description = 'Sore eyes';

        $burning = new Symptom;
        $burning->name = 'Burning';
        $burning->description = 'Burning eyes';

        $user->symptoms()->saveMany([$dryness, $soreness, $burning]);
    }
}
