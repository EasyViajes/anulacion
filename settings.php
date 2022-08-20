<?php
session_start();
ob_start();
error_reporting(E_ERROR | E_PARSE);
ini_set('display_errors', 'On');

$TOKEN = ('SomeValidToken');

function wsdl($xml,$url){

    //setting the curl parameters.
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    // Following line is compulsary to add as it is:
    curl_setopt($ch, CURLOPT_POSTFIELDS, $xml);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 300);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_FAILONERROR, true);
    curl_setopt ($ch, CURLOPT_HTTPHEADER, Array("Content-Type: text/xml"));
    $response = curl_exec($ch);
    $error_curl = curl_errno($ch);
    $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

    if ($error_curl) {
      $res = "cURL Error #".$httpcode.": ".curl_error($ch);
      $error = $res;
      return array("error_curl"=>$error);
    }
    curl_close($ch);
    
    $resp = explode('<SOAP-ENV:Body>', $response);
    $resp = explode('</SOAP-ENV:Body>', $resp[1]);
    $response = $resp[0];
    
    $parser = simplexml_load_string($response);
    $response = json_decode((string) $parser->return[0], true);
    return $response;
  }
?>
