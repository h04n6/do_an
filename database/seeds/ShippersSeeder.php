
<?php

use Illuminate\Database\Seeder;

class ShippersSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        DB::table('shippers')->insert([
            
            'name' => 'Ship Hoàng',
            'phone'=>'0986999796',
            'total_order'=>'2',
            'address'=>'Miếu 2 xã hải phòng'
        ]);
          DB::table('shippers')->insert([
           
            'name' => 'Ship Toàn',
            'phone'=>'0986999796',
            'total_order'=>'5',
            'address'=>'Bàng la Đồ Sơn'
        ]);
       DB::table('shippers')->insert([
           
            'name' => 'Ship Hữu',
            'phone'=>'0986999796',
            'total_order'=>'1',
            'address'=>'Lạch tray HP'
        ]);
    
    }
     

}
