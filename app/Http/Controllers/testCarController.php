<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use nusoap_client;
class testCarController extends Controller
{

    // public function getConfigCompareService() {
    //     // dd('here');
    //     // $wsdlURL = "http://platform.chrome.com/AutomotiveConfigCompareService/AutomotiveConfigCompareService3?WSDL";
    //     $wsdlURL = "http://services.chromedata.com/AutomotiveConfigCompareService/AutomotiveConfigCompareService4g?WSDL";
    
    //     $cache = new wsdlcache();
    //     $wsdl = $cache->get($wsdlURL);
    //     if ($wsdl == null) {
    //         $wsdl = new wsdl($wsdlURL);
    //         $cache->put($wsdl);
    //     }
    //     $configService = new soapclient($wsdlURL);
    //     return $configService;
    // }
    public function getFilterRules( $orderAvailability ){
        $filterRules = array(
            "orderAvailability" => $orderAvailability,
            "marketClassIds" => [2,3],
            "vehicleTypes" => array(),
            "postalCode" => '10001',
            "msrpRange" => array( "minimumPrice" => 0.0, "maximumPrice" => 999999999.0 )
        );
        return $filterRules;
    }

    public function index(){
        // dd('index');
        $client = new nusoap_client('http://services.chromedata.com/AutomotiveConfigCompareService/AutomotiveConfigCompareService4g?WSDL', 'wsdl');
        $client->soap_defencoding = 'UTF-8';
        $client->decode_utf8 = FALSE;
        $err = $client->getError();
        // $configService = getConfigCompareService();
        // $proxy = $configService->getProxy();
        $locale = array(
			"country" => "US",
			"language" => "en"
	    );
        // $accountInfo = array(
        //     "accountNumber" => "0",
        //     "accountSecret" => "accountSecret",
        //     "locale" => $locale
        // );
        $accountInfo = array(
            "accountNumber" => "312839",
            "accountSecret" => "9b47be30eb0f4008",
            "locale" => $locale
        );
        
        $_SESSION["accountInfo"] = $accountInfo;
        
        //get model years
        $modelYearsRequest = array(
            "accountInfo" => $accountInfo,
            "filterRules"=>$this->getFilterRules('Fleet')
        );
        if ($err) {
            // Display the error
            echo '<h2>Constructor error</h2>' . $err;
            // At this point, you know the call that follows will fail
            exit();
         }
        $version = $client->call('getDataVersions ',$accountInfo);
        // $modelYears = $client->call('getModelYears',$modelYearsRequest);
        dd($version);
    }
}
