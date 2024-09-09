
<?php include 'includes/session.php'; ?>

<?php include 'includes/header.php'; ?>
<body class="hold-transition skin-blue layout-top-nav">
<div class="wrapper">

	<?php include 'includes/navbar.php'; ?>
	 
	  <div class="content-wrapper">
	    <div class="container">

	      <!-- Main content -->
	      <section class="content">
	        <div class="row">
	        	<div class="col-sm-9">
	        	<?php
	 
	       			
	       			$conn = $pdo->open();

	       			$stmt = $conn->prepare("SELECT COUNT(*) AS numrows FROM items WHERE serial_number = :serial_number");
	       			$stmt->execute(['serial_number' => $_POST['serial_number']]);
	       			$row = $stmt->fetch();
	       			if($row['numrows'] <1){
	       				echo '<h1 class="page-header">No results found for <i>'.$_POST['serial_number'].'</i></h1>';
	       			}
	       			else{
	       			    
	       			echo '<button class="btn btn-primary stretched-link">Results found for <i>'.$_POST['serial_number'].' </button>';
	       			
		       			try{
		       			 	$inc = 3;	
						    $stmt = $conn->prepare("SELECT * FROM items WHERE serial_number= :serial_number");
						    $stmt->execute(['serial_number' => $_POST['serial_number']]);
	                        $product = $stmt->fetch();
	                   
                            
                             
                            $stmt2 = $conn->prepare("SELECT * FROM delivery_note_items WHERE item_code= :item_id or item_code= :serial_number");
						    $stmt2->execute(['item_id' => $product['barcode'],'serial_number' => $_POST['serial_number']]);
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
	                        }
	                        else{
	                           $status="Active";  
	                        }
                             
                            
						    ?>
					
            	        		 <div class="box box-solid">
            	        			<div class="box-body">
            	        			 <div class="table-responsive">
            		        		<table class="table table-bordered">
            		        		    <thead>
            		        				
            		        				<th colspan="5"><?php echo $product2['name']; ?></th>
            		        			
            		        				
            		        			</thead>
            		        			<thead>
            		        				
            		        				<th>Serial Number</th>
            		        				<th>Warranty Status</th>
            		        				<th>Purchassed Date</th>
            		        				<th >Warranty Days</th>
            		        				<th>Remaining Days</th>
            		        				
            		        			</thead>
            		        		
            		        			<tbody id="tbody">
            		        			    <td><?php echo $_POST['serial_number'] ?></td>
            		        			    <td><?php echo $status; ?></td>
            		        			    <td><?php echo $product2['date']; ?></td>
            		        			    <td><?php echo $warrant_days; ?></td>
            		        			    <td><?php echo $warrant_days-$diff; ?></td>
            		        			</tbody>
            		        			
            		        		</table>
            	        			</div>
            	        			</div>
            	        		</div>
            	        		<br/>
            	        		<br/>
            	        	   <button class="btn btn-primary stretched-link">Support History </button>
            	        		<div class="box box-solid">
            	        			<div class="box-body">
            	        			 <div class="table-responsive">
            		        		<table class="table table-bordered">
            		        		    <thead>
            		        				
            		        				<th colspan="4"><?php echo $product2['name']; ?></th>
            		        				<th ><a href="support.php?item_id=<?php echo $product['id']; ?>" class="btn btn-primary stretched-link">Request support </a></th>
            		        				
            		        			</thead>
            		        			<thead>
            		        				
            		        				<th>Reported Date</th>
            		        				<th>Type</th>
            		        				<th>Issue</th>
            		        				<th >Description</th>
            		        				<th>Resolution</th>
            		        				
            		        			</thead>
            	        		<?php
            	        		
            	        			$stmt = $conn->prepare("SELECT * FROM support  WHERE item_id=:id");
                                	$stmt->execute(['id'=>$product['id']]);
                                
                                	$total = 0;
                                	foreach($stmt as $row){
                                	    
                                	 ?>
                                	 <tbody id="tbody">
            		        			    <td><?php echo $row['reported_date'] ?></td>
            		        			      <td><?php echo $row['type'] ?></td>
            		        			     <td><?php echo $row['issue'] ?></td>
            		        			      <td><?php echo $row['description'] ?></td>
            		        			      <td><?php echo $row['action'] ?></td>
            		        		</tbody>
                                	 
                                	<?php 	
                                	}
                                	
            	        		
            	        		?>
            	        		
            		        		
            		        			
            		        			
            		        		</table>
            	        			</div>
            	        			</div>
            	        		</div>
                           
						
						    <?php
						   
							
						}
						catch(PDOException $e){
							echo "There is some problem in connection: " . $e->getMessage();
						}
					}
	        

					$pdo->close();
                
	       		?> 
	       		 	<br/>
            	  <br/>
	 <h2>Recommanded for you </h2>
					
		            <h1 class="page-header"></h1>
		       		<?php
		       			
		       			$conn = $pdo->open();
	                    $inc = 3;	
		       			try{
							$catid='1';
							$now = date('Y-m-d');
		       			 
						    $stmt = $conn->prepare("SELECT * FROM products ORDER BY counter DESC LIMIT 6");
						    $stmt->execute(['now'=>$now]);
						    $count=6;
							foreach ($stmt as $row) {
						    	$image = (!empty($row['photo'])) ? 'images/'.$row['photo'] : 'images/noimage.jpg';
						    	$inc = ($inc == 3) ? 1 : $inc + 1;
								$count=$count+1;
	       						if($inc == 1) echo "<div class='row'>";
	       						echo "
	       							<div class='col col-md-4' id='product-photo'>
	       								<div class='box box-solid' id='product-photo-content'>
		       								<div class='box-body prod-body' id='photo-content'>
											<a href='product.php?product=".$row['slug']."'>"."<img src='".$image."' width='100%' height='auto' class='thumbnail'></a>
		       									
		       									<h5><a href='product.php?product=".$row['slug']."'>".$row['name']."</a></h5>
		       								</div>
		       								<div class='box-footer'>
		       									<b>RWF ".number_format($row['price'], 2)."</b>
		       								</div>
	       								</div>
	       							</div>
	       						";
	       						if($inc == 3) echo "</div>";
						    }
						    if($inc == 1) echo "<div class='col col-md-4'></div><div class='col-sm-4'></div></div>"; 
							if($inc == 2) echo "<div class='col col-md-4'></div></div>";
							
						}
						catch(PDOException $e){
							echo "There is some problem in connection: " . $e->getMessage();
						}

						$pdo->close();

		       		?> 
					
				
	        	
	             </div>
	        	<div class="col-sm-3">
	        		<?php include 'includes/sidebar.php'; ?>
	        	</div>
	        </div>
	      </section>
	     
	    </div>
	  </div>
  
  	<?php include 'includes/footer.php'; ?>
</div>

<?php include 'includes/scripts.php'; ?>
</body>
</html>




