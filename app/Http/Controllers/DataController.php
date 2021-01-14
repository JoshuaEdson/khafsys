<?php

namespace App\Http\Controllers;

// use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Http\Request;
use App\Questionnaire;
use DB;
use Phppot\DataSource;
use App\Page;
use Config;



class DataController extends Controller
{

	public function index($table){
		$tablename = $table;
		$tables = DB::select('SHOW TABLES');
		$tables = array_map('current',$tables);

		$allColumns = Schema::getColumnListing($tablename);
		$allColumnsNew = [];
		$allColumnsCount = 0;
		$firstColumn = "";
		foreach ($allColumns as $ac) {
			// echo $ac;
			if($ac == 'index' || $ac == 'Nom' || $ac == 'Index' || $ac == 'INDEX' || $ac == 'No.' || $ac == 'No' || $ac == 'id' || $ac == 'Id' || $ac == 'ID'){
				//skip
			} else if($ac != 'index' || $ac != 'Nom' || $ac != 'Index' || $ac != 'INDEX' || $ac != 'No.' || $ac != 'No' || $ac != 'id' || $ac != 'Id' || $ac != 'ID'){
				array_push($allColumnsNew, $ac);
				$allColumnsCount++;
			}
		}
		// return $allColumnsNew;
		foreach ($allColumns as $column1) {
			$firstColumn .= $column1;
			break;
		}

		$allDataColumn = [];
		$allDataCount = [];
		$allDataBody = [];
		foreach ($allColumnsNew as $acn) {

			$fullData = DB::table($tablename)->select($firstColumn, $acn)->distinct($firstColumn)->get();
			$fullDataCount = $fullData->countBy($acn)->values()->toArray();
			$fullDataBody = $fullData->pluck($acn)->unique()->values()->toArray();

			array_push($allDataBody, $fullDataBody);
			array_push($allDataCount, $fullDataCount);

		}

		return view('admn_dshbrd', compact('allDataBody', 'allDataCount', 'tablename', 'tables', 'allColumnsNew'));
	}

	

	public function getAdminDashboardData(Request $request)
	{
		$tablename = $request->input("tableList");
		return redirect(url()->current().'/'.$tablename);
	}



	public function analysis($table)
	{
		// $table = new Questionnaire;
		$tablename = $table;
		// return $tablename;
		$tables = DB::select('SHOW TABLES');
		$tables = array_map('current',$tables); //display all database in array. 
		$data = DB::table($tablename)->paginate(15);

		$allColumnsname = Schema::getColumnListing($tablename);

    	return view ('analysis', compact('allColumnsname', 'data', 'tablename', 'tables'));//->withData ($data);
    }

    public function analysis_tools($table)
    {
    	$tablename = $table;
    	// return $tablename;
    	$tables = DB::select('SHOW TABLES');
		$tables = array_map('current',$tables); //display
		    	// return $tables;
		$Data1SetlabelX = [];
		$Data1SetlabelY = [];
		$Data2SetlabelX = [];
		$Data3SetlabelY = [];
		$rData1Chunked = [];
		$rData2Chunked = [];
		$allColumnsname = Schema::getColumnListing($tablename);
		// $data = DB::table($tablename)->paginate(15);
		// //get all column name
		// $allColumnsname = Schema::getColumnListing('masterdata');
		$totalData = "";
		$var1 = ""; // to set a null value which can be use when database changed
		$var2 = ""; // to set a null value which can be use when database changed
		$var3 = ""; // to set a null value which can be use when database changed
		$PnDChartData1 = "";
		$PnDChartData2 = "";
		$Data3Setlabela = "";
		return view('analysis_tools', compact('Data3Setlabela','PnDChartData1', 'PnDChartData2', 'totalData','allColumnsname', 'var1', 'var2', 'var3', 'data', 'tables', 'tablename', 'Data2SetlabelX', 'Data1SetlabelX', 'rData1Chunked', 'Data1SetlabelY','rData2Chunked'));
	}

	public function uploadData(Request $request)
	{
		$uploadbtn = $request->input("upload");		
		$ChgDBbtn = $request->input("dataTable");
		
		if ($ChgDBbtn){
			// return $ChgDBbtn;
			$tablename = $request->input("tableList");
		// return $tablename;
			$tables = DB::select('SHOW TABLES');
		$tables = array_map('current',$tables); //display all database in array. 
		$data = DB::table($tablename)->paginate(15);

		$allColumnsname = Schema::getColumnListing($tablename);

		return redirect(url()->current().'/'.$tablename);

	} else if ($uploadbtn){

		$datasetName = $request->input("datasetName");
			// $file = $request->input("file");

		$fileName = $_FILES["file"]["tmp_name"];
		// return $fileName;
			// get structure from csv and insert db
		ini_set('auto_detect_line_endings',TRUE);
		$handle = fopen($fileName,'r');
// first row, structure
		if ( ($data = fgetcsv($handle) ) === FALSE ) {
			echo "Cannot read from csv $fileName";
			die();
		}
		$fields = array();
		$field_count = 0;
			// $f = "(";
			// return $data;
		for($i=0;$i<count($data); $i++) {
			$f = strtolower(trim($data[$i]));
				// $f = "";
			if ($f) {
        // normalize the field name, strip to 20 chars if too long
					// $f = substr(preg_replace ('/[^0-9a-z]/', '_', $f), 0, 20);
				$field_count++;
				$fields[] = "`".$f."`".' varchar(250) DEFAULT NULL';
			}
		};

		DB::select("CREATE TABLE $datasetName (" . implode(', ', $fields) . ')');

		while ( ($data = fgetcsv($handle) ) !== FALSE ) {
			$fields = array();
			for($i=0;$i<$field_count; $i++) {
				$fields[] = '\''.addslashes($data[$i]).'\'';
			}
			$sql = "Insert into $datasetName values(" . implode(', ', $fields) . ')';
			DB::select($sql);
		}
		fclose($handle);

		$tablename = $request->input("tableList");
		$tables = DB::select('SHOW TABLES');
		$tables = array_map('current',$tables); //display

		$allColumnsname = Schema::getColumnListing($tablename);
		$data = DB::table($tablename)->paginate(15);

		return view('analysis', compact('allColumnsname', 'data', 'tables', 'tablename'));
	}
}


public function postData(Request $request)
{	
	$getTButtonTable = $request->input("dataTable");
	$getButtonSubmit = $request->input("submit");

	if($getTButtonTable){

		$tablename = $request->input("tableList");
		$tables = DB::select('SHOW TABLES');
		$tables = array_map('current',$tables); //display all database in array. 
		$data = DB::table($tablename)->paginate(15);
		$allColumnsname = Schema::getColumnListing($tablename);

		return redirect(url()->current().'/'.$tablename);

	} else if($getButtonSubmit){
		$tablename = $request->input("tableList");

		$tables = DB::select('SHOW TABLES');
		$tables = array_map('current',$tables); 

		$allColumnsname = Schema::getColumnListing($tablename);

		$var1 = $request->input("allColumnsname1");
		$var2 = $request->input("allColumnsname2");
		$var3 = $request->input("allColumnsname3");

		$checkboxLine1 = $request->input("LineGraph");
		$checkboxLine2 = $request->input("BarGraph");
		$checkboxLine3 = $request->input("RadarGraph");
		$checkboxLine4 = $request->input("DoughnutGraph");
		$checkboxLine5 = $request->input("PieGraph");
		$checkboxLine6 = $request->input("PolarAreaGraph");
		$checkboxLine7 = $request->input("BubbleGraph");
		$checkboxLine8 = $request->input("ScatterGraph");

		$firstColumn = "";
		foreach ($allColumnsname as $column1) {
			$firstColumn .= $column1;
			break;
		}	

		$totalData = DB::table($tablename)->select($firstColumn)->distinct($firstColumn)->count();
		// return $totalData;

		if ($var1 != null && $var2 == null && $var3 == null) 
		{

			$PnDChartData1 = DB::table($tablename)->select($firstColumn, $var1)->distinct($firstColumn)->count();
			$Data1 = DB::table($tablename)->select($firstColumn, $var1)->distinct($firstColumn)->orderBy($var1)->get();
			// $Data1Setlabela = DB::table($tablename)->select($var1)->distinct($var1)->orderBy($var1)->get();
			$Data1SetlabelY = $Data1->countBy($var1)->values()->toArray(); // numberic
			// $Data1Setlabelz = $Data1->pluck($var1)->unique()->values()->toArray(); //string
			$Data1Setlabelw = DB::table($tablename)->select($var1)->distinct($var1)->orderBy($var1)->get();
			$Data1SetlabelX = $Data1Setlabelw->pluck($var1)->unique()->values()->toArray();
			$Data2SetlabelX = [];
			$rData1Chunked = [];
			$Data3Setlabela = "";
			//testing
			$xData1 = [];
			$yData1 = [];
			$XYData1 = [];

			foreach ($Data1SetlabelX as $array1) {

				array_push($xData1, $array1); 
				array_push($XYData1, [$array1]); 

				$example = DB::table($tablename)->select($firstColumn, $var1)->distinct($firstColumn)
				->where($var1, $array1)->get()->count();
				array_push($yData1, $example);
			}

			// foreach ($Data1Setlabelw as $key => $value) {
			// 	array_push($Data1SetlabelX, $value);
			// }
			// return $Data1SetlabelY;

		} 
		else if (($var1 != null && $var2 != null) && $var3 == null)
		{

			$PnDChartData1 = DB::table($tablename)->select($firstColumn, $var1)->distinct($firstColumn)->count();
			$PnDChartData2 = DB::table($tablename)->select($firstColumn, $var2)->distinct($firstColumn)->count();

			$Data1 = DB::table($tablename)->select($firstColumn, $var1)->distinct($firstColumn)->orderBy($var1)->get();
			$Data1SetlabelY = $Data1->countBy($var1)->values()->toArray(); // numberic
			$Data1Setlabelw = DB::table($tablename)->select($var1)->distinct($var1)->orderBy($var1)->get();
			$Data1SetlabelX = $Data1Setlabelw->pluck($var1)->unique()->values()->toArray();
			$totalData1 = $Data1->pluck($var1)->unique()->values()->count(); //string


			$Data2 = DB::table($tablename)->select($firstColumn, $var2)->distinct($firstColumn)->orderBy($var2)->get();
			$Data2SetlabelY = $Data2->countBy($var2)->values()->toArray(); // numberic
			$Data2Setlabela = DB::table($tablename)->select($var2)->distinct($var2)->orderBy($var2)->get();
			$Data2SetlabelX = $Data2Setlabela->pluck($var2)->unique()->values()->toArray();
			$totalData2 = $Data2->pluck($var2)->unique()->values()->count(); //string

			$xData1 = [];
			$yData1 = [];
			$XYData1 = [];
			$rData1 = [];
			$gDataArray1 = [];
			$gDataArray2 = [];
			$sortedDesc = [];
			$Data3Setlabela = "";
			//get x and y values
			foreach ($Data1SetlabelX as $array1) {
				foreach ($Data2SetlabelX as $array2) {
					array_push($xData1, $array1);
					array_push($yData1, $array2); 
					array_push($XYData1, $array1. ' ' .$array2); 
					$example = DB::table($tablename)->select($firstColumn, $var1, $var2)->distinct($firstColumn)
					->where($var1, $array1)->where($var2, $array2)->get()->count();
					array_push($rData1, $example);
				}
			}	

			$XYData1Chunked = array_chunk($XYData1, $totalData2);
			$rData1Chunked = array_chunk($rData1, $totalData2);
			$sorted = $Data1->pluck($var1)->unique()->values()->toArray();  //string
			// dd($XYData1Chunked);
		}

		else if ($var1 != null && $var2 != null && $var3 != null)
		{
			// $all3Data = DB::table($tablename)->select($var1 , $var2, $var3)->count(distinct($firstColumn,$var1 , $var2, $var3))->groupBy($var1 , $var2, $var3);
			// $all3Data = DB::select( DB::raw("SELECT ".$var1.",".$var2.",".$var3.", count(distinct ".$firstColumn.",".$var1.",".$var2.",".$var3.") from ".$tablename." where ".$var1." is not null group by ".$var1.",".$var2.",".$var3.";"));
			// return $all3Data;





			$PnDChartData1 = DB::table($tablename)->select($firstColumn, $var1)->distinct($firstColumn)->count();
			$PnDChartData2 = DB::table($tablename)->select($firstColumn, $var2)->distinct($firstColumn)->count();
			$PnDChartData3 = DB::table($tablename)->select($firstColumn, $var3)->distinct($firstColumn)->count();

			$Data1 = DB::table($tablename)->select($firstColumn, $var1)->distinct($firstColumn)->orderBy($var1)->get();
			$Data1SetlabelY = $Data1->countBy($var1)->values()->toArray(); // numberic
			$Data1Setlabelw = DB::table($tablename)->select($var1)->distinct($var1)->orderBy($var1)->get();
			$Data1SetlabelX = $Data1Setlabelw->pluck($var1)->unique()->values()->toArray();
			$totalData1 = $Data1->pluck($var1)->unique()->values()->count(); //string


			$Data2 = DB::table($tablename)->select($firstColumn, $var2)->distinct($firstColumn)->orderBy($var2)->get();
			$Data2SetlabelY = $Data2->countBy($var2)->values()->toArray(); // numberic
			$Data2Setlabela = DB::table($tablename)->select($var2)->distinct($var2)->orderBy($var2)->get();
			$Data2SetlabelX = $Data2Setlabela->pluck($var2)->unique()->values()->toArray();
			$totalData2 = $Data2->pluck($var2)->unique()->values()->count(); //string

			$Data3 = DB::table($tablename)->select($firstColumn, $var3)->distinct($firstColumn)->orderBy($var3)->get();
			$Data3SetlabelY = $Data3->countBy($var3)->values()->toArray(); // numberic
			$Data3Setlabela = DB::table($tablename)->select($var3)->distinct($var3)->orderBy($var3)->get();
			$Data3SetlabelX = $Data3Setlabela->pluck($var3)->unique()->values()->toArray();
			$totalData3 = $Data3->pluck($var3)->unique()->values()->count(); //string


			$xData1 = [];
			$yData1 = [];
			$XYData1 = [];
			$rData1 = [];
			$yData3 = [];
			$xData3 = [];
			$yData2 = [];
			$XYData2 = [];
			$rData2 = [];
			$example2 = [];
			$t = 0;

			$rData1Chunked = [];

			//get x and y values
			foreach ($Data1SetlabelX as $array1) {
				foreach ($Data2SetlabelX as $array2) {
					foreach ($Data3SetlabelX as $i => $array3) {
						array_push($xData1, $array1); 
						array_push($yData1, $array2); 
						array_push($yData3, $array3); 
						array_push($XYData1, [$array1. ' ' .$array2]); 
						array_push($XYData2, [$array2. ' ' .$array3]); 
						array_push($xData3, [$array1. ' ' .$array2 .' '.$array3]);


						$example1 =DB::table($tablename)->select($firstColumn, $var1 , $var2, $var3)->distinct($firstColumn)
						->where($var1, $array1)->where($var2, $array2)->where($var3, $array3)->get()->count();
						


						array_push($rData2, $example1);

						if(strpos($array1, $Data1SetlabelX[0]) !== false){
							$t++;
							array_push($example2, $array1);
						}
					}
				}
			}	

			// $totalDatatoChunked = count($Data3SetlabelX);
			$XYData2Chunked = array_chunk($XYData2, $t); //140 data 7 Array in array(20 data in 1 array)
			$rData2Chunked = array_chunk($rData2, $t); //140 data 7 Array in array(20 data in 1 array)
			$xData1Chunked = array_chunk($xData1, $t);
			$totalDatatoChunked = count($rData2Chunked);

			// dd($xData3);

			// return $rData2Chunked;
		}
	}

	return view('analysis_tools', compact('PnDChartData1','PnDChartData2', 'totalData','Data1SetlabelY' , 'Data1SetlabelX', 'Data2SetlabelY', 'Data2SetlabelX', 'Data3SetlabelY', 'Data3SetlabelX', 'allColumnsname', 'checkboxLine1', 'checkboxLine2', 'checkboxLine3', 'checkboxLine4', 'checkboxLine5', 'checkboxLine6', 'checkboxLine7', 'checkboxLine8','var1', 'var2', 'var3', 'xData1', 'yData1', 'XYData1', 'rData1', 'data2', 'xData2', 'yData2', 'XYData2', 'rData2', 'data', 'tables', 'tablename', 'XYData1Chunked', 'XYData2Chunked', 'rData1Chunked', 'rData2Chunked', 'Data3Setlabela' ,'totalDatatoChunked', 'totalData2', 'totalData3', 'yData3', 'xData1Chunked'));
}
}