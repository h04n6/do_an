<?php

use Illuminate\Database\Seeder;

class TypeProductSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        DB::table('type_product')->insert([
            'id'=>'1',
            'name' => 'Áo sơ mi'
        ]);
          DB::table('type_product')->insert([
            'id'=>'2',
            'name' => 'Áo phông'
        ]);
       DB::table('type_product')->insert([
            'id'=>'3',
            'name' => 'Áo khoác'
        ]);
        DB::table('type_product')->insert([
            'id'=>'4',
            'name' => 'Quần bò'
        ]);
         DB::table('type_product')->insert([
            'id'=>'5',
            'name' => 'Quần âu'
        ]);
           DB::table('type_product')->insert([
            'id'=>'6',
            'name' => 'Quần kaki'
        ]);
          DB::table('type_product')->insert([
            'id'=>'7',
            'name' => 'Váy'
        ]);
           DB::table('type_product')->insert([
            'id'=>'8',
            'name' => 'Quần short'
        ]);
       
    }
     

}
