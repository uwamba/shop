<?php
	include 'includes/conn.php';
	session_start();

	if(isset($_SESSION['admin'])){
		header('location: admin/home.php');
	}
	if(isset($_SESSION['sales'])){
		header('location: sales/home.php');
	}
	if(isset($_SESSION['store'])){
		header('location: store/home.php');
	}
	if(isset($_SESSION['super'])){
		header('location: super/home.php');
	}
	if(isset($_SESSION['special'])){
		header('location: special/home.php');
	}
	if(isset($_SESSION['user'])){
		$conn = $pdo->open();

		try{
			$stmt = $conn->prepare("SELECT * FROM users WHERE id=:id");
			$stmt->execute(['id'=>$_SESSION['user']]);
			$user = $stmt->fetch();
			
		}
		catch(PDOException $e){
			echo "There is some problem in connection: " . $e->getMessage();
		}

		$pdo->close();

	}
?>