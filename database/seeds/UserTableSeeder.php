<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        DB::table('user')->insert([
            'username' => 'admin',
            'name' => 'Administrator',
            'password' => bcrypt('123456'),
            'role_id' => '1'
        ]);
        DB::table('user')->insert([
            'username' => 'admin2',
            'name' => 'Admin 2',
            'password' => bcrypt('123456'),
            'role_id' => '2'
        ]);
        DB::table('user')->insert([
            'username' => 'admin3',
            'name' => 'Admin 3',
            'password' => bcrypt('123456'),
            'role_id' => '3'
        ]);
        DB::table('user')->insert([
            'username' => 'admin4',
            'name' => 'Admin 4',
            'password' => bcrypt('123456'),
            'role_id' => '4'
        ]);


        DB::table('user')->insert([
            'username' => 'customer1',
            'name' => 'customer1',
            'password' => bcrypt('123456'),
            'address'=>'Hải Phòng, Đồ Sơn , Bàng La',
            'role_id' => '5'
        ]);
        DB::table('user')->insert([
            'username' => 'customer2',
            'name' => 'customer2',
            'password' => bcrypt('123456'),
            'address'=>'Hải Phòng, Chợ hàng ,Miếu 2 Xã',
            'role_id' => '5'
        ]);
        DB::table('user')->insert([
            'username' => 'customer3',
            'name' => 'customer3',
            'password' => bcrypt('123456'),
            'address'=>'Hải Phòng,An Lão, Thái Sơn',
            'role_id' => '5'
        ]);
        DB::table('user')->insert([
            'username' => 'customer4',
            'name' => 'customer4',
            'password' => bcrypt('123456'),
            'role_id' => '5'
        ]);


        
        
    }

}
