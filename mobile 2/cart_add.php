<?php
header('Access-Control-Allow-Origin: *');
header('Content-type:application/json;charset=utf-8');
	include 'includes/session.php';

	$conn = $pdo->open();

	$output = array('error'=>false);

	$id = $_POST['id'];
	$email = $_POST['email'];
		$quantity = $_POST['quantity'];

		$stmt_user = $conn->prepare("SELECT * FROM users WHERE email=:email");
		$stmt_user->execute(['email'=>$email]);
		$row_user = $stmt_user->fetch();
		
		
			$stmt = $conn->prepare("SELECT *, COUNT(*) AS numrows FROM cart WHERE user_id=:id AND product_id=:product_id");
		$stmt->execute(['id'=>$row_user['id'], 'product_id'=>$id]);
		$row = $stmt->fetch();
		if($row['numrows'] < 1){
			try{
				$stmt = $conn->prepare("INSERT INTO cart (user_id, product_id, quantity) VALUES (:user_id, :product_id, :quantity)");
				$stmt->execute(['user_id'=>$row_user['id'], 'product_id'=>$id, 'quantity'=>$quantity]);
					$output['error'] = false;
				$output['message'] = 'Item added to cart';
				
			}
			catch(PDOException $e){
				$output['error'] = true;
				$output['message'] = $e->getMessage();
			}
		}
		else{
			$output['error'] = true;
			$output['message'] = 'Product already in cart';
		}
	


	$pdo->close();
	echo json_encode($output);

?>