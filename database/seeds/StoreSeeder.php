<?php

use Illuminate\Database\Seeder;

class StoreSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        DB::table('store')->insert([
            
            'name' => 'Kho 1',
            'address'=>'Hà Nội'

        ]);
        DB::table('store')->insert([
            
            'name' => 'Kho 2',
            'address'=>'HCM'

        ]);
        
       
    }
     

}
