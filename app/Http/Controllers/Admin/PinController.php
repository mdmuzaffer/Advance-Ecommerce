<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Session;
use DB;
class PinController extends Controller
{
    public function importPin(Request $request){
	
		session::put('page','exchange');
		$title ="Import pin";
		$button ="Import";
		if($request->isMethod('post')){
			$data = $request->all();
			
			if($request->hasFile('import')){
				if($request->file('import')->isvalid()){
					$file = $request->file('import');
					$pathDestination = public_path('import/pincode');
					$text = $file->getClientOriginalName();
					$filename = "pincode_".rand()."_".$text;
					$file->move($pathDestination,$filename);
					//return back()->with('success','Pincode file uploaded successfully !');
				}
			}
			$file = public_path('/import/pincode/'.$filename);
			$pincode = $this->csvToArray($file); // convert CSV to array
			/* echo "<pre>";
			print_r($pincode);
			die; */
			$latestpincod = array();
			foreach($pincode as $key=>$pincodes){
				$latestpincod[$key]['pincode'] = $pincodes['pincode'];
				$latestpincod[$key]['city'] = $pincodes['city'];
				$latestpincod[$key]['state'] = $pincodes['state'];
				$latestpincod[$key]['country'] = $pincodes['country'];
				$latestpincod[$key]['created_at'] = date('Y-m-d H:i:s');
				$latestpincod[$key]['updated_at'] = date('Y-m-d H:i:s');
			}
			
			DB::table('code_pincodes')->delete();
			//DB::update("Alter table code_pincodes AUTO_INCREMENT = 1;");
			
			$chunks = array_chunk($latestpincod, 200);
			foreach ($chunks as $chunk) {
				DB::table('code_pincodes')->insert($chunk);
			}
			return back()->with('success','Pincode file uploaded successfully !');
		}
		return view('admin.import.pincode_import')->with(['controller'=>'import','title'=>$title,'button'=>$button,'page_type'=>'admin_page']);
	}
	
	
	public function csvToArray($filename = '', $delimiter = ','){
        if (!file_exists($filename) || !is_readable($filename))
            return false;
            $header = null;
            $data = array();
            if (($handle = fopen($filename, 'r')) !== false){
                while (($row = fgetcsv($handle, 1000, $delimiter)) !== false){
                if (!$header)
                    $header = $row;
                else
                    $data[] = array_combine($header, $row);
                }
            fclose($handle);
            }
        return $data;
    }
	
	public function csvToArray11($file=''){
		$csvData = file_get_contents($file);
		$lines = explode(PHP_EOL, $csvData);
		$array = array();
		foreach ($lines as $line) {
			$array[] = str_getcsv($line);
		}
		return $array;
	}
}
