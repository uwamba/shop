<?php 
header('Access-Control-Allow-Origin: *');
header('Content-type:application/json;charset=utf-8');
	include 'includes/session.php';
	$id=$_POST['id'];
	
	       $conn = $pdo->open();
	      $stmt = $conn->prepare("SELECT * FROM details LEFT JOIN products ON products.id=details.product_id JOIN sales on details.sales_id=sales.id WHERE sales.id=:id ");
		   $stmt->execute(['id'=>$id]);
		   foreach ($stmt as $row[]) {
				
					
	       	$item = $row;
	 
	       $json = json_encode($item, JSON_NUMERIC_CHECK);	
		}

	 echo $json;
	 $pdo->close();
?>
