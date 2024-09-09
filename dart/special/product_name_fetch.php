<?php
	include 'includes/session.php';
    $cat_id=$_POST['cat_id'];
	$output = '';

	$conn = $pdo->open();

	$stmt = $conn->prepare("SELECT * FROM products WHERE category_id=$cat_id");
	$stmt->execute();

	foreach($stmt as $row){
		$output .= "
			<option value='".$row['id']."' class='append_items'>".$row['name']."</option>
		";
	}

	$pdo->close();
	echo json_encode($output);

?>