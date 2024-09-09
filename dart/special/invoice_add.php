<?php
	include 'includes/session.php';

	if(isset($_POST['invoice_btn'])){
	
			try{
				$stmt = $conn->prepare("INSERT INTO invoice_order (user_id, order_receiver_name, order_receiver_address, order_total_before_tax, order_total_tax, order_tax_per, order_total_after_tax, order_amount_paid, order_total_amount_due, note) VALUES (:user_id, :order_receiver_name, :order_receiver_address, :order_total_before_tax, :order_total_tax, :order_tax_per, :order_total_after_tax, :order_amount_paid, :order_total_amount_due, :note)");
				$stmt->execute(['user_id'=>$_SESSION['sales'], 'order_receiver_name'=>$_POST['companyName'], 'order_receiver_address'=>$_POST['address'],'order_total_before_tax'=>$_POST['subTotal'],'order_total_tax'=>$_POST['taxAmount'],'order_tax_per'=>$_POST['taxRate'],'order_total_after_tax'=>$_POST['totalAftertax'],'order_amount_paid'=>$_POST['amountPaid'],'order_total_amount_due'=>$_POST['amountDue'],'note'=>$_POST['notes']]);
                
                $latest_id = $conn->lastInsertId();
                   
                 echo  $latest_id;
                    
                
                for ($i = 0; $i < count($_POST['productCode']); $i++) {
                    
                $stmt = $conn->prepare("INSERT INTO invoice_order_item (order_id, item_code, item_name, order_item_quantity, order_item_price, order_item_final_amount ) VALUES (:order_id, :item_code, :item_name, :order_item_quantity, :order_item_price, :order_item_final_amount)");
                $stmt->execute(['order_id'=>$latest_id, 'item_code'=>$_POST['productCode'][$i], 'item_name'=>$_POST['productName'][$i],'order_item_quantity'=>$_POST['quantity'][$i],'order_item_price'=>$_POST['price'][$i],'order_item_final_amount'=>$_POST['total'][$i]]);
                }
                
				$_SESSION['success'] = 'Invoice added ';
				
			}
			catch(PDOException $e){
				$_SESSION['error'] = $e->getMessage();
			}
		

		$pdo->close();

	header('location: invoice_list.php');
	}

?>