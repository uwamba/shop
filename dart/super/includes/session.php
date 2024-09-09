<?php
	include '../includes/conn.php';
	session_start();

	if(!isset($_SESSION['super']) || trim($_SESSION['super']) == ''){
		header('location: ../index.php');
		exit();
	}

	$conn = $pdo->open();

	$stmt = $conn->prepare("SELECT * FROM users WHERE id=:id");
	$stmt->execute(['id'=>$_SESSION['super']]);
	$admin = $stmt->fetch();

	$pdo->close();

?>