<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Seat;

class SeatsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::findOrFail(1);

        $mesh = new Seat;
        $mesh->name = 'Mesh';
        $mesh->description = 'Ergonomic office chair with mesh back and mesh seat.';

        $vertagear = new Seat;
        $vertagear->name = 'Vertagear';
        $vertagear->description = 'Vertagear racecar gaming chair.';

        $standing = new Seat;
        $standing->name = 'Standing';
        $standing->description = 'Standing with no seat.';

        $user->seats()->saveMany([$mesh, $vertagear, $standing]);
    }
}
