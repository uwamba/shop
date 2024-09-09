<?php 
header('Access-Control-Allow-Origin: *');
header('Content-type:application/json;charset=utf-8');
include 'includes/session.php'; ?>
<?php
	$conn = $pdo->open();

   $id = $_POST['id'];

	try{
		 		
	    $stmt = $conn->prepare("SELECT *, products.name AS prodname, category.name AS catname, products.id AS prodid FROM products LEFT JOIN category ON category.id=products.category_id WHERE products.id = :id");
	    $stmt->execute(['id' => $id]);
		   foreach ($stmt as $row[]) {
						    //	$image = (!empty($row['photo'])) ? 'images/'.$row['photo'] : 'images/noimage.jpg';
					
	       	$item = $row;
	 
	       $json = json_encode($item, JSON_NUMERIC_CHECK);	
		}
		echo $json;
	}
	catch(PDOException $e){
		echo "There is some problem in connection: " . $e->getMessage();
	}





?>
