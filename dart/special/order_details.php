<?php
	include 'includes/session.php';

	$id = $_POST['id'];

	$conn = $pdo->open();

	$output = array('list'=>'');

	$stmt = $conn->prepare("SELECT * FROM order_item WHERE order_id=:id");
	$stmt->execute(['id'=>$id]);

	$total = 0;
	foreach($stmt as $row){
		$output['transaction'] = $row['id'];
		$output['total'] = $row['total'];
		$price=$row['price'];
		$output['date'] = date('M d, Y', strtotime($row['date']));
		$subtotal = $row['price']*$row['quantity'];
		$total += $subtotal;
		$output['list'] .= "
			<tr class='prepend_items'>
				<td>".$row['item']."</td>
				<td>RWF; ".number_format($row['price'], 2)."</td>
				<td>".$row['quantity']."</td>
				<td>RWF; ".number_format($subtotal, 2)."</td>
			</tr>
		";
	}
	
	$output['total'] = '<b>RWF '.number_format($total+$shipping, 2).'<b>';
	$pdo->close();
	echo json_encode($output);

?>