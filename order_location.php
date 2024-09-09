<?php
	include 'includes/session.php';

	if(isset($_POST['order'])){
	    $region = $_POST['region'];
	  	if($region=='District')  {
	  	     $_SESSION['error'] = 'Please select District.----'.$region;
		 
             header('location: order.php');
	  	}
	  	else{
		
		//$payid = $_POST['reference'];
		$date = date('Y-m-d');
       $name = $_POST['firstname'];
		$sname = $_POST['lastname'];
		$id = $_SESSION['user'];
		//$house = $_POST['plotnumber'];
		$region = $_POST['region'];
		$phone = $_POST['mobilenumber'];
		$street = $_POST['street'];
		$email = $_POST['email'];
		$conn = $pdo->open();
		$shipping_reference= uniqid();
		
		 $stmt_price = $conn->prepare("SELECT * FROM district WHERE id=:id");
		 $stmt_price->execute(['id'=>$region ]);
		 $row_price = $stmt_price->fetch();
		 $_SESSION['transport']=$row_price['price'];
		 $amount=$row_price['price'];
		try{
			
			$stmt = $conn->prepare("INSERT INTO shipping (user_id, location, phone, street ,date , status, reference,price) VALUES (:user_id, :location, :phone, :street, :date, :status, :reference,:price)");
			$stmt->execute(['user_id'=>$user['id'], 'location'=>$region, 'phone'=>$phone, 'street'=>$street, 'date'=>$date, 'status'=>'pending for payment', 'reference'=>$shipping_reference,'price'=>$amount]);
			$salesid = $conn->lastInsertId();
			$_SESSION['success'] = 'Transaction successful. Thank you.';
			$_SESSION['location'] = $region ;
			$_SESSION['shipping_reference'] = $shipping_reference ;
			header('location: cart_view2.php');
			
		}
		catch(PDOException $e){
			$_SESSION['error'] = $e->getMessage();
		}

		$pdo->close();
	
	
	//header('location: index.php');
	}
	    
	}
	
?>