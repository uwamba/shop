<?php
	include '../includes/conn.php';
	session_start();

	if(!isset($_SESSION['store']) || trim($_SESSION['store']) == ''){
		header('location: ../index.php');
		exit();
	}

	$conn = $pdo->open();

	$stmt = $conn->prepare("SELECT * FROM users WHERE id=:id");
	$stmt->execute(['id'=>$_SESSION['store']]);
	$admin = $stmt->fetch();

	$pdo->close();

?>