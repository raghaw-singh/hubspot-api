<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');



if(!function_exists('insertDataOnHubSpot')){
    
    function insertDataOnHubSpot($company_data){
        $access_token           =   'pat-na1-d0e6e1e1-05a5-44ca-b96c-882743ebfc97';
        // HubSpot API endpoint for creating a company
        $api_url = "https://api.hubapi.com/companies/v2/companies";
        
        // Set up the cURL request
        $ch = curl_init($api_url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            "Authorization: Bearer $access_token",
            "Content-Type: application/json",
        ));
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($company_data));

        // Execute the cURL request
        $response = curl_exec($ch);

        if ($response === false) {
            die("Error: " . curl_error($ch));
        }

        curl_close($ch);

        // Handle the API response
        $data = json_decode($response, true);

        if (isset($data['companyId'])) {
            $array      =   json_encode(array('status'=>'true','message'=>'record inserted successfully'));
            return $array;
        } else {
            $array      =   json_encode(array('status'=>'false','message'=>$data['message']));
            return $array;
        }
    }
}

if(!function_exists('getCompaniesListFromHubSpot')){
    function getCompaniesListFromHubSpot(){
        $access_token           =   'pat-na1-d0e6e1e1-05a5-44ca-b96c-882743ebfc97';
        $endPoint           =   "https://api.hubapi.com/companies/v2/companies";

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $endPoint);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            "Authorization: Bearer $access_token",
            "Content-Type: application/json",
        ));
        $response = curl_exec($ch);
        if (curl_errno($ch)) {
            echo 'cURL error: ' . curl_error($ch);
        }
        curl_close($ch);
        if ($response) {
            return json_decode($response);
        } else {
            return false;
        }
    }
}

if(!function_exists('getSinleCompanyInfo')){
    function getSinleCompanyInfo($company_id){
        $access_token           =   'pat-na1-d0e6e1e1-05a5-44ca-b96c-882743ebfc97';
        $endPoint           =   "https://api.hubapi.com/companies/v2/companies/".$company_id;

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $endPoint);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            "Authorization: Bearer $access_token",
            "Content-Type: application/json",
        ));
        $response = curl_exec($ch);
        if (curl_errno($ch)) {
            echo 'cURL error: ' . curl_error($ch);
        }
        curl_close($ch);
        if ($response) {
            return json_decode($response);
        } else {
            return false;
        }
    }
}
if (!function_exists('updateCompanyInfo')) {
    
    function updateCompanyInfo($company_id, $company_data) {
        $access_token = 'pat-na1-d0e6e1e1-05a5-44ca-b96c-882743ebfc97';
        // HubSpot API endpoint for updating a company
        $api_url = "https://api.hubapi.com/companies/v2/companies/{$company_id}";

        // Set up the cURL request
        $ch = curl_init($api_url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PUT');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            "Authorization: Bearer $access_token",
            "Content-Type: application/json",
        ));
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($company_data));

        // Execute the cURL request
        $response = curl_exec($ch);

        if ($response === false) {
            die("Error: " . curl_error($ch));
        }

        curl_close($ch);

        // Handle the API response
        $data = json_decode($response, true);
        if (isset($data['companyId'])) {
            $array = json_encode(array('status' => 'true', 'message' => 'record(s) updated successfully'));
            return $array;
        } else {
            $array = json_encode(array('status' => 'false', 'message' => 'record(s) updated failed'));
            return $array;
        }
    }
}


if(!function_exists('getCompanyData')){
    function getCompanyData(){
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://www.hikefoxter.com/hubfs/companies.json");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        if (curl_errno($ch)) {
            echo 'cURL error: ' . curl_error($ch);
        }
        curl_close($ch);
        if ($response) {
            return json_decode($response);
        } else {
            return false;
        }
    }
}