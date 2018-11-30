
<?php

use Illuminate\Database\Seeder;

class CustomerSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        DB::table('customer')->insert([
            
            'name' => 'customer1',
            'username'=>'customer1',
            'password'=>encrypt('123456'),
            'id_city'=>'01',
            'id_county'=>'01',
            'id_ward'=>'01',
            'phone'=>'0999999999',
            'email'=>'jacky.cuog.7@gmail.com'
        ]);
          DB::table('customer')->insert([
           
            'name' => 'customer2',
            'username'=>'customer2',
            'password'=>encrypt('123456'),
            'id_city'=>'31',
            'id_county'=>'308',
            'id_ward'=>'01',
            'phone'=>'0999999999',
            'email'=>'jacky.cuog.7@gmail.com'
        ]);
       DB::table('customer')->insert([
           
            'name' => 'customer3',
            'username'=>'customer3',
            'password'=>encrypt('123456'),
            'id_city'=>'31',
            'id_county'=>'313',
            'id_ward'=>'01',
            'phone'=>'0999999999',
            'email'=>'jacky.cuog.7@gmail.com'
        ]);
        DB::table('customer')->insert([
          
            'name' => 'customer4',
            'username'=>'customer4',
            'password'=>encrypt('123456'),
            'id_city'=>'31',
            'id_county'=>'304',
            'id_ward'=>'01',
            'phone'=>'0999999999',
            'email'=>'jacky.cuog.7@gmail.com'
        ]);
         DB::table('customer')->insert([
       
            'name' => 'customer5',
            'username'=>'customer5',
            'password'=>encrypt('123456'),
            'id_city'=>'01',
            'id_county'=>'01',
            'id_ward'=>'01',
            'phone'=>'0999999999',
            'email'=>'jacky.cuog.7@gmail.com'
        ]);
        DB::table('customer')->insert([
      
            'name' => 'customer6',
            'username'=>'customer6',
            'password'=>encrypt('123456'),
            'id_city'=>'01',
            'id_county'=>'01',
            'id_ward'=>'01',
            'phone'=>'0999999999',
            'email'=>'jacky.cuog.7@gmail.com'
        ]);
    }
     

}
