<?php
	include '../includes/conn.php';
	session_start();

	if(!isset($_SESSION['special']) || trim($_SESSION['special']) == ''){
		header('location: ../index.php');
		exit();
	}

	$conn = $pdo->open();
	$stmt = $conn->prepare("SELECT * FROM users WHERE id=:id");
	$stmt->execute(['id'=>$_SESSION['special']]);
	$admin = $stmt->fetch();

	$pdo->close();

?>