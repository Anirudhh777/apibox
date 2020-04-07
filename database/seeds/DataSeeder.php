<?php

use Illuminate\Database\Seeder;

class DataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $path = base_path().'/database/seeds/dumpdata.sql';
	    $sql = file_get_contents($path);
	    DB::unprepared($sql);
    }
}
