<?php

use Illuminate\Database\Seeder;

class ManufacturerSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        DB::table('manufacturer')->insert([
            'id'=>'1',
            'name' => 'The Blue Exchange'
        ]);
          DB::table('manufacturer')->insert([
            'id'=>'2',
            'name' => 'Canifa'
        ]);
       DB::table('manufacturer')->insert([
            'id'=>'3',
            'name' => 'Hoang Phuc International'
        ]);
        DB::table('manufacturer')->insert([
            'id'=>'4',
            'name' => 'Elise'
        ]);
         DB::table('manufacturer')->insert([
            'id'=>'5',
            'name' => 'Lime Orange'
        ]);
        DB::table('manufacturer')->insert([
            'id'=>'6',
            'name' => 'NEM Fashion'
        ]);
    }
     

}
