<?php 
	include 'includes/session.php';
	
	       $conn = $pdo->open();
	       $stmt = $conn->prepare("SELECT id,name,photo,price FROM products WHERE display=0");
		   $stmt->execute();
		   foreach ($stmt as $row[]) {
						    //	$image = (!empty($row['photo'])) ? 'images/'.$row['photo'] : 'images/noimage.jpg';
					
	       	$item = $row;
	 
	       $json = json_encode($item, JSON_NUMERIC_CHECK);	
		}
		$stmt2 = $conn->prepare("SELECT * FROM category");
		   $stmt2->execute();
		   foreach ($stmt2 as $row2[]) {
						    //	$image = (!empty($row['photo'])) ? 'images/'.$row['photo'] : 'images/noimage.jpg';
					
	       	$item2 = $row2;
	 
	       $json2 = json_encode($item2, JSON_NUMERIC_CHECK);	
		}
     echo $json;
	 echo $json2;
	 $pdo->close();
?>