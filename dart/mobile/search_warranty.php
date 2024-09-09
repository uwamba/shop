<?php 
header('Access-Control-Allow-Origin: *');
header('Content-type:application/json;charset=utf-8');
include 'includes/session.php'; ?>
<?php
	$conn = $pdo->open();

   $id = $_POST['keyword'];

	try{
	    
	    	$stmt = $conn->prepare("SELECT COUNT(*) AS numrows FROM items WHERE serial_number = :serial_number or id=:id");
	       			$stmt->execute(['serial_number' => $_POST['keyword'],'id' => $_POST['keyword']]);
	       			$row = $stmt->fetch();
	       			if($row['numrows'] <1){
	       				 $return["message"] = "result not found ".$_POST['keyword']; 
	       				 $return["success"] = "false"; 
	       			}
	       			else{
	       			    $return["success"] = "true";  
	       		      $return["message"] = "the product found"; 
	       			
		       		
		       			 
						    $stmt = $conn->prepare("SELECT * FROM items WHERE serial_number= :serial_number");
						    $stmt->execute(['serial_number' => $_POST['keyword']]);
	                        $product = $stmt->fetch();
	                   
                            
                             
                            $stmt2 = $conn->prepare("SELECT * FROM delivery_note_items WHERE item_code= :item_id or item_code= :serial_number");
						    $stmt2->execute(['item_id' => $product['barcode'],'serial_number' => $_POST['keyword']]);
	                        $product2 = $stmt2->fetch();
	                        
	                        
	                        
	                         $purchase_date = $product2['date'];
                            
                            $now = date("Y-m-d");
                            
                            $ts1 = strtotime($purchase_date );
                            $ts2 = strtotime($now);
                            
                            $year1 = date('Y', $ts1);
                            $year2 = date('Y', $ts2);
                            
                            $month1 = date('m', $ts1);
                            $month2 = date('m', $ts2);
                            
                            $day1 = date('d', $ts1);
                            $day2 = date('d', $ts2);

            		        				
            		      
  
                            
                            $warrant_days= $product['warranty']*30;
                            
                            $diff = (($year2 - $year1) * 365) + (($month2 - $month1)*30)+($day2-$day1);
              
                             
	                        $status="";
	                        if($warrant_days<=$diff){
	                            $status="Expired";
	                            $return["status"] = "Expired"; 
	    
	                        }
	                        else{
	                          $return["status"] = "Active";   
	                        }
	                         $return["remaining_days"] = $warrant_days-$diff; 
            		        $return["warranty"] = $warrant_days;
            		        $return["start_date"] = $product2['date'];
            		        $return["item_id"] = $product['id']; 
                             
	       			}
	}
	catch(PDOException $e){
	     $return["error"] =  $e->getMessage();   
		
	}



  echo json_encode($return);

?>






