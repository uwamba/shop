<?php
	include 'includes/session.php';

	if(isset($_POST['edit'])){
		$id = $_POST['id'];
		$name = $_POST['name'];
        $price = $_POST['price'];
		try{
			$stmt = $conn->prepare("UPDATE district SET name=:name,  price=:price WHERE id=:id");
			$stmt->execute(['name'=>$name, 'price'=>$price, 'id'=>$id]);
			$_SESSION['success'] = 'Location updated successfully';
		}
		catch(PDOException $e){
			$_SESSION['error'] = $e->getMessage();
		}
		
		$pdo->close();
	}
	else{
		$_SESSION['error'] = 'Fill up edit Location form first';
	}

	header('location: location.php');

?>