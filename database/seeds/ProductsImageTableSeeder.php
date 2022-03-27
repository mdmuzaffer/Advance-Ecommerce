<?php

use Illuminate\Database\Seeder;
use App\ProductsImage;
class ProductsImageTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $productImagesRecord =[
			['id'=>1,'product_id'=>1,'image'=>'1607754954.jpeg','status'=>1]
		];
		ProductsImage::insert($productImagesRecord);
    }
}
