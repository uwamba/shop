<?php
	include 'includes/session.php';

	if(isset($_GET['product_id'])){
		$id = $_GET['product_id'];
			$display = $_GET['product_display'];
			$new_display="";
			if($display==1){
			    	$new_display="0";
			}
			else{
			  	$new_display="1";  
			}
		
		$conn = $pdo->open();
		

		try{
			$stmt = $conn->prepare("UPDATE products set display=:display  WHERE id=:id");
			$stmt->execute(['id'=>$id,'display'=>$new_display]);
			
			$_SESSION['success'] = 'Updated successfully';
		}
		catch(PDOException $e){
			$_SESSION['error'] = $e->getMessage();
		}

		$pdo->close();
	}
	else{
		$_SESSION['error'] = 'unable to update try again';
	}

	header('location: products.php');
	
?>