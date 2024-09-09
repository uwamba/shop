<?php 
if(isset($_SESSION['location'])){
    $id_location=$_SESSION['location'];
$conn = $pdo->open();
		$stmt = $conn->prepare("SELECT * FROM district WHERE id=:id");
		$stmt->execute(['id'=>$id_location]);
		$row = $stmt->fetch();
		
		$name = $row['name'];
		$price= $row['price'];
	
        


?>
<tr>
          <td colspan='4' align='right'><b>Shipping Price</b></td>
          <td><b> <?php echo $price; ?></b></td>
<tr>

<?php

		$stmt = $conn->prepare("SELECT * FROM cart LEFT JOIN products on products.id=cart.product_id WHERE user_id=:user_id");
		$stmt->execute(['user_id'=>$user['id']]);

		$total = 0;
		foreach($stmt as $row){
			$subtotal = $row['price'] * $row['quantity'];
			$total += $subtotal;
		}

		$pdo->close();

	
?>


<tr>
          <td colspan='4' align='right'><b>Total Amount to be Paid</b></td>
          <td><b> <?php echo $price+$total; ?></b></td>
<tr>
<tr>
          <td colspan='4' align='right'><b>Payment Method</b></td>
          <td> <a href="#momopay" data-toggle="modal" ><button type="submit" class="btn btn-primary btn-lg" style="background-color: #FFC300;" ><i class="glyphicon glyphicon-phone"></i>Pay With MOMOPAY</button></a></td>
<tr>

<?php 

}

?>
