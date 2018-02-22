<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PetController extends Controller
{   
    
    public function index(){
        dd('here is pet');
    }
    public function petDataAvailable(){
        // Create the array of data to send to the API:
        $data = array(
            "apikey" => "ra0CJvb9", // Use your API key here
            "objectType" => "animals",
            "objectAction" => "define",
          );

          $finalResult= $this->jsonPetApiCall($data);
          print_r($finalResult);
       
    }

    public function petDataAvailableView(){
        // Create the array of data to send to the API:
        $data = array(
            "apikey" => "ra0CJvb9", // Use your API key here
            "objectType" => "animals",
            "objectAction" => "define",
          );

          $finalResults= $this->phpPetApiCall($data);
          $finalResults=$finalResults['data']['publicSearch']['fields'];
        //   dd($finalResults);
          return view('petDataView')->with('finalResults',$finalResults);
       
    }

    public function petSearch(){
        $data = array(
            "apikey" => "ra0CJvb9",
            "objectType" => "animals",
            "objectAction" => "publicSearch",
            "search" => array (
              "resultStart" => 0,
              "resultLimit" => 2,
              "resultSort" => "animalID",
              "resultOrder" => "asc",
              "calcFoundRows" => "Yes",
              "filters" => array(
                array(
                  "fieldName" => "animalSpecies",
                  "operation" => "equals",
                  "criteria" => "dog",
                ),
                array(
                  "fieldName" => "animalGeneralSizePotential",
                  "operation" => "equals",
                  "criteria" => "Large",
                ),
              ),
              "fields" => array("animalID","animalOrgID","animalName","animalBreed")// what we want to be returned
            ),
          );
          $finalResult= $this->jsonPetApiCall($data);
          print_r($finalResult);
        // dd('public search');
    }

    public function test(){
        $data = array(
            "apikey" => "ra0CJvb9",
            "objectType" => "animals",
            "objectAction" => "publicSearch",
            "search" => array (
                "resultStart" => 0,
                "resultLimit" => 10,
                "resultSort" => "animalID",
                "resultOrder" => "asc",
                "calcFoundRows" => "Yes",
                "filters" => array(
                    array(
                        "fieldName" => "animalStatus",
                        "operation" => "equal",
                        "criteria" => "Available",
                    ),
                    array(
                        "fieldName" => "animalSpecies",
                        "operation" => "equals",
                        "criteria" => "dog",
                      ),
                      array(
                        "fieldName" => "orgLocationDistance",
                        "operation" => "radius",
                        "criteria" => "90",
                      ),
                      array(
                        "fieldName" => "orgLocation",
                        "operation" => "equals",
                        "criteria" => "90210",
                      ),
                ),
                "fields" => array("animalName","animalBreed","animalSpecies","animalStatus","animalGeneralSizePotential"),
                
            ),
        );




        //   $finalResults= $this->phpPetApiCall($data);
        //   print_r($finalResults);
        //   print_r($finalResults['data']);
        //   foreach($finalResults['data'] as $fin){  
        //       print_r($fin."<hr/>"); 
        //     //   print_r($fin['animalName']."<br/>".$fin['animalSpecies']."<hr/>");
              
        //   }
          $finalResults= $this->jsonPetApiCall($data);
          print_r($finalResults);
        // // dd('public search');
    }


    public function phpPetApiCall($data){
         //Encode the array into a JSON string:
         $jsonData = json_encode($data);
         
                 // create a new cURL resource
                 $ch = curl_init();
         
                 // set options, url, etc.
                 curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json"));
                 curl_setopt($ch, CURLOPT_URL, "https://api.rescuegroups.org/http/v2.json");
         
                 curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonData);
                 curl_setopt($ch, CURLOPT_POST, 1);
         
                 //curl_setopt($ch, CURLOPT_VERBOSE, true);
                 curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
         
                 $result = curl_exec($ch);
         
                 if (curl_errno($ch)) {
         
                 $results = curl_error($ch);
         
                 } else {
         
                 // close cURL resource, and free up system resources
                 curl_close($ch);
         
                 $results = $result;
                 
                 }    
                 $results = json_decode($results,true);  // makes php array of json   
                 return $results; // returns php array
    }

    public function jsonPetApiCall($data){
        //Encode the array into a JSON string:
        $jsonData = json_encode($data);
        
                // create a new cURL resource
                $ch = curl_init();
        
                // set options, url, etc.
                curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json"));
                curl_setopt($ch, CURLOPT_URL, "https://api.rescuegroups.org/http/v2.json");
        
                curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonData);
                curl_setopt($ch, CURLOPT_POST, 1);
        
                //curl_setopt($ch, CURLOPT_VERBOSE, true);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        
                $result = curl_exec($ch);
        
                if (curl_errno($ch)) {
        
                $results = curl_error($ch);
        
                } else {
        
                // close cURL resource, and free up system resources
                curl_close($ch);
        
                $results = $result;
                
                }               
                return $results; // returns json object
   }
}
