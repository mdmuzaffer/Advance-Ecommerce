<?php

use Illuminate\Database\Seeder;
use App\Category;
class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->delete();
        $categoryRecord =[
		['id'=>1,'parent_id'=>0,'section_id'=>1,'category_name'=>'T-shirt','category_image'=>'Null',
		'category_discount'=>0,'description'=>'this is the category description','url'=>'t-shirt','meta_title'=>'Null',
		'meta_description'=>'Null','meta_keywords'=>'Null','status'=>1],
		['id'=>2,'parent_id'=>1,'section_id'=>1,'category_name'=>'Casual-T-shirt','category_image'=>'Null',
		'category_discount'=>0,'description'=>'this is the causal category description','url'=>'casual-t-shirt','meta_title'=>'Null',
		'meta_description'=>'Null','meta_keywords'=>'Null','status'=>1]
		
		];
		Category::insert($categoryRecord);
    }
}
