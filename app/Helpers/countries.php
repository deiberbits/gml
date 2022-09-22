<?php


if (!function_exists('getCountries')) {
    function getCountries()
    {
        //Get countries from CURL request
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => env('API_COUNTRIES'),
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "cache-control: no-cache"
            ),
        ));
        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);
        if ($err) {
            return "cURL Error #:" . $err;
        } else {
            $decode = json_decode($response, true);
            return $decode['data'];
        }
    }
}
