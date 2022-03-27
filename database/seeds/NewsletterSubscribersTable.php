<?php

use Illuminate\Database\Seeder;
Use App\NewsletterSubscriber;
class NewsletterSubscribersTable extends Seeder
{
    /**
	NewsletterSubscriber
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('newsletter_subscribers')->delete();
		$newsletterSubscribers =[
			['id'=>'1','email'=>'developer123@yopmail.com','status'=>'0']
		];
		NewsletterSubscriber::insert($newsletterSubscribers);
    }
}
