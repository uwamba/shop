<?php
header('Access-Control-Allow-Origin: *');
header('Content-type:application/json;charset=utf-8');
include 'includes/session.php';
//require_once 'vendor\autoload.php';
//use  'pear/http_request2';
require('vendor/autoload.php');
//require_once __DIR__ .'\vendor\autoload.php';
use PatricPoba\MtnMomo\MtnConfig;
use PatricPoba\MtnMomo\MtnCollection;
$newtoken;
$amount=0;
$rest=0;
    $return[]='';
   $number=$_POST['number'];
   $amount=$_POST['amount'];
    //$amount=1000;
if($amount>2000000){
     $new_amount=$amount;
     $amount=2000000;
     $rest= $new_amount-$amount;
     	$return["amount"] = $amount;
     	$return["rest"] = $rest;
     	$return["message"] = 'Please note that total amount was RWF '.$new_amount.' The 2M wilbe paid with momo and the rest ('.$rest.') will be paid on Delivery by clicking on continue you accept the condition for any question call: +250788308398';
    
   }
else{
    	$return["message"] ="Total Amount: ".$amount;
    	$return["amount"] = $amount;
    	$return["rest"] = 0;
  
}
    
   

//generate token key

$request = new HTTP_Request2();
$request->setUrl('https://proxy.momoapi.mtn.co.rw/collection/token/');
$request->setMethod(HTTP_Request2::METHOD_POST);

$request->setConfig(array(
  'follow_redirects' => TRUE
));
$request->setHeader(array(
  'Ocp-Apim-Subscription-Key' => '52f3a966402348388ad31a5f860504c6',
  'Authorization' => 'Basic YTgwM2I4MTEtOTFmNC00NzNiLWEzZjAtMjQ2NjY0NjExMTQ0OmMyNTIzOTI1ZjQxMjQ0MWY5NDQzMmRiNWMwNTkwZTA2'
));
$request->setBody('');
try {
  $response_token = $request->send();
  
  
  
  if ($response_token->getStatus() == 200) {
    $arraystring=$response_token->getBody();
	$arr = json_decode($arraystring, true);
	$token=$arr['access_token'];
	$newtoken='Bearer '.$token;
     // Generate reference key
     $reference_key; 
    function generatekey($data = null) {
    // Generate 16 bytes (128 bits) of random data or use the data passed into the function.
    $data = $data ?? random_bytes(16);
    assert(strlen($data) == 16);

    // Set version to 0100
    $data[6] = chr(ord($data[6]) & 0x0f | 0x40);
    // Set bits 6-7 to 10
    $data[8] = chr(ord($data[8]) & 0x3f | 0x80);

    // Output the 36 character UUID.
    return vsprintf('%s%s-%s-%s-%s-%s%s%s', str_split(bin2hex($data), 4));
    }
    $reference_key=generatekey();
    
    if(isset($reference_key)){
     
        $request->setUrl('https://proxy.momoapi.mtn.co.rw/collection/v1_0/requesttopay');
      $request->setMethod(HTTP_Request2::METHOD_POST);
      $request->setConfig(array(
        'follow_redirects' => TRUE
      ));

      $reference_key=generatekey();
      	$return["reference_key"] = $reference_key;
      $request->setHeader(array(
        'X-Reference-Id' => $reference_key,
        'X-Target-Environment' => 'mtnrwanda',
        'Ocp-Apim-Subscription-Key' => '52f3a966402348388ad31a5f860504c6',
        'Content-Type' => 'application/json',
        'Authorization' => $newtoken
      ));


       $data = [
         "amount" => $amount, 
         "currency" => "RWF", 
         "externalId" => "6354636", 
         "payer" => [
               "partyIdType" => "MSISDN", 
               "partyId" => $number 
            ], 
         "payerMessage" => "payment request", 
         "payeeNote" => "please confirm" 
      ];

     

      $request->setBody(json_encode($data));
      try {
        $response = $request->send();
        if ($response->getStatus() == 202 || $response->getStatus() == 202) {
          $response->getReasonPhrase();
          $return["success"] = "The payment request have been initiated. Please check on your phone and confirm or dial *182*7*1# confirm your payemnt and  then after click on continue";
          $return["token"] = $newtoken;
          
        }
        else {
          echo 'Unexpected HTTP status: ' . $response->getStatus() . ' ' .
           $return["success"] =$response->getReasonPhrase();
        }
      }
      catch(HTTP_Request2_Exception $e) {
       $return["success"] = $e->getMessage();
      }

        
    }

    
      






  }
  else {
    echo 'Unexpected HTTP status on token: ' . $response_token->getStatus() . ' ' .
    $response_token->getReasonPhrase();
    $return["success"] =$e->getMessage();
  }
}
catch(HTTP_Request2_Exception $e) {
 $return["success"] =$e->getMessage();
}


// request to pay
 header('Content-type:application/json');
      echo json_encode($return);
       


?>
