<?php

use Illuminate\Database\Seeder;
use App\ProductsAttribute;
class ProductsAttributeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('products_attributes')->delete();
		$productsAttributes =[
			['id'=>1,'product_id'=>1,'size'=>'Small','price'=>1200,'stock'=>10,'sku'=>'BCT01-S','status'=>1],
			['id'=>2,'product_id'=>1,'size'=>'Medium','price'=>1300,'stock'=>15,'sku'=>'BCT01-M','status'=>1],
			['id'=>3,'product_id'=>1,'size'=>'Large','price'=>1400,'stock'=>20,'sku'=>'BCT01-L','status'=>1]
		];
		productsAttribute::insert($productsAttributes);
		
    }
}
