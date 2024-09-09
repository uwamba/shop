
<?php include 'includes/session.php'; ?>
<?php
  $where = '';
  if(isset($_GET['category'])){
    $catid = $_GET['category'];
    $where = 'WHERE category_id ='.$catid;
  }

?>
<?php include 'includes/header.php'; ?>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <?php include 'includes/navbar.php'; ?>
  <?php include 'includes/menubar.php'; ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Items List
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li>Products</li>
        <li class="active">Product List</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <?php
        if(isset($_SESSION['error'])){
          echo "
            <div class='alert alert-danger alert-dismissible'>
              <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
              <h4><i class='icon fa fa-warning'></i> Error!</h4>
              ".$_SESSION['error']."
            </div>
          ";
          unset($_SESSION['error']);
        }
        if(isset($_SESSION['success'])){
          echo "
            <div class='alert alert-success alert-dismissible'>
              <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
              <h4><i class='icon fa fa-check'></i> Success!</h4>
              ".$_SESSION['success']."
            </div>
          ";
          unset($_SESSION['success']);
        }
      ?>
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header with-border">
             
               
             
              <div class="pull-right">
    
                <form class="form-inline">
                  <div class="form-group">
                    <label>Category: </label>
                    <select class="form-control input-sm" id="select_category">
                      <option value="0">ALL</option>
                      <?php
                        $conn = $pdo->open();

                        $stmt = $conn->prepare("SELECT * FROM category");
                        $stmt->execute();

                        foreach($stmt as $crow){
                          $selected = ($crow['id'] == $catid) ? 'selected' : ''; 
                          echo "
                            <option value='".$crow['id']."' ".$selected.">".$crow['name']."</option>
                          ";
                        }

                        $pdo->close();
                      ?>
                    </select>
                  </div>
                </form>
              </div>
            </div>
            <div class="box-body">
                   	<?php
	 
	       			
	       			$conn = $pdo->open();

	       			$stmt = $conn->prepare("SELECT COUNT(*) AS numrows FROM items WHERE serial_number = :serial_number");
	       			$stmt->execute(['serial_number' => $_GET['serial_number']]);
	       			$row = $stmt->fetch();
	       			if($row['numrows'] < 1){
	       				echo '<h1 class="page-header">No results found for <i>'.$_GET['serial_number'].'</i></h1>';
	       			}
	       			else{
	       			    
	       			echo '<button class="btn btn-primary stretched-link">Results found for <i>'.$_GET['serial_number'].' </button>';
	       			
		       			try{
		       			 	$inc = 3;	
						    $stmt = $conn->prepare("SELECT * FROM items WHERE serial_number= :serial_number");
						    $stmt->execute(['serial_number' => $_GET['serial_number']]);
	                        $product = $stmt->fetch();
	                   
                            
                             
                            $stmt2 = $conn->prepare("SELECT * FROM delivery_note_items WHERE item_code= :item_id or item_code= :serial_number");
						    $stmt2->execute(['item_id' => $product['barcode'],'serial_number' => $_GET['serial_number']]);
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
            		        			    <td><?php echo $_GET['serial_number'] ?></td>
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
            </div>
          </div>
        </div>
      </div>
    </section>
     
  </div>
  	<?php include 'includes/footer.php'; ?>
    <?php include 'includes/products_modal.php'; ?>
   

</div>
<!-- ./wrapper -->

<?php include 'includes/scripts.php'; ?>
<script>
$(function(){
  $(document).on('click', '.edit', function(e){
    e.preventDefault();
    $('#transactions').modal('show');
    var id = $(this).data('id');
    getRow(id);
  });



  $(document).on('click', '.photo', function(e){
    e.preventDefault();
    var id = $(this).data('id');
    getRow(id);
  });

  $(document).on('click', '.desc', function(e){
    e.preventDefault();
    var id = $(this).data('id');
    getRow(id);
  });

  $('#select_category').change(function(){
    var val = $(this).val();
    if(val == 0){
      window.location = 'products.php';
    }
    else{
      window.location = 'products.php?category='+val;
    }
  });

  $('#addproduct').click(function(e){
    e.preventDefault();
    getCategory();
  });

  $("#addnew").on("hidden.bs.modal", function () {
      $('.append_items').remove();
  });

  $("#edit").on("hidden.bs.modal", function () {
      $('.append_items').remove();
  });

});

function getRow(id){
  $.ajax({
    type: 'POST',
    url: 'products_row.php',
    data: {id:id},
    dataType: 'json',
    success: function(response){
    
      $('.id').val(response.id);
        $('.id').val(response.id);
      //$('#edit_email').val(response.email);
      //$('#edit_password').val(response.password);
      $('#edit_serial_number').val(response.serial_number);
      $('#weight').val(response.weight);
   
     // getCategory();
     getProduct_name();
    }
  });
}
function getCategory(){
  $.ajax({
    type: 'POST',
    url: 'category_fetch.php',
    dataType: 'json',
    success:function(response){
      $('#category').append(response);
      $('#edit_category').append(response);
      
       $('.id').val(response.id);
      //$('#edit_email').val(response.email);
      //$('#edit_password').val(response.password);
      $('#edit_serial_number').val(response.serial_number);
       $('#weight').val(response.weight);
      
    }
  });
}

$(document).ready(function() {
$('.mdb-select').materialSelect();
});


 $(document).ready(function(){
            $('#category').change(function(){
                //Selected value
                var inputValue = $(this).val();

                //Ajax for calling php function
               $('#product_name').empty().append('<option selected="selected" value=""> --Select Name-- </option>');
                $.ajax({
                type: 'POST',
                url: 'product_name_fetch.php',
                data: jQuery.param({ cat_id: inputValue}) ,
                contentType: 'application/x-www-form-urlencoded; charset=UTF-8',
                dataType: 'json',
                success:function(response){
                  $('#product_name').append(response);
               
                }
              });
                
            });
        });
</script>
</body>
</html>




