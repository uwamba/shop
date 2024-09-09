<?php 
header('Access-Control-Allow-Origin: *');
header('Content-type:application/json;charset=utf-8');
	include 'includes/session.php';
	       $id=$_POST['id'];
	       $conn = $pdo->open();
		   $stmt = $conn->prepare("SELECT *, sales.id as sales_id FROM sales JOIN shipping on sales.shipping_id=shipping.reference WHERE sales.user_id=:user_id ORDER BY sales.sales_date DESC");
			 $stmt->execute(['user_id'=>$id]);
		     foreach ($stmt as $row[]) {
						  
					
	       	$item = $row;
	 
	       $json = json_encode($item, JSON_NUMERIC_CHECK);	
		}

	 echo $json;
	 $pdo->close();
?>
