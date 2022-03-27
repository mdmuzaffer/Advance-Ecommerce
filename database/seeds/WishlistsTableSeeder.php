<?php

use Illuminate\Database\Seeder;
use App\Wishlist;
class WishlistsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('wishlists')->delete();
		$wishlist = [
			['id'=>1,'user_id'=>'2','product_id'=>'17'],
			['id'=>2,'user_id'=>'3','product_id'=>'8'],
			['id'=>3,'user_id'=>'8','product_id'=>'12'],
			['id'=>4,'user_id'=>'5','product_id'=>'4'],
		];
		Wishlist::insert($wishlist);
    }
}
