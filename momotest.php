<?php
require_once 'vendor\autoload.php';
//use  'pear/http_request2';
use PatricPoba\MtnMomo\MtnConfig;
use PatricPoba\MtnMomo\MtnCollection;

//generate taken key

$request_token = new HTTP_Request2();
$request_token->setUrl('https://mtndeveloperapi.portal.mtn.co.rw/collection/token/');
$request_token->setMethod(HTTP_Request2::METHOD_POST);
$newtoken;
$request_token->setConfig(array(
  'follow_redirects' => TRUE
));
$request_token->setHeader(array(
  'Ocp-Apim-Subscription-Key' => '78404b36be7f4083ab3e66b883d2adaa',
  'Authorization' => 'Basic YmVhNzgwODMtYWZmNi00NmNiLWJmMWItNjdkM2IyNWFlYzZhOmUzZDZmYTYxODEzMDQ0NTE5OTFjYzMzYjhiNDUyYmY4'
));
$request_token->setBody('');
try {
  $response_token = $request_token->send();
  if ($response_token->getStatus() == 200) {
    $arraystring=$response_token->getBody();
	$arr = json_decode($arraystring, true);
	$token=$arr['access_token'];
	$newtoken='Bearer '.$token;
	//echo $newtoken;
  }
  else {
    echo 'Unexpected HTTP status on token: ' . $response_token->getStatus() . ' ' .
    $response_token->getReasonPhrase();
  }
}
catch(HTTP_Request2_Exception $e) {
  echo 'Error: ' . $e->getMessage();
}
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
// request to pay
$request = new HTTP_Request2();
$request->setUrl('https://mtndeveloperapi.portal.mtn.co.rw/collection/v1_0/requesttopay');
$request->setMethod(HTTP_Request2::METHOD_POST);
$request->setConfig(array(
  'follow_redirects' => TRUE
));

$reference_key=generatekey();
echo $reference_key; 
$request->setHeader(array(
  'X-Reference-Id' => $reference_key,
  'X-Target-Environment' => 'mtnrwanda',
  'Ocp-Apim-Subscription-Key' => '78404b36be7f4083ab3e66b883d2adaa',
  'Content-Type' => 'application/json',
  'Authorization' => $newtoken
));
$request->setBody('{
  "amount": "12000",
  "currency": "RWF",
  "externalId": "6354636",
  "payer": {
    "partyIdType": "MSISDN",
    "partyId": "250786138376"
  },
  "payerMessage": "payment request test",
  "payeeNote": "string"
}');
try {
  $response = $request->send();
  if ($response->getStatus() == 202) {
    echo $response->getBody();
	
  }
  else {
    echo 'Unexpected HTTP status: ' . $response->getStatus() . ' ' .
    $response->getReasonPhrase();
  }
}
catch(HTTP_Request2_Exception $e) {
  echo 'Error: ' . $e->getMessage();
}

//get transaction details

$url="https://mtndeveloperapi.portal.mtn.co.rw/collection/v1_0/requesttopay/$reference_key";

$gettransaction = new Http_Request2($url);
$url_trans = $gettransaction->getUrl();

$headers = array(
    // Request headers
  'X-Target-Environment' => 'mtnrwanda',
  'Ocp-Apim-Subscription-Key' => '78404b36be7f4083ab3e66b883d2adaa',
  'Content-Type' => 'application/json',
  'Authorization' => $newtoken
);
$gettransaction->setHeader($headers);
$parameters = array();

$url_trans->setQueryVariables($parameters);

$gettransaction->setMethod(HTTP_Request2::METHOD_GET);

// Request body
$gettransaction->setBody("{body}");

try
{
    $response_trans= $gettransaction->send();
    echo $response_trans->getBody();
}
catch (HttpException $ex)
{
    echo $ex;
}


?>