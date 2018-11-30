<?php

use Illuminate\Database\Seeder;

class ProductStoreSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        DB::table('product_store')->insert([
            'id_product'=>'SP1001',
            'id_store'=>'1',
            'number'=>'50'
           
        ]);
          DB::table('product_store')->insert([
              'id_product'=>'SP1002',
            'id_store'=>'1',
            'number'=>'30'
           
        ]);
       DB::table('product_store')->insert([
            'id_product'=>'SP1003',
            'id_store'=>'1',
            'number'=>'30'
           
        ]);
        DB::table('product_store')->insert([
            'id_product'=>'SP1004',
            'id_store'=>'1',
            'number'=>'55'
           
        ]);
        DB::table('product_store')->insert([
            'id_product'=>'SP1001',
            'id_store'=>'2',
            'number'=>'20'
           
        ]);
          DB::table('product_store')->insert([
              'id_product'=>'SP1002',
            'id_store'=>'2',
            'number'=>'50'
           
        ]);
       DB::table('product_store')->insert([
            'id_product'=>'SP1003',
            'id_store'=>'2',
            'number'=>'30'
           
        ]);
        DB::table('product_store')->insert([
            'id_product'=>'SP1004',
            'id_store'=>'2',
            'number'=>'45'
           
        ]);
     
    }
     

}
