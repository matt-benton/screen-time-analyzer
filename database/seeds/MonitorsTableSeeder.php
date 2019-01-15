<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Monitor;

class MonitorsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::findOrFail(1);

        $asus = new Monitor;
        $asus->name = 'ASUS';
        $asus->description = 'Gaming monitor';
        $asus->resolution = '1920x1080';
        $asus->refresh_rate = '144hz';
        $asus->screen_size = '24';

        $benq = new Monitor;
        $benq->name = 'BenQ';
        $benq->description = 'Eye care monitor';
        $benq->resolution = '3840x2160';
        $benq->refresh_rate = '60hz';
        $benq->screen_size = '31.5';

        $tv = new Monitor;
        $tv->name = 'TV';
        $tv->description = 'My TV';
        $tv->resolution = '1920x1080';
        $tv->refresh_rate = '60hz';
        $tv->screen_size = '43';

        $user->monitors()->saveMany([$asus, $benq, $tv]);
    }
}
