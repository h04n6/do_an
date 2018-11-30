<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UserTableSeeder::class);
        $this->call(ConfigTableSeeder::class);
        $this->call(RoleTableSeeder::class);
        // $this->call(ManufacturerSeeder::class);
        // $this->call(TypeProductSeeder::class);
        // $this->call(ProductSeeder::class);
        
        // $this->call(CustomerSeeder::class);
        
        // $this->call(BillSeeder::class);
        // $this->call(BillDetailSeeder::class);
        // $this->call(ShippersSeeder::class);
        // $this->call(StoreSeeder::class);
        // $this->call(ProductStoreSeeder::class);
        //  $this->call(SizeSeeder::class);
        // $this->call(ColorSeeder::class);
           
          
    }
}
