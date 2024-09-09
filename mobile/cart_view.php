
<?php 
header('Access-Control-Allow-Origin: *');
header('Content-type:application/json;charset=utf-8');
include 'includes/conn.php';
	       $id=85;
	       echo $id;
	       $conn = $pdo->open();
	       $stmt = $conn->prepare("SELECT (products.price * cart.quantity) AS subtotal, products.id,products.brand,products.name,products.photo,products.price, cart.quantity,cart.id as cart_id FROM cart LEFT JOIN products ON products.id=cart.product_id LEFT JOIN category ON category.id=products.category_id WHERE cart.user_id=:id");
		   $stmt->execute(['id' => $id]);
		   foreach ($stmt as $row[]) {
	       $item = $row;
	       if($item){
	           echo "items";
	       }else{
	          echo'no items'; 
	       }
	       $json = json_encode($item, JSON_NUMERIC_CHECK);	
	       
		}

	 echo $json;
	 $pdo->close();
?>
