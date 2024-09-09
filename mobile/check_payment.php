<?php
header('Access-Control-Allow-Origin: *');
header('Content-type:application/json;charset=utf-8');
require('vendor/autoload.php');
require_once "send_email.php";
//require_once 'vendor\autoload.php';
use PatricPoba\MtnMomo\MtnConfig;
use PatricPoba\MtnMomo\MtnCollection;


 $reference_key=$_POST['reference_key'];
 $newtoken=$_POST['token'];
 $amount_paid=$_POST['amount_paid'];
 $rest=$_POST['rest'];
 $email=$_POST['email'];
 $date = date('Y-m-d');
 $id = $_POST['user_id'];
 $amount_transport= $_POST['transport'];
 $shipping_reference =$_POST['shipping_ref'] ;

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
     //$_SESSION['insert']=1;
     $return["code"]=0;
     $return["status"]="SUCCESSFUL";
     $return["success"] = "Payment Succesufuly done please check your email for more details or call:+250788308398";
     $message = "
						<h2>Thank you for Shopping with Us.</h2><br/>
						<h4>Amount Paid by Momo: $amount_paid</h4>
						<h4>Amount To Be Paid on Deliver: $rest</h4>
						
						<p>We are processing your order and our sales agent will be contacting you soon. for any qeustion don't hesitate to contactus on Tel: +250788308398 </p>
						
					";
	 $subject='The order succesfuly Paid';
    //send_email($email,$message,$subject);
insertData();
 }
 else  if($data_array['status']=='PENDING'){
     $return["status"]="PENDING";
 $return["code"]=1;
  $return["success"] ="your payment is pending for approval please dial *182*7*1# or us call:+250788308398 ";
     
	    $subject='The order Not succesfuly Paid';
       //send_email($email,$message,$subject);
   // insertData();   
 }
 else  if($data_array['status']=='FAILED'){
 $return["code"]=2;
 $return["status"]="FAILLED";
  $return["success"] ="your payment is failed please try again ";
     	
    //insertData();   
 }

}
catch (HttpException $ex)
{

}

echo json_encode($return);

function insertData(){
	
        include 'includes/session.php';
        $reference_key=$_POST['reference_key'];
 $newtoken=$_POST['token'];
 $amount_paid=$_POST['amount_paid'];
 $rest=$_POST['rest'];
 $email=$_POST['email'];
 $date = date('Y-m-d');
 $id = $_POST['user_id'];
 $amount_transport= $_POST['transport'];
 $shipping_reference =$_POST['shipping_ref'] ;
		$conn = $pdo->open();
		try{
			
			
			$stmt = $conn->prepare("INSERT INTO sales (user_id, pay_id, sales_date, shipping,shipping_price,paid,not_paid,total) VALUES (:user_id, :pay_id, :sales_date, :shipping,:shipping_price,:paid,:not_paid,:total)");
			$stmt->execute(['user_id'=>$id, 'pay_id'=>$reference_key, 'sales_date'=>$date, 'shipping'=>$shipping_reference,'shipping_price'=>$amount_transport,'paid'=>$amount_paid,'not_paid'=>$rest,'total'=>$amount_paid]);
			$salesid = $conn->lastInsertId();
			
			
			
			try{
			    
    			$stmt_update = $conn->prepare("UPDATE shipping SET status=:status WHERE reference=:reference");
    			$stmt_update->execute(['status'=>'Order In Process', 'reference'=>$shipping_reference]);
    		
			    
				$stmt = $conn->prepare("SELECT * FROM cart LEFT JOIN products ON products.id=cart.product_id WHERE user_id=:user_id");
				$stmt->execute(['user_id'=>$id]);

				foreach($stmt as $row){
					$stmt = $conn->prepare("INSERT INTO details (sales_id, product_id, quantity) VALUES (:sales_id, :product_id, :quantity)");
					$stmt->execute(['sales_id'=>$salesid, 'product_id'=>$row['product_id'], 'quantity'=>$row['quantity']]);
				}

				$stmt = $conn->prepare("DELETE FROM cart WHERE user_id=:user_id");
				$stmt->execute(['user_id'=>$id]);

					$return['success'] = 'Transaction successful. Thank you for buying, please check your email to for more detail or call: call:+250788308398.';
			
			}
			catch(PDOException $e){
				$return['success'] = $e->getMessage();
			}

		}
		catch(PDOException $e){
				$return['success'] = $e->getMessage();
		}

		$pdo->close();
	
	}
  

?>