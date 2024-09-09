<?php
	include 'includes/session.php';

	if(isset($_POST['send'])){
		$id = $_POST['id'];
		$warranty = $_POST['warranty'];
        $purpose = $_POST['purpose'];
		try{
			$stmt = $conn->prepare("UPDATE issuing SET warranty=:warranty,  purpose=:purpose WHERE id=:id");
			$stmt->execute(['warranty'=>$warranty, 'purpose'=>$purpose, 'id'=>$id]);
			$_SESSION['success'] = 'Item  updated successfully';
		}
		catch(PDOException $e){
			$_SESSION['error'] = $e->getMessage();
		}
		
		$pdo->close();
	}
	else{
		$_SESSION['error'] = 'Fill up edit Location form first';
	}

	header('location: products.php');

?>