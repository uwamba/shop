<?php
	include 'includes/session.php';

	$output = '';

	$conn = $pdo->open();

	$stmt = $conn->prepare("SELECT * FROM district");
	$stmt->execute();

	foreach($stmt as $row){
		$output .= "
			<option value='".$row['id']."' class='append_items'>".$row['name']."</option>
			<option value='".$row['price']."' class='append_items'>".$row['price']."</option>
		";
	}

	$pdo->close();
	echo json_encode($output);

?>