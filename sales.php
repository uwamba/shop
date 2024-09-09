<?php
	include 'includes/session.php';
    if($_SESSION['insert']==1){
	if(isset($_SESSION['user'])){
		$payid = $_SESSION['reference_key'];
		$date = date('Y-m-d');
		$id = $_SESSION['user'];
		$amount_transport= $_SESSION['transport'];
		$amount_paid=$_SESSION['amount_paid'];
        $rest=$_SESSION['rest'];
        
		$conn = $pdo->open();
		try{
			$shipping_reference =$_SESSION['shipping_reference'] ;
			
			$stmt = $conn->prepare("INSERT INTO sales (user_id, pay_id, sales_date, shipping,shipping_price,paid,not_paid,total) VALUES (:user_id, :pay_id, :sales_date, :shipping,:shipping_price,:paid,:not_paid,:total)");
			$stmt->execute(['user_id'=>$user['id'], 'pay_id'=>$payid, 'sales_date'=>$date, 'shipping'=>$shipping_reference,'shipping_price'=>$amount_transport,'paid'=>$amount_paid,'not_paid'=>$rest,'total'=>$amount_paid]);
			$salesid = $conn->lastInsertId();
			
			
			
			try{
			    
    			$stmt_update = $conn->prepare("UPDATE shipping SET status=:status WHERE reference=:reference");
    			$stmt_update->execute(['status'=>'Order In Process', 'reference'=>$shipping_reference]);
    		
			    
				$stmt = $conn->prepare("SELECT * FROM cart LEFT JOIN products ON products.id=cart.product_id WHERE user_id=:user_id");
				$stmt->execute(['user_id'=>$user['id']]);

				foreach($stmt as $row){
					$stmt = $conn->prepare("INSERT INTO details (sales_id, product_id, quantity) VALUES (:sales_id, :product_id, :quantity)");
					$stmt->execute(['sales_id'=>$salesid, 'product_id'=>$row['product_id'], 'quantity'=>$row['quantity']]);
				}

				$stmt = $conn->prepare("DELETE FROM cart WHERE user_id=:user_id");
				$stmt->execute(['user_id'=>$user['id']]);

				$_SESSION['success'] = 'Transaction successful. Thank you for buying, please check your email to for more detail or call: call:+250788308398.';
				unset($_SESSION['reference_key']);
				unset($_SESSION['token']);
				unset($_SESSION['shipping_reference'] );
				unset($_SESSION['rest'] );
				unset($_SESSION['amount_paid'] );
                header('location: profile.php');
			}
			catch(PDOException $e){
				$_SESSION['error'] = $e->getMessage();
			}

		}
		catch(PDOException $e){
			$_SESSION['error'] = $e->getMessage();
		}

		$pdo->close();
	
	
	//header('location: profile.php');
	}
    }
    else{
      $_SESSION['Payment transaction failed please check is you have enough momey on you momo'];
      header('location: profile.php');   
    }
	
?>