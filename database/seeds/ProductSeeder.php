<?php

use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        DB::table('products')->insert([
            'id_product'=>'SP1001',
            'name' => 'Quần kaki nam',
            'id_type' => '6',
            'gender'=>'0',
            'description' => 'Quần nam chất liệu đẹp',
            'import_price'=>'70000',
            'price'=>'120000',
            'promotion_price'=>'100000',
            'image'=>'uploads/kaki1.jpg',
            'id_manufacturer'=>'1',
            'new'=>'1',
            'hot'=> '0'
        ]);
         DB::table('products')->insert([
            'id_product'=>'SP1002',
            'name' => 'áo phông cute',
            'id_type' => '2',
            'gender'=>'1',
            'description' => 'Áo đẹp',
            'import_price'=>'100000',
            'price'=>'150000',
            'promotion_price'=>'90000',
            'image'=>'uploads/aonu1.jpg',
            'id_manufacturer'=>'2',
            'new'=>'0',
            'hot'=> '0'
        ]);
          DB::table('products')->insert([
            'id_product'=>'SP1003',
            'name' => ' Áo khoác songoku',
            'id_type' => '3',
            'gender'=>'0',
            'description' => 'Chất liệu đẹp phù hợp tuổi teen',
            'import_price'=>'75000',
            'price'=>'150000',
            'promotion_price'=>'11000',
            'image'=>'uploads/ao_thun4.jpg',
            'id_manufacturer'=>'3',
            'new'=>'1',
            'hot'=> '1'
        ]);
        DB::table('products')->insert([
            'id_product'=>'SP1004',
           'name' => ' Áo phôn thu đông',
            'id_type' => '2',
            'gender'=>'0',
            'description' => 'Chất liệu đẹp phù hợp tuổi teen',
            'import_price'=>'70000',
            'price'=>'120000',
            'promotion_price'=>'0',
            'image'=>'uploads/ao_thun1.jpg',
            'id_manufacturer'=>'3',
            'new'=>'1',
            'hot'=> '1'
        ]);
       
    }
     

}
