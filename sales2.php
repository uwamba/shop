<?php
	include 'includes/session.php';

	if(isset($_SESSION['user'])){
		//$payid = $_SESSION['reference_key'];
		$date = date('Y-m-d');
		$id = $_SESSION['user'];
		$conn = $pdo->open();
		try{
			$shipping_reference =$_SESSION['shipping_reference'] ;
			
			$stmt = $conn->prepare("INSERT INTO sales (user_id, pay_id, sales_date, shipping) VALUES (:user_id, :pay_id, :sales_date, :shipping)");
			$stmt->execute(['user_id'=>$user['id'], 'pay_id'=>$shipping_reference, 'sales_date'=>$date, 'shipping'=>$shipping_reference]);
			$salesid = $conn->lastInsertId();
			
			
			
			try{
				$stmt = $conn->prepare("SELECT * FROM cart LEFT JOIN products ON products.id=cart.product_id WHERE user_id=:user_id");
				$stmt->execute(['user_id'=>$user['id']]);

				foreach($stmt as $row){
					$stmt = $conn->prepare("INSERT INTO details (sales_id, product_id, quantity) VALUES (:sales_id, :product_id, :quantity)");
					$stmt->execute(['sales_id'=>$salesid, 'product_id'=>$row['product_id'], 'quantity'=>$row['quantity']]);
				}

				$stmt = $conn->prepare("DELETE FROM cart WHERE user_id=:user_id");
				$stmt->execute(['user_id'=>$user['id']]);

				$_SESSION['success'] = 'Transaction successful. Thank you.';
				//unset($_SESSION['reference_key']);
				//unset($_SESSION['token']);
				unset($_SESSION['shipping_reference'] );
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
	
?>