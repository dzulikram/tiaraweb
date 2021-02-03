<?php

namespace App\Traits;

use GuzzleHttp\Client;

trait ConsumeExternalService
{
    /**
     * Send request to any service
     * @param $method
     * @param $requestUrl
     * @param array $formParams
     * @param array $headers
     * @return string
     */
    public function performRequest($method, $baseUri, $secret, $requestUrl, $jsonParam = [], $formParams = [])
    {
        $client = new \GuzzleHttp\Client();
        //dd($jsonParam);
        $headers['Authorization'] = "Bearer ".$secret;
        //$headers['Accept'] = 'application/json';
        $response = $client->request($method, $baseUri.$requestUrl, [
            'json' => $jsonParam,
            'form_params' => $formParams,
            'headers'     => $headers,
            'verify'      => false
        ]);
        return $response;
    }

    public function performRequestCurl($method,$baseUri,$secret,$requestUrl,$jsonParam)
    {
        // persiapkan curl
        $ch = curl_init(); 
        // set url 
        curl_setopt($ch, CURLOPT_URL, $baseUri.$requestUrl);
        // return the transfer as a string 
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Authorization: Bearer '.$secret,
            'accept: application/json',
            'content-type: application/json',
          ));
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonParam);

        // $output contains the output string 
        $output = curl_exec($ch); 
        $status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        // tutup curl 
        curl_close($ch);      

        // menampilkan hasil curl
        return ['response' => $output,'statusCode' => $status_code ];
    }
}