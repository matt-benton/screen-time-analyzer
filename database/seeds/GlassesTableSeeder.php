<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Glasses;

class GlassesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::findOrFail(1);

        $generic = new Glasses;
        $generic->name = 'Generic';
        $generic->description = 'Generic glasses intended to use anywhere for any purpose.';

        $computer = new Glasses;
        $computer->name = 'Computer';
        $computer->description = 'Near sighted glasses that are for use when reading or working on a computer.';

        $none = new Glasses;
        $none->name = 'None';
        $none->description = "For when I don't wear glasses";

        $user->glasses()->saveMany([$generic, $computer, $none]);
    }
}
