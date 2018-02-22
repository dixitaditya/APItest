<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use nusoap_client;
use DateTime;
class Holiday extends Controller
{
    public function index(){
        // dd('index');
        $client = new nusoap_client('http://www.holidaywebservice.com/HolidayService_v2/HolidayService2.asmx?wsdl', 'wsdl');
        $client->soap_defencoding = 'UTF-8';
        $client->decode_utf8 = FALSE;
       
        // $result = $client->call('GetCountriesAvailable');
        $result = $client->call('GetHolidaysAvailable','Canada');
        $year=2018;
        // $result = $client->call('GetHolidayDate','Canada','NATIONAL-PATRIOTES-DAY',$year);
        $start = DateTime::createFromFormat('m-d-Y', '09-09-2003')->format('m-d-Y');
        $end = DateTime::createFromFormat('m-d-Y', '10-10-2004')->format('m-d-Y');
        // $end = new DateTime('02/31/2012');
        // dd($start);
        // $result = $client->call('GetHolidaysForDateRange','Canada',$start,$end);
        
        dd($result);

        

        $jsonObj = json_encode($result);
        dd($jsonObj);
       
    }
}
