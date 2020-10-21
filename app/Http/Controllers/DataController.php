<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Schema;
use Illuminate\Http\Request;
use App\Questionnaire;
use App\Finance;

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

		//No Income Group
		$NoIncomeNoCost = Questionnaire::select('Nom', 'Income_Group', 'Cost_Increaments')->distinct('Nom')
		->where('Income_Group', 'No income')->where('Cost_Increaments', 'No')->get()->count();
		$NoIncomeAddictCost = Questionnaire::select('Nom', 'Income_Group', 'Cost_Increaments')->distinct('Nom')
		->where('Income_Group', 'No income')->where('Cost_Increaments', 'Addiction in spending more than needs')->get()->count();
		$NoIncomeEduCost = Questionnaire::select('Nom', 'Income_Group', 'Cost_Increaments')->distinct('Nom')
		->where('Income_Group', 'No income')->where('Cost_Increaments', 'Education expenses')->get()->count();
		$NoIncomeNFMCost = Questionnaire::select('Nom', 'Income_Group', 'Cost_Increaments')->distinct('Nom')
		->where('Income_Group', 'No income')->where('Cost_Increaments', 'New family members (new born)')->get()->count();
		$NoIncomeUICost = Questionnaire::select('Nom', 'Income_Group', 'Cost_Increaments')->distinct('Nom')
		->where('Income_Group', 'No income')->where('Cost_Increaments', 'Unexpected illness')->get()->count();
		$NoIncomeOtherCost = Questionnaire::select('Nom', 'Income_Group', 'Cost_Increaments')->distinct('Nom')
		->where('Income_Group', 'No income')->where('Cost_Increaments', 'Others')->get()->count();

		//Daily Income Group
		$DailyIncomeNoCost = Questionnaire::select('Nom', 'Income_Group', 'Cost_Increaments')->distinct('Nom')
		->where('Income_Group', 'Daily income')->where('Cost_Increaments', 'No')->get()->count();
		$DailyIncomeAddictCost = Questionnaire::select('Nom', 'Income_Group', 'Cost_Increaments')->distinct('Nom')
		->where('Income_Group', 'Daily income')->where('Cost_Increaments', 'Addiction in spending more than needs')->get()->count();
		$DailyIncomeEduCost = Questionnaire::select('Nom', 'Income_Group', 'Cost_Increaments')->distinct('Nom')
		->where('Income_Group', 'Daily income')->where('Cost_Increaments', 'Education expenses')->get()->count();
		$DailyIncomeNFMCost = Questionnaire::select('Nom', 'Income_Group', 'Cost_Increaments')->distinct('Nom')
		->where('Income_Group', 'Daily income')->where('Cost_Increaments', 'New family members (new born)')->get()->count();
		$DailyIncomeUICost = Questionnaire::select('Nom', 'Income_Group', 'Cost_Increaments')->distinct('Nom')
		->where('Income_Group', 'Daily income')->where('Cost_Increaments', 'Unexpected illness')->get()->count();
		$DailyIncomeOtherCost = Questionnaire::select('Nom', 'Income_Group', 'Cost_Increaments')->distinct('Nom')
		->where('Income_Group', 'Daily income')->where('Cost_Increaments', 'Others')->get()->count();

		//Low Income Group
		$LowIncomeNoCost = Questionnaire::select('Nom', 'Income_Group', 'Cost_Increaments')->distinct('Nom')
		->where('Income_Group', 'Low income')->where('Cost_Increaments', 'No')->get()->count();
		$LowIncomeAddictCost = Questionnaire::select('Nom', 'Income_Group', 'Cost_Increaments')->distinct('Nom')
		->where('Income_Group', 'Low income')->where('Cost_Increaments', 'Addiction in spending more than needs')->get()->count();
		$LowIncomeEduCost = Questionnaire::select('Nom', 'Income_Group', 'Cost_Increaments')->distinct('Nom')
		->where('Income_Group', 'Low income')->where('Cost_Increaments', 'Education expenses')->get()->count();
		$LowIncomeNFMCost = Questionnaire::select('Nom', 'Income_Group', 'Cost_Increaments')->distinct('Nom')
		->where('Income_Group', 'Low income')->where('Cost_Increaments', 'New family members (new born)')->get()->count();
		$LowIncomeUICost = Questionnaire::select('Nom', 'Income_Group', 'Cost_Increaments')->distinct('Nom')
		->where('Income_Group', 'Low income')->where('Cost_Increaments', 'Unexpected illness')->get()->count();
		$LowIncomeOtherCost = Questionnaire::select('Nom', 'Income_Group', 'Cost_Increaments')->distinct('Nom')
		->where('Income_Group', 'Low income')->where('Cost_Increaments', 'Others')->get()->count();

		//Medium Income Group
		$MediumIncomeNoCost = Questionnaire::select('Nom', 'Income_Group', 'Cost_Increaments')->distinct('Nom')
		->where('Income_Group', 'Medium income')->where('Cost_Increaments', 'No')->get()->count();
		$MediumIncomeAddictCost = Questionnaire::select('Nom', 'Income_Group', 'Cost_Increaments')->distinct('Nom')
		->where('Income_Group', 'Medium income')->where('Cost_Increaments', 'Addiction in spending more than needs')->get()->count();
		$MediumIncomeEduCost = Questionnaire::select('Nom', 'Income_Group', 'Cost_Increaments')->distinct('Nom')
		->where('Income_Group', 'Medium income')->where('Cost_Increaments', 'Education expenses')->get()->count();
		$MediumIncomeNFMCost = Questionnaire::select('Nom', 'Income_Group', 'Cost_Increaments')->distinct('Nom')
		->where('Income_Group', 'Medium income')->where('Cost_Increaments', 'New family members (new born)')->get()->count();
		$MediumIncomeUICost = Questionnaire::select('Nom', 'Income_Group', 'Cost_Increaments')->distinct('Nom')
		->where('Income_Group', 'Medium income')->where('Cost_Increaments', 'Unexpected illness')->get()->count();
		$MediumIncomeOtherCost = Questionnaire::select('Nom', 'Income_Group', 'Cost_Increaments')->distinct('Nom')
		->where('Income_Group', 'Medium income')->where('Cost_Increaments', 'Others')->get()->count();

		//High Income Group
		$HighIncomeNoCost = Questionnaire::select('Nom', 'Income_Group', 'Cost_Increaments')->distinct('Nom')
		->where('Income_Group', 'High income')->where('Cost_Increaments', 'No')->get()->count();
		$HighIncomeAddictCost = Questionnaire::select('Nom', 'Income_Group', 'Cost_Increaments')->distinct('Nom')
		->where('Income_Group', 'High income')->where('Cost_Increaments', 'Addiction in spending more than needs')->get()->count();
		$HighIncomeEduCost = Questionnaire::select('Nom', 'Income_Group', 'Cost_Increaments')->distinct('Nom')
		->where('Income_Group', 'High income')->where('Cost_Increaments', 'Education expenses')->get()->count();
		$HighIncomeNFMCost = Questionnaire::select('Nom', 'Income_Group', 'Cost_Increaments')->distinct('Nom')
		->where('Income_Group', 'High income')->where('Cost_Increaments', 'New family members (new born)')->get()->count();
		$HighIncomeUICost = Questionnaire::select('Nom', 'Income_Group', 'Cost_Increaments')->distinct('Nom')
		->where('Income_Group', 'High income')->where('Cost_Increaments', 'Unexpected illness')->get()->count();
		$HighIncomeOtherCost = Questionnaire::select('Nom', 'Income_Group', 'Cost_Increaments')->distinct('Nom')
		->where('Income_Group', 'High income')->where('Cost_Increaments', 'Others')->get()->count();

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

		return view('analysis', compact('NoIncomeNoCost', 'NoIncomeAddictCost', 'NoIncomeEduCost', 'NoIncomeNFMCost',
			'NoIncomeUICost', 'NoIncomeOtherCost', 'DailyIncomeNoCost', 'DailyIncomeAddictCost', 'DailyIncomeEduCost',
			'DailyIncomeNFMCost', 'DailyIncomeUICost', 'DailyIncomeOtherCost', 'LowIncomeNoCost', 'LowIncomeAddictCost',
			'LowIncomeEduCost', 'LowIncomeNFMCost', 'LowIncomeUICost', 'LowIncomeOtherCost', 'MediumIncomeNoCost',
			'MediumIncomeAddictCost', 'MediumIncomeEduCost', 'MediumIncomeNFMCost', 'MediumIncomeUICost', 
			'MediumIncomeOtherCost', 'HighIncomeNoCost', 'HighIncomeAddictCost', 'HighIncomeEduCost',
			'HighIncomeNFMCost', 'HighIncomeUICost', 'HighIncomeOtherCost'));
	}


	public function analysis_tools()
	{
		//Country Data
		$ordered = Questionnaire::select('Nom', 'Country')->distinct('Nom')->get();
		$lol = $ordered->countBy('Country')->values()->toArray();
		$CountryName = $ordered->pluck('Country')->unique()->values()->toArray();
		$Country = [$CountryName, $lol];

		//Gender Data
		$GData = Questionnaire::select('Nom', 'Gender')->distinct('Nom')->get();
		$CountGender = $GData->countBy('Gender')->values()->toArray();
		$GenderType = $GData->pluck('Gender')->unique()->values()->toArray();
		$Gender = [$GenderType, $CountGender];

		//Occupation Data
		$OccupData = Questionnaire::select('Nom', 'Occupation')->distinct('Nom')->get();
		$CountOccup = $OccupData->countBy('Occupation')->values()->toArray(); // numberic
		$OccupationType = $OccupData->pluck('Occupation')->unique()->values()->toArray(); //string
		$Occupation = [$OccupationType , $CountOccup];

		//Income Group
		$IncomeData = Questionnaire::select('Nom', 'Income_Group')->distinct('Nom')->get();
		$CountIncome = $IncomeData->countBy('Income_Group')->values()->toArray(); // numberic
		$IncomeType = $IncomeData->pluck('Income_Group')->unique()->values()->toArray(); //string
		$Income = [$IncomeType, $CountIncome];

		//Social Media
		$SocMed = Questionnaire::select('Nom', 'Social_Media')->distinct('Nom')->get();
		$CountSocialMedia = $SocMed->countBy('Social_Media')->values()->toArray(); // numberic
		$SocialMediaType = $SocMed->pluck('Social_Media')->unique()->values()->toArray();//string
		$Social_Media = [$SocialMediaType, $CountSocialMedia];

		//Usage Purpose
		$usage = Questionnaire::select('Nom', 'Usage_Purpose')->distinct('Nom')->get();
		$CountUsage = $usage->countBy('Usage_Purpose')->values()->toArray(); // numberic
		$UsageType = $usage->pluck('Usage_Purpose')->unique()->values()->toArray(); //string
		$Usage_Purpose = [$UsageType, $CountUsage];

		//Problem Occurs
		$Problem = Questionnaire::select('Nom', 'Problems_Occur')->distinct('Nom')->get();
		$CountProblem = $Problem->countBy('Problems_Occur')->values()->toArray();
		$ProblemType = $Problem->pluck('Problems_Occur')->unique()->values()->toArray(); //
		$Problems_Occur = [$ProblemType, $CountProblem];

		//Cost Increaments
		$Cost = Questionnaire::select('Nom', 'Cost_Increaments')->distinct('Nom')->get();
		$CountCost = $Cost->countBy('Cost_Increaments')->values()->toArray(); // numberic
		$CostType = $Cost->pluck('Cost_Increaments')->unique()->values()->toArray(); //string
		$Cost_Increaments = [$CostType, $CountCost];

		//Psychological Problem
		$Psychological = Questionnaire::select('Nom', 'Psychological_Problem')->distinct('Nom')->get();
		$CountPsychological = $Psychological->countBy('Psychological_Problem')->values()->toArray(); // numberic
		$PsychologicalType = $Psychological->pluck('Psychological_Problem')->unique()->values()->toArray();
		$Psychological_Problem = [$PsychologicalType, $CountPsychological];

		//Abused
		$AbusedData = Questionnaire::select('Nom', 'Abused')->distinct('Nom')->get();
		$CountAbused = $AbusedData->countBy('Abused')->values()->toArray(); // numberic
		$AbusedType = $AbusedData->pluck('Abused')->unique()->values()->toArray(); //string
		$Abused = [$AbusedType, $CountAbused];

		//Spread Fake News 
		$SFN = Questionnaire::select('Nom', 'Spread_Fake_News')->distinct('Nom')->get();
		$CountSFN = $SFN->countBy('Spread_Fake_News')->values()->toArray(); // numberic
		$SFNType = $SFN->pluck('Spread_Fake_News')->unique()->values()->toArray(); //string
		$Spread_Fake_News = [$SFNType, $CountSFN];

		//Believe Fake News 
		$BFN = Questionnaire::select('Nom', 'Believe_Fake_News')->distinct('Nom')->get();
		$CountBFN = $BFN->countBy('Believe_Fake_News')->values()->toArray(); // numberic
		$BFNType = $BFN->pluck('Believe_Fake_News')->unique()->values()->toArray(); //string
		$Believe_Fake_News = [$BFNType, $CountBFN];

		//Relationship Rate
		$RR = Questionnaire::select('Nom', 'Relationship_Rate')->distinct('Nom')->get();
		$CountRR = $RR->countBy('Relationship_Rate')->values()->toArray(); // numberic
		$RRType = $RR->pluck('Relationship_Rate')->unique()->values()->toArray(); //string
		$Relationship_Rate = [$RRType, $CountRR];

		//No Income Group
		$NoIncomeNoCost = Questionnaire::select('Nom', 'Income_Group', 'Cost_Increaments')->distinct('Nom')
		->where('Income_Group', 'No income')->where('Cost_Increaments', 'No')->get()->count();
		$NoIncomeAddictCost = Questionnaire::select('Nom', 'Income_Group', 'Cost_Increaments')->distinct('Nom')
		->where('Income_Group', 'No income')->where('Cost_Increaments', 'Addiction in spending more than needs')->get()->count();
		$NoIncomeEduCost = Questionnaire::select('Nom', 'Income_Group', 'Cost_Increaments')->distinct('Nom')
		->where('Income_Group', 'No income')->where('Cost_Increaments', 'Education expenses')->get()->count();
		$NoIncomeNFMCost = Questionnaire::select('Nom', 'Income_Group', 'Cost_Increaments')->distinct('Nom')
		->where('Income_Group', 'No income')->where('Cost_Increaments', 'New family members (new born)')->get()->count();
		$NoIncomeUICost = Questionnaire::select('Nom', 'Income_Group', 'Cost_Increaments')->distinct('Nom')
		->where('Income_Group', 'No income')->where('Cost_Increaments', 'Unexpected illness')->get()->count();
		$NoIncomeOtherCost = Questionnaire::select('Nom', 'Income_Group', 'Cost_Increaments')->distinct('Nom')
		->where('Income_Group', 'No income')->where('Cost_Increaments', 'Others')->get()->count();

		//Daily Income Group
		$DailyIncomeNoCost = Questionnaire::select('Nom', 'Income_Group', 'Cost_Increaments')->distinct('Nom')
		->where('Income_Group', 'Daily income')->where('Cost_Increaments', 'No')->get()->count();
		$DailyIncomeAddictCost = Questionnaire::select('Nom', 'Income_Group', 'Cost_Increaments')->distinct('Nom')
		->where('Income_Group', 'Daily income')->where('Cost_Increaments', 'Addiction in spending more than needs')->get()->count();
		$DailyIncomeEduCost = Questionnaire::select('Nom', 'Income_Group', 'Cost_Increaments')->distinct('Nom')
		->where('Income_Group', 'Daily income')->where('Cost_Increaments', 'Education expenses')->get()->count();
		$DailyIncomeNFMCost = Questionnaire::select('Nom', 'Income_Group', 'Cost_Increaments')->distinct('Nom')
		->where('Income_Group', 'Daily income')->where('Cost_Increaments', 'New family members (new born)')->get()->count();
		$DailyIncomeUICost = Questionnaire::select('Nom', 'Income_Group', 'Cost_Increaments')->distinct('Nom')
		->where('Income_Group', 'Daily income')->where('Cost_Increaments', 'Unexpected illness')->get()->count();
		$DailyIncomeOtherCost = Questionnaire::select('Nom', 'Income_Group', 'Cost_Increaments')->distinct('Nom')
		->where('Income_Group', 'Daily income')->where('Cost_Increaments', 'Others')->get()->count();

		//Low Income Group
		$LowIncomeNoCost = Questionnaire::select('Nom', 'Income_Group', 'Cost_Increaments')->distinct('Nom')
		->where('Income_Group', 'Low income')->where('Cost_Increaments', 'No')->get()->count();
		$LowIncomeAddictCost = Questionnaire::select('Nom', 'Income_Group', 'Cost_Increaments')->distinct('Nom')
		->where('Income_Group', 'Low income')->where('Cost_Increaments', 'Addiction in spending more than needs')->get()->count();
		$LowIncomeEduCost = Questionnaire::select('Nom', 'Income_Group', 'Cost_Increaments')->distinct('Nom')
		->where('Income_Group', 'Low income')->where('Cost_Increaments', 'Education expenses')->get()->count();
		$LowIncomeNFMCost = Questionnaire::select('Nom', 'Income_Group', 'Cost_Increaments')->distinct('Nom')
		->where('Income_Group', 'Low income')->where('Cost_Increaments', 'New family members (new born)')->get()->count();
		$LowIncomeUICost = Questionnaire::select('Nom', 'Income_Group', 'Cost_Increaments')->distinct('Nom')
		->where('Income_Group', 'Low income')->where('Cost_Increaments', 'Unexpected illness')->get()->count();
		$LowIncomeOtherCost = Questionnaire::select('Nom', 'Income_Group', 'Cost_Increaments')->distinct('Nom')
		->where('Income_Group', 'Low income')->where('Cost_Increaments', 'Others')->get()->count();

		//Medium Income Group
		$MediumIncomeNoCost = Questionnaire::select('Nom', 'Income_Group', 'Cost_Increaments')->distinct('Nom')
		->where('Income_Group', 'Medium income')->where('Cost_Increaments', 'No')->get()->count();
		$MediumIncomeAddictCost = Questionnaire::select('Nom', 'Income_Group', 'Cost_Increaments')->distinct('Nom')
		->where('Income_Group', 'Medium income')->where('Cost_Increaments', 'Addiction in spending more than needs')->get()->count();
		$MediumIncomeEduCost = Questionnaire::select('Nom', 'Income_Group', 'Cost_Increaments')->distinct('Nom')
		->where('Income_Group', 'Medium income')->where('Cost_Increaments', 'Education expenses')->get()->count();
		$MediumIncomeNFMCost = Questionnaire::select('Nom', 'Income_Group', 'Cost_Increaments')->distinct('Nom')
		->where('Income_Group', 'Medium income')->where('Cost_Increaments', 'New family members (new born)')->get()->count();
		$MediumIncomeUICost = Questionnaire::select('Nom', 'Income_Group', 'Cost_Increaments')->distinct('Nom')
		->where('Income_Group', 'Medium income')->where('Cost_Increaments', 'Unexpected illness')->get()->count();
		$MediumIncomeOtherCost = Questionnaire::select('Nom', 'Income_Group', 'Cost_Increaments')->distinct('Nom')
		->where('Income_Group', 'Medium income')->where('Cost_Increaments', 'Others')->get()->count();

		//High Income Group
		$HighIncomeNoCost = Questionnaire::select('Nom', 'Income_Group', 'Cost_Increaments')->distinct('Nom')
		->where('Income_Group', 'High income')->where('Cost_Increaments', 'No')->get()->count();
		$HighIncomeAddictCost = Questionnaire::select('Nom', 'Income_Group', 'Cost_Increaments')->distinct('Nom')
		->where('Income_Group', 'High income')->where('Cost_Increaments', 'Addiction in spending more than needs')->get()->count();
		$HighIncomeEduCost = Questionnaire::select('Nom', 'Income_Group', 'Cost_Increaments')->distinct('Nom')
		->where('Income_Group', 'High income')->where('Cost_Increaments', 'Education expenses')->get()->count();
		$HighIncomeNFMCost = Questionnaire::select('Nom', 'Income_Group', 'Cost_Increaments')->distinct('Nom')
		->where('Income_Group', 'High income')->where('Cost_Increaments', 'New family members (new born)')->get()->count();
		$HighIncomeUICost = Questionnaire::select('Nom', 'Income_Group', 'Cost_Increaments')->distinct('Nom')
		->where('Income_Group', 'High income')->where('Cost_Increaments', 'Unexpected illness')->get()->count();
		$HighIncomeOtherCost = Questionnaire::select('Nom', 'Income_Group', 'Cost_Increaments')->distinct('Nom')
		->where('Income_Group', 'High income')->where('Cost_Increaments', 'Others')->get()->count();

		//get all column name
		$allColumnsname = Schema::getColumnListing('masterdata');

		return view('analysis_tools', compact('NoIncomeNoCost', 'NoIncomeAddictCost', 'NoIncomeEduCost', 'NoIncomeNFMCost',
			'NoIncomeUICost', 'NoIncomeOtherCost', 'DailyIncomeNoCost', 'DailyIncomeAddictCost', 'DailyIncomeEduCost',
			'DailyIncomeNFMCost', 'DailyIncomeUICost', 'DailyIncomeOtherCost', 'LowIncomeNoCost', 'LowIncomeAddictCost',
			'LowIncomeEduCost', 'LowIncomeNFMCost', 'LowIncomeUICost', 'LowIncomeOtherCost', 'MediumIncomeNoCost',
			'MediumIncomeAddictCost', 'MediumIncomeEduCost', 'MediumIncomeNFMCost', 'MediumIncomeUICost', 
			'MediumIncomeOtherCost', 'HighIncomeNoCost', 'HighIncomeAddictCost', 'HighIncomeEduCost',
			'HighIncomeNFMCost', 'HighIncomeUICost', 'HighIncomeOtherCost', 'allColumnsname', 'NoIncomeNoCost', 
			'NoIncomeAddictCost', 'NoIncomeEduCost', 'NoIncomeNFMCost', 'NoIncomeUICost', 'NoIncomeOtherCost', 
			'DailyIncomeNoCost', 'DailyIncomeAddictCost', 'DailyIncomeEduCost', 'DailyIncomeNFMCost', 'DailyIncomeUICost', 
			'DailyIncomeOtherCost', 'LowIncomeNoCost', 'LowIncomeAddictCost',	'LowIncomeEduCost', 'LowIncomeNFMCost',
			'LowIncomeUICost', 'LowIncomeOtherCost', 'MediumIncomeNoCost', 'MediumIncomeAddictCost', 'MediumIncomeEduCost',
			'MediumIncomeNFMCost', 'MediumIncomeUICost', 'MediumIncomeOtherCost', 'HighIncomeNoCost', 
			'HighIncomeAddictCost', 'HighIncomeEduCost', 'HighIncomeNFMCost', 'HighIncomeUICost', 'HighIncomeOtherCost'));
	}
}
