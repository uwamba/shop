<?php
include 'includes/session.php';
//require_once 'vendor\autoload.php';
//use  'pear/http_request2';
require('vendor/autoload.php');
//require_once __DIR__ .'\vendor\autoload.php';
use PatricPoba\MtnMomo\MtnConfig;
use PatricPoba\MtnMomo\MtnCollection;

session_start();
 $reference_key=$_GET['reference_key'];
 $sales_reference=$_GET['sales_reference'];
 $newtoken='';
 
 
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
  }
  else {
    echo 'Unexpected HTTP status on token: ' . $response_token->getStatus() . ' ' .
    $response_token->getReasonPhrase();
  }
}
catch(HTTP_Request2_Exception $e) {
  echo 'Error: ' . $e->getMessage();
}

 

//get transaction details
$request = new HTTP_Request2();
$url="https://proxy.momoapi.mtn.co.rw/collection/v1_0/requesttopay/{$reference_key}";


$request = new Http_Request2($url);
$url = $request->getUrl();

$headers = array(
    // Request headers
    'Authorization' => $newtoken,
    'X-Target-Environment' => 'mtnrwanda',
    'Ocp-Apim-Subscription-Key' => '52f3a966402348388ad31a5f860504c6',
);

$request->setHeader($headers);

$parameters = array(
    // Request parameters
);

$url->setQueryVariables($parameters);

$request->setMethod(HTTP_Request2::METHOD_GET);

// Request body
$request->setBody("{body}");

try
{
    $response = $request->send();
    
  $data=$response->getBody();
  $data_array = json_decode($data, true);       

 //echo $data_array['status'];
 //echo $data_array['reason'];
 //echo $data_array['payeeNote'];
 //echo $data_array['payerMessage'];
// echo $data_array['partyId'];
 //echo $data_array['partyIdType'];
 //echo $data_array['payer'];
 //echo $data_array['currency'];
 //echo $data_array['amount'];
 //echo $data_array['externalId'];
 
  
 function display_array_recursive($data_rec){
     if($data_rec){
         
         foreach ($data_rec as $key => $value )
          if(is_array($value)){
              display_array_recursive($value);
          }
          else{
              echo '-------'.$value.'<br>';
          }
     }
     
 }
 
 if($data_array['status']=='SUCCESSFUL'){
    $conn = $pdo->open();
     $stmt = $conn->prepare("UPDATE shipping SET status=:status WHERE reference=:reference");
    $stmt->execute(['status'=>'Oder Processing', 'reference'=>$sales_reference]);
    header('location: sales/sales.php');  
 }
 else{
    $_SESSION['error'] = 'Transaction Failled '.$data_array['reason'];
   header('location: sales/sales.php'); 
 }
 

}
catch (HttpException $ex)
{
    echo $ex;
}

?>