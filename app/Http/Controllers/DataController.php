<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Schema;
use Illuminate\Http\Request;
use App\Questionnaire;

class DataController extends Controller
{

	public function index(){
		
		//Country Data
		$ordered = Questionnaire::select('Nom', 'Country')->distinct('Nom')->get();
		$lol = $ordered->countBy('Country')->values()->toArray();
		$CountryName = $ordered->pluck('Country')->unique()->values()->toArray();

		//Gender Data
		$GData = Questionnaire::select('Nom', 'Gender')->distinct('Nom')->get();
		$CountGender = $GData->countBy('Gender')->values()->toArray();
		$GenderType = $GData->pluck('Gender')->unique()->values()->toArray();

		//Occupation Data
		$Occupation = Questionnaire::select('Nom', 'Occupation')->distinct('Nom')->get();
		$CountOccup = $Occupation->countBy('Occupation')->values()->toArray(); // numberic
		$OccupationType = $Occupation->pluck('Occupation')->unique()->values()->toArray(); //string

		//Income Group
		$Income = Questionnaire::select('Nom', 'Income_Group')->distinct('Nom')->get();
		$CountIncome = $Income->countBy('Income_Group')->values()->toArray(); // numberic
		$IncomeType = $Income->pluck('Income_Group')->unique()->values()->toArray(); //string

		//Social Media
		$SocMed = Questionnaire::select('Nom', 'Social_Media')->distinct('Nom')->get();
		$CountSocialMedia = $SocMed->countBy('Social_Media')->values()->toArray(); // numberic
		$SocialMediaType = $SocMed->pluck('Social_Media')->unique()->values()->toArray();//string

		//Usage Purpose
		$usage = Questionnaire::select('Nom', 'Usage_Purpose')->distinct('Nom')->get();
		$CountUsage = $usage->countBy('Usage_Purpose')->values()->toArray(); // numberic
		$UsageType = $usage->pluck('Usage_Purpose')->unique()->values()->toArray(); //string

		//Problem Occurs
		$Problem = Questionnaire::select('Nom', 'Problems_Occur')->distinct('Nom')->get();
		$CountProblem = $Problem->countBy('Problems_Occur')->values()->toArray();
		$ProblemType = $Problem->pluck('Problems_Occur')->unique()->values()->toArray(); //

		//Cost Increaments
		$Cost = Questionnaire::select('Nom', 'Cost_Increaments')->distinct('Nom')->get();
		$CountCost = $Cost->countBy('Cost_Increaments')->values()->toArray(); // numberic
		$CostType = $Cost->pluck('Cost_Increaments')->unique()->values()->toArray(); //string

		//Psychological Problem
		$Psychological = Questionnaire::select('Nom', 'Psychological_Problem')->distinct('Nom')->get();
		$CountPsychological = $Psychological->countBy('Psychological_Problem')->values()->toArray(); // numberic
		$PsychologicalType = $Psychological->pluck('Psychological_Problem')->unique()->values()->toArray();

		//Abused
		$Abused = Questionnaire::select('Nom', 'Abused')->distinct('Nom')->get();
		$CountAbused = $Abused->countBy('Abused')->values()->toArray(); // numberic
		$AbusedType = $Abused->pluck('Abused')->unique()->values()->toArray(); //string


		//Spread Fake News 
		$SFN = Questionnaire::select('Nom', 'Spread_Fake_News')->distinct('Nom')->get();
		$CountSFN = $SFN->countBy('Spread_Fake_News')->values()->toArray(); // numberic
		$SFNType = $SFN->pluck('Spread_Fake_News')->unique()->values()->toArray(); //string

		//Believe Fake News 
		$BFN = Questionnaire::select('Nom', 'Believe_Fake_News')->distinct('Nom')->get();
		$CountBFN = $BFN->countBy('Believe_Fake_News')->values()->toArray(); // numberic
		$BFNType = $BFN->pluck('Believe_Fake_News')->unique()->values()->toArray(); //string

		//Relationship Rate
		$RR = Questionnaire::select('Nom', 'Relationship_Rate')->distinct('Nom')->get();
		$CountRR = $RR->countBy('Relationship_Rate')->values()->toArray(); // numberic
		$RRType = $RR->pluck('Relationship_Rate')->unique()->values()->toArray(); //string

//All done. Just put the data in the dashboard. 

		// return $SocialMediaType;
		return view('admn_dshbrd', compact('dataQ', 'lol', 'CountryName', 'CountGender', 'GenderType',
			'CountOccup', 'OccupationType', 'CountIncome', 'IncomeType' , 'CountSocialMedia',
			'SocialMediaType', 'CountUsage', 'UsageType' , 'CountProblem', 'ProblemType',
			'CostType', 'CountCost', 'CountPsychological', 'PsychologicalType', 'AbusedType',
			'CountAbused', 'CountSFN', 'SFNType', 'CountBFN', 'BFNType', 'CountRR', 'RRType'));
	}


	public function analysis()
	{
		$data = Questionnaire::paginate(10);
		$allColumnsname = Schema::getColumnListing('masterdata');
    	return view ( 'analysis', compact('allColumnsname', 'data') );//->withData ($data);
    }

    public function analysis_tools()
    {
		// //get all column name
    	$allColumnsname = Schema::getColumnListing('masterdata');

    	return view('analysis_tools', compact('allColumnsname'));
    }

    public function postData(Request $request)
    {
		// $data1 ="He";
    	$allColumnsname = Schema::getColumnListing('masterdata');
    	$var1 = $request->input("allColumnsname1");
    	$var2 = $request->input("allColumnsname2");
    	$var3 = $request->input("allColumnsname3");
		// return $var1;

    	$checkboxLine1 = $request->input("LineGraph");
    	$checkboxLine2 = $request->input("BarGraph");
    	$checkboxLine3 = $request->input("RadarGraph");
    	$checkboxLine4 = $request->input("DoughnutGraph");
    	$checkboxLine5 = $request->input("PieGraph");
    	$checkboxLine6 = $request->input("PolarAreaGraph");
    	$checkboxLine7 = $request->input("BubbleGraph");
    	$checkboxLine8 = $request->input("ScatterGraph");


    	if ($var1 != null && $var2 == null && $var3 == null) 
    	{

    		$Data1 = Questionnaire::select('Nom', $var1)->distinct('Nom')->get();
			$Data1SetlabelY = $Data1->countBy($var1)->values()->toArray(); // numberic
			$Data1SetlabelX = $Data1->pluck($var1)->unique()->values()->toArray(); //string

			//testing
			$xData1 = [];
			$yData1 = [];
			// $data2 =[];

			$XYData1 = [];
			// $rData = [];
			//get x and y values
			foreach ($Data1SetlabelX as $array1) {

				array_push($xData1, $array1); 
				array_push($XYData1, [$array1]); 

				$example = Questionnaire::select('Nom', $var1)->distinct('Nom')
				->where($var1, $array1)->get()->count();
				array_push($yData1, $example);
			}

		} 
		else if (($var1 != null && $var2 != null) && $var3 == null)
		{
			$Data1 = Questionnaire::select('Nom', $var1)->distinct('Nom')->get();
			$Data1SetlabelY = $Data1->countBy($var1)->values()->toArray(); // numberic
			$Data1SetlabelX = $Data1->pluck($var1)->unique()->values()->toArray(); //string
			$Data2 = Questionnaire::select('Nom', $var2)->distinct('Nom')->get();
			$Data2SetlabelY = $Data2->countBy($var2)->values()->toArray(); // numberic
			$Data2SetlabelX = $Data2->pluck($var2)->unique()->values()->toArray(); //string
			// $Data3 = Questionnaire::select('Nom', $var3)->distinct('Nom', $var3)->get();
			// $Data3SetlabelY = $Data3->countBy($var3)->values()->toArray(); // numberic
			// $Data3SetlabelX = $Data3->pluck($var3)->unique()->values()->toArray(); //string


			$xData1 = [];
			$yData1 = [];
			// $data2 =[];

			$XYData1 = [];
			$rData1 = [];
			//get x and y values
			foreach ($Data1SetlabelX as $array1) {
				foreach ($Data2SetlabelX as $array2) {

					array_push($xData1, $array1); 
					array_push($yData1, $array2); 
					array_push($XYData1, [$array1. ' ' .$array2]); 

					$example = Questionnaire::select('Nom', $var1, $var2)->distinct('Nom')
					->where($var1, $array1)->where($var2, $array2)->get()->count();
					array_push($rData1, $example);
				}
			}	
			// return [$xData, $yData, $XYData, $rData];
		}

		else if ($var1 != null && $var2 != null && $var3 != null)
		{
			$Data1 = Questionnaire::select('Nom', $var1)->distinct('Nom')->get();
			$Data1SetlabelY = $Data1->countBy($var1)->values()->toArray(); // numberic
			$Data1SetlabelX = $Data1->pluck($var1)->unique()->values()->toArray(); //string
			$Data2 = Questionnaire::select('Nom', $var2)->distinct('Nom')->get();
			$Data2SetlabelY = $Data2->countBy($var2)->values()->toArray(); // numberic
			$Data2SetlabelX = $Data2->pluck($var2)->unique()->values()->toArray(); //string
			$Data3 = Questionnaire::select('Nom', $var3)->distinct('Nom')->get();
			$Data3SetlabelY = $Data3->countBy($var3)->values()->toArray(); // numberic
			$Data3SetlabelX = $Data3->pluck($var3)->unique()->values()->toArray(); //string


			$xData1 = [];
			$yData1 = [];
			$XYData1 = [];
			$rData1 = [];

			$xData2 = [];
			$yData2 = [];
			$XYData2 = [];
			$rData2 = [];


			//get x and y values
			foreach ($Data1SetlabelX as $array1) {
				foreach ($Data2SetlabelX as $array2) {

					array_push($xData1, $array1); 
					array_push($yData1, $array2); 
					array_push($XYData1, [$array1. ' ' .$array2]); 

					$example = Questionnaire::select('Nom', $var1, $var2)->distinct('Nom')
					->where($var1, $array1)->where($var2, $array2)->get()->count();
					array_push($rData1, $example);
				}
			}	

			foreach ($Data1SetlabelX as $array3) {
				foreach ($Data3SetlabelX as $array4) {

					array_push($xData2, $array3); 
					array_push($yData2, $array4); 
					array_push($XYData2, [$array3. ' ' .$array4]); 

					$example1 = Questionnaire::select('Nom', $var1, $var3)->distinct('Nom')
					->where($var1, $array3)->where($var3, $array4)->get()->count();
					array_push($rData2, $example1);
				}
			}

		}
		

		return view('analysis_tools', compact('Data1SetlabelY' , 'Data1SetlabelX', 'Data2SetlabelY', 'Data2SetlabelX', 'Data3SetlabelY', 'Data3SetlabelX', 'allColumnsname', 'checkboxLine1', 'checkboxLine2', 'checkboxLine3', 'checkboxLine4', 'checkboxLine5', 'checkboxLine6', 'checkboxLine7', 'checkboxLine8','var1', 'var2', 'var3', 'xData1', 'yData1', 'XYData1', 'rData1', 'data2', 'xData2', 'yData2', 'XYData2', 'rData2'));
	}
}
