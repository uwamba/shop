<?php
	include 'includes/session.php';

	if(isset($_POST['order_btn'])){
	
			try{
				$stmt = $conn->prepare("INSERT INTO sales_order (user_id, name, status, note, total) VALUES (:user_id, :name, :status, :note, :total)");
				$stmt->execute(['user_id'=>$_SESSION['sales'], 'name'=>$_POST['client'], 'status'=>'0','note'=>$_POST['notes'],'total'=>$_POST['subTotal']]);
                
                $latest_id = $conn->lastInsertId();
                   
                 echo  $latest_id;
                    
                
                for ($i = 0; $i < count($_POST['productName']); $i++) {
                    
                $stmt = $conn->prepare("INSERT INTO order_item (order_id, item, price, quantity, total) VALUES (:order_id, :item, :price, :quantity, :total)");
                $stmt->execute(['order_id'=>$latest_id,  'item'=>$_POST['productName'][$i],'price'=>$_POST['price'][$i], 'quantity'=>$_POST['quantity'][$i],'total'=>$_POST['total'][$i]]);
                }
                
				$_SESSION['success'] = 'Order Created ';
				
			}
			catch(PDOException $e){
				$_SESSION['error'] = $e->getMessage();
			}
		

		$pdo->close();

	header('location: create_order.php');
	}

?>