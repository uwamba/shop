<?php
	include 'includes/session.php';; 
    
	if(isset($_POST['add'])){
	    
	    
        
	    
		$barcode = $_POST['barcode'];
		$serial_new = $_POST['serial'];
		$item = $_POST['item'];
	
		
		$conn = $pdo->open();

     
		
		$stmt2 = $conn->prepare("DELETE FROM items WHERE serial_number=:serial_number");
		$stmt2->execute(['serial_number'=>$serial_new]);
		
		$stmt = $conn->prepare("UPDATE items SET serial_number=:serial_number WHERE barcode=:barcode");
		$stmt->execute(['serial_number'=>$serial_new, 'barcode'=>$barcode]);
		
		$stmt3 = $conn->prepare("UPDATE support SET  approval=:approval  WHERE id=:id");
		$stmt3->execute(['id'=>$item, 'approval'=>3]);

		
		$pdo->close();
			$_SESSION['success'] = 'Recorded successfuly';
	}
	else{
		$_SESSION['error'] = 'Fill up  form first';
	}

	header('location: support_view.php');
	

?>