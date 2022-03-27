<?php

use Illuminate\Database\Seeder;
use App\Section;
class SectionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('sections')->delete();
		$sectionsRecords =[
			['id'=>'1','name'=>'Man','status'=>'1'],
			['id'=>'2','name'=>'Woman','status'=>'1'],
			['id'=>'3','name'=>'Kids','status'=>'1'],
		];
		Section::insert($sectionsRecords);
    }
}
