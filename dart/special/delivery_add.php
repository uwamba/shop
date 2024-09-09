<?php
	include 'includes/session.php';

	if(isset($_POST['order_btn'])){
		$user = $_SESSION['store'];
			try{
				$stmt = $conn->prepare("INSERT INTO delivery_note (user, name,note,requester) VALUES (:user, :name,:note,:requester)");
				$stmt->execute(['user'=>$_SESSION['store'], 'name'=>$_POST['client'],'note'=>$_POST['notes'], 'requester'=>$_POST['user_id']]);
                
                $latest_id = $conn->lastInsertId();
                   
                 echo  $latest_id;
                    
                
                for ($i = 0; $i < count($_POST['productCode']); $i++) {
                    
                $stmt = $conn->prepare("INSERT INTO delivery_note_items (delivery_id, item_code,name) VALUES (:delivery_id, :item_code,:name)");
                $stmt->execute(['delivery_id'=>$latest_id,'item_code'=>$_POST['productCode'][$i],  'name'=>$_POST['productName'][$i]]);
                
                $stmt_orde = $conn->prepare("UPDATE items SET instore=:instore WHERE barcode=:barcode");

			   $stmt_orde->execute(['barcode'=>$_POST['productCode'][$i],'instore'=>'No']);
                }
                
            $stmt_orde = $conn->prepare("UPDATE sales_order SET status=:status, approver= :approver WHERE id=:id");

			$stmt_orde->execute(['id'=>$_POST['id'],'status'=>'1','approver'=>$user]);
			
		
                
		   $_SESSION['success'] = 'Order Created ';
				
			}
			catch(PDOException $e){
				$_SESSION['error'] = $e->getMessage();
			}
		

		$pdo->close();

	header('location: create_delivery.php');
	}

?>