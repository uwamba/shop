<?php
	include 'includes/session.php';

	$id = $_POST['id'];

	$conn = $pdo->open();

	$output = array('list'=>'');

	$stmt = $conn->prepare("SELECT * FROM support  WHERE item_id=:item_id");
	$stmt->execute(['item_id'=>$id]);

	$total = 0;
	foreach($stmt as $row){
	    
	 
	 
		$output['list'] .= "
			<tr class='prepend_items'>
				<td>".$row['reported_date']."</td>
				<td>".$row['type']."</td>
				<td>".$row['solution']."</td>
			
			
			</tr>
		";
	}
	

	$pdo->close();
	echo json_encode($output);

?>