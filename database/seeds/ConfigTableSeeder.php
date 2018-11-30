<?php

use Illuminate\Database\Seeder;

class ConfigTableSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        DB::table('config')->insert([
            'id' => '1',
            'title' => 'Your website',
            'company_name' => "Your company's name"
        ]);
        
    }

}
