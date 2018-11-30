
<?php

use Illuminate\Database\Seeder;

class SizeSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        DB::table('size')->insert([
            
            'size_name' => 'S'
           
        ]);
         DB::table('size')->insert([
            
            'size_name' => 'M'
           
        ]);
       DB::table('size')->insert([
            
            'size_name' => 'L'
           
        ]);
       DB::table('size')->insert([
            
            'size_name' => 'XL'
           
        ]);
       DB::table('size')->insert([
            
            'size_name' => 'XXL'
           
        ]);
    
    }
     

}
