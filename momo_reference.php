<?php
require('vendor/autoload.php');
require_once "send_email.php";
//require_once 'vendor\autoload.php';
use PatricPoba\MtnMomo\MtnConfig;
use PatricPoba\MtnMomo\MtnCollection;

session_start();
 $reference_key=$_SESSION['reference_key'];
 $newtoken=$_SESSION['token'];

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
     $_SESSION['insert']=1;
     $amount_paid=$_SESSION['amount_paid'];
     $rest=$_SESSION['rest'];
     $msg = "Payment Succesufuly done please check your email for more details or call:+250788308398";
    echo "<script type='text/javascript'>alert('$msg');</script>";
     	$message = "
						<h2>Thank you for Shopping with Us.</h2><br/>
						<h4>Amount Paid by Momo: $amount_paid</h4>
						<h4>Amount To Be Paid on Deliver: $rest</h4>
						
						<p>We are processing your order and our sales agent will be contacting you soon. for any qeustion don't hesitate to contactus on Tel: +250788308398 </p>
						
					";
	    $email=$user['email'];
	    $subject='The order succesfuly Paid';
       send_email($email,$message,$subject);
    header('location: sales.php'); 
    
   
    
    
 }
 else{
$_SESSION['insert']=0;
unset($_SESSION['success']);
unset($_SESSION['error']);
$amount_paid=$_SESSION['amount_paid'];
$rest=$_SESSION['rest'];
  $_SESSION['error']=$data_array['status']." we are unable to process transaction please check if you have enough found for this transaction and try again. or contact us call:+250788308398 ";
  //header('location: cart_view2.php'); 
  $msg = "Payment Succesufuly done please check your email or call:+250788308398";
    echo "<script type='text/javascript'>alert('$msg');</script>";
     	$message = "
						<h2>Thank you for Shopping with Us.</h2>
	
						
						<p>we are unable to process transaction please check if you have enough found for this transaction and try again. or contact us call:+250788308398 </p>
						
					";
	   $email=$user['email'];
	    $subject='The order succesfuly Paid';
       send_email($email,$message,$subject);
       
    header('location: sales.php'); 
 }
 

}
catch (HttpException $ex)
{
    echo $ex;
}

?>