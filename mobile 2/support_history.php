<?php 
header('Access-Control-Allow-Origin: *');
header('Content-type:application/json;charset=utf-8');
	include 'includes/session.php';
	
	       $id=$_POST['id'];
	       $conn = $pdo->open();
	       
	       $stmt1=$conn->prepare("SELECT * from items where serial_number=:id or barcode=:barcode");
	       $stmt1->execute(["id"=>$id,"barcode"=>$id]);
	       $row1 = $stmt1->fetch();
	       //echo $row1['id'];
	       $stmt = $conn->prepare("SELECT * from support  where item_id=:id");
	       $stmt->execute(["id"=>$row1['id']]);
		   foreach ($stmt as $row[]) {
						   
	       	$item = $row;
	 
	       $json = json_encode($item, JSON_NUMERIC_CHECK);	
		}
	
	 echo $json;
	 $pdo->close();
?>
