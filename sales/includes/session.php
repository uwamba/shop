<?php
	include '../includes/conn.php';
	session_start();

	if(!isset($_SESSION['sales']) || trim($_SESSION['sales']) == ''){
		header('location: ../index.php');
		exit();
	}

	$conn = $pdo->open();

	$stmt = $conn->prepare("SELECT * FROM users WHERE id=:id");
	$stmt->execute(['id'=>$_SESSION['sales']]);
	$admin = $stmt->fetch();

	$pdo->close();

?>