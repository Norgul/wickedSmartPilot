<?php

use Illuminate\Database\Seeder;

class LocationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $locations = $this->command->ask('How many locations would you like to be inserted?', 50);

        $locations = intval($locations) ?? 50;

        factory('App\Location', $locations)->create();

        $this->command->line(sprintf('%d locations added into database', $locations));
    }
}
