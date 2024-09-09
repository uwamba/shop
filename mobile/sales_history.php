<?php
header('Access-Control-Allow-Origin: *');
header('Content-type:application/json;charset=utf-8');
	include 'includes/session.php';
	        						$conn = $pdo->open();
	        						

	        						try{
	        						
	        								$stmt2 = $conn->prepare("SELECT  (products.price * details.quantity) AS subtotal, products.id,products.brand,products.name,products.photo,products.price FROM details LEFT JOIN products ON products.id=details.product_id WHERE sales_id=:id");
	        								$stmt2->execute(['id'=>$row['id']]);
	        								$total = 0;
	        								foreach($stmt2 as $row2){
	        									$subtotal = $row2['subtotal'];
	        									$total += $subtotal;
	        									
	        								}

	        						}
        							catch(PDOException $e){
        							    	$return["error"] = $e->getMessage();
									
									}

	        						$pdo->close();
	        						header('Content-Type: application/json');
                                    echo json_encode($return);
	        					?>