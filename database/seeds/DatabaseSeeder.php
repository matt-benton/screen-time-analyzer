<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersTableSeeder::class);
        $this->call(DaytimesTableSeeder::class);
        $this->call(SymptomsTableSeeder::class);
        $this->call(ActivitiesTableSeeder::class);
        $this->call(MonitorsTableSeeder::class);
        $this->call(GlassesTableSeeder::class);
        $this->call(SeatsTableSeeder::class);
        $this->call(EyeConditionsTableSeeder::class);
    }
}
