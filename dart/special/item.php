<?php
	include 'includes/session.php';

	$id = $_POST['id'];

	$conn = $pdo->open();

	$output = array('list'=>'');

	$stmt = $conn->prepare("SELECT * FROM items  WHERE id=:id");
	$stmt->execute(['id'=>$id]);

	$total = 0;
	foreach($stmt as $row){
	    
	  $stmt2 = $conn->prepare("SELECT * FROM products  WHERE id=:id");
	  $stmt2->execute(['id'=>$row['name']]);
	  $item_row = $stmt2->fetch();
	  
	 
	 
		$output['list'] .= "
			<tr class='prepend_items'>
				<td>".$row['serial_number']."</td>
				<td>".$item_row['name']."</td>
				<td>".$row['description']."</td>
				<td>".$row['price']."</td>
				<td>".$row['purchase_date']."</td>
			
			</tr>
		";
	}
	
	$output['total'] = '<b>RWF '.number_format($total+$shipping, 2).'<b>';
	$pdo->close();
	echo json_encode($output);

?>