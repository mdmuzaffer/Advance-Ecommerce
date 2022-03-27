<?php

use Illuminate\Database\Seeder;
use App\CmsPage;
class CmsPagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $cmsPagesRecord =[
			['id'=>1,'title'=>'About Us','description'=>'Coming soon about page','url'=>'about-us','meta_title'=>'about E-commerce','meta_description'=>'about E-commerce cms page','meta_keywords'=>'E-commerce about','status'=>'1'],
			['id'=>2,'title'=>'Privacy Policy','description'=>'Coming soon privacy page','url'=>'privacy-policy','meta_title'=>'privacy E-commerce','meta_description'=>'privacy policy E-commerce cms page','meta_keywords'=>'E-commerce privacy','status'=>'1'],
		];
		
		CmsPage::insert($cmsPagesRecord);
    }
}
