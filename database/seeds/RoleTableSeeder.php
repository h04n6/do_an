<?php

use Illuminate\Database\Seeder;

class RoleTableSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        DB::table('role')->insert([
            'id' => '1',
            'name' => 'Adminstrator',
            'route' => 'all'
        ]);
        DB::table('role')->insert([
            'id' => '2',
            'name' => 'Nhân viên bán hàng',
            'route' => 'admin.index,admin.block.index,admin.block.create,admin.block.store,admin.block.edit,admin.block.update,admin.block.destroy,admin.testimonial.index,admin.testimonial.create,admin.testimonial.store,admin.testimonial.edit,admin.testimonial.update,admin.testimonial.destroy'
        ]);
        DB::table('role')->insert([
            'id' => '3',
            'name' => 'Quản lý kho',
            'route' => 'admin.index,admin.customer.index,admin.affiliate.create,admin.customer.store,admin.customer.destroy,admin.affiliate.edit,admin.affiliate.update,admin.affiliate.detail,admin.affiliate.toggle,admin.affiliate.toggleGroup,admin.affiliate.report'
        ]);
        DB::table('role')->insert([
            'id' => '4',
            'name' => 'Quản trị nội dung',
            'route' => 'admin.index,admin.customer.index,admin.affiliate.create,admin.customer.store,admin.customer.destroy,admin.affiliate.edit,admin.affiliate.update,admin.affiliate.detail,admin.affiliate.toggle,admin.affiliate.toggleGroup,admin.affiliate.report'
        ]);
        DB::table('role')->insert([
            'id' => '5',
            'name' => 'Khách hàng',
            'route' => 'home,cartPage,productDetail,checkout,addToCart,cart,delProductInCart,updateCart,categoryProduct'
        ]);
        
    }

}
