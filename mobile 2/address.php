<?php
header('Access-Control-Allow-Origin: *');
header('Content-type:application/json;charset=utf-8');
	include 'includes/session.php';

		//$payid = $_POST['reference'];
		$date = date('Y-m-d');
        $name = $_POST['firstname'];
		$sname = $_POST['lastname'];
	    //$email =  $_POST['id'];
		$region = $_POST['region'];
		$phone = $_POST['phone'];
		$street = $_POST['street'];
		$email = $_POST['email'];
		$conn = $pdo->open();
		$shipping_reference= uniqid();
		
		 $stmt_user = $conn->prepare("SELECT * FROM users WHERE email=:email");
		 $stmt_user->execute(['email'=>$email ]);
		 $row_user = $stmt_user->fetch();
		 
		 
		 $stmt_price = $conn->prepare("SELECT * FROM district WHERE id=:id");
		 $stmt_price->execute(['id'=>$region ]);
		 $row_price = $stmt_price->fetch();
		 $amount=$row_price['price'];
		try{
			
			$stmt = $conn->prepare("INSERT INTO shipping (user_id, location, phone, street ,date , status, reference,price) VALUES (:user_id, :location, :phone, :street, :date, :status, :reference,:price)");
			$stmt->execute(['user_id'=>$row_user['id'], 'location'=>$region, 'phone'=>$phone, 'street'=>$street, 'date'=>$date, 'status'=>'pending for payment', 'reference'=>$shipping_reference,'price'=>$amount]);
			$salesid = $conn->lastInsertId();
		    $return["message"]  = 'Transaction successful. Thank you.';
		   	$return["success"] = true;
           $return["reference"] = $shipping_reference;
           
           $stmt_total = $conn->prepare("SELECT * FROM cart LEFT JOIN products on products.id=cart.product_id WHERE user_id=:user_id");
		   $stmt_total->execute(['user_id'=>52]);
           $total = 0;
           foreach($stmt_total as $row_total){
        			$subtotal = $row_total['price'] * $row_total['quantity'];
        			$total += $subtotal;
        		}
              $total=$total+$row_price['price'];
              
             $return["total"] = $total;
             $return["shipping"] = $row_price['price'];
        			
		}
		catch(PDOException $e){
		   $return["error"] = true;
          $return["message"] = $e->getMessage();
		}

		$pdo->close();
		 echo json_encode($return);
	
	
	
	    
	
?>