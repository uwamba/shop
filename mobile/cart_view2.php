<?php 
header('Access-Control-Allow-Origin: *');
header('Content-type:application/json;charset=utf-8');
	include 'includes/session.php';
	
	       $conn = $pdo->open();
	       $stmt = $conn->prepare("SELECT (products.price * cart.quantity) AS subtotal, products.id,products.brand,products.name,products.photo,products.price, cart.quantity FROM cart LEFT JOIN products ON products.id=cart.product_id LEFT JOIN category ON category.id=products.category_id WHERE user_id=52");
		   $stmt->execute();
		   foreach ($stmt as $row[]) {
						    //	$image = (!empty($row['photo'])) ? 'images/'.$row['photo'] : 'images/noimage.jpg';
					
	       	$item = $row;
	 
	       $json = json_encode($item, JSON_NUMERIC_CHECK);	
		}

	 echo $json;
	 $pdo->close();
?>
