<?php
require_once 'vendor\autoload.php';
use PatricPoba\MtnMomo\MtnConfig;
use PatricPoba\MtnMomo\MtnCollection;

session_start();
 $reference_key=$_GET['reference_key'];
 $newtoken=$_SESSION['token'];
 
 
 //generate token key

$request = new HTTP_Request2();
$request->setUrl('https://mtndeveloperapi.portal.mtn.co.rw/collection/token/');
$request->setMethod(HTTP_Request2::METHOD_POST);

$request->setConfig(array(
  'follow_redirects' => TRUE
));
$request->setHeader(array(
  'Ocp-Apim-Subscription-Key' => '78404b36be7f4083ab3e66b883d2adaa',
  'Authorization' => 'Basic YmVhNzgwODMtYWZmNi00NmNiLWJmMWItNjdkM2IyNWFlYzZhOmUzZDZmYTYxODEzMDQ0NTE5OTFjYzMzYjhiNDUyYmY4'
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
$url="https://mtndeveloperapi.portal.mtn.co.rw/collection/v1_0/requesttopay/$reference_key";


$request = new Http_Request2($url);
$url = $request->getUrl();

$headers = array(
    // Request headers
    'Authorization' => $newtoken,
    'X-Target-Environment' => 'mtnrwanda',
    'Ocp-Apim-Subscription-Key' => '78404b36be7f4083ab3e66b883d2adaa',
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
    header('location: sales.php');  
 }
 else{
  //header('location: cart_view2.php'); 
//header('location: sales.php');    
 }
 

}
catch (HttpException $ex)
{
    echo $ex;
}

?>