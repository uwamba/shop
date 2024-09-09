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
	        			if(isset($_SESSION['error'])){
	        				echo "
	        					<div class='alert alert-danger'>
	        						".$_SESSION['error']."
	        					</div>
	        				";
	        				unset($_SESSION['error']);
	        			}
	        		?>
                  
                         <div  style="background-image: linear-gradient(180deg, gray, black); width:auto; height:auto; padding-left:50px; padding-right:50px; margin:1px; border-style: solid;
  border-color: white; border-radius: 15px;">
                         <br><br>
                          <h2 style="color: white;">WARRANTY LOOKUP</h2>
                          <br>
                           <form method="POST"  action="search_warranty.php">
                              <div class="input-group">
                                <input type="text" class="form-control" name="serial_number" placeholder="Search by entering serial number">
                                <div class="input-group-btn">
                                  <button class="btn btn-default" type="submit">
                                    <i class="glyphicon glyphicon-search"></i>
                                  </button>
                                </div>
                              </div>
                              <h6 style="color: white;">Please Enter your device Serial number Ex:PN00234YW </h6>
                            </form>   
                            <br><br> <br><br>               
                              </div>            
                  
                  
	        		
		            <h2></h2>
					
		            <h1 class="page-header"></h1>
		       		<?php
		       			
		       		
		       			$conn = $pdo->open();
	                    $inc = 3;	
		       			try{
							$catid='1';
							$now = date('Y-m-d');
		       			 
						    $stmt = $conn->prepare("");
						    $stmt->execute(['now'=>$now]);
						    $count=6;
						 foreach ($stmt as $row) {
						    	$image = (!empty($row['photo'])) ? 'images/'.'thump_'.$row['photo'] : 'images/noimage.jpg';
						    	$inc = ($inc == 3) ? 1 : $inc + 1;
	       						if($inc == 1) echo "<div class='row'>";
	       						echo "
	       							<div class='col-sm-4'>
	       								<div class='box box-solid'>
		       								<div class='box-body prod-body'>
		       									<a href='product.php?product=".$row['slug']."'>"."<img src='".$image."' width='100%' height='auto' class='thumbnail'></a>
		       									<h5 style='height:50px; overflow:hidden'><a href='product.php?product=".$row['slug']."'>".$row['name']."</a></h5>
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
<script>
$(function(){
  $(document).on('click', '.edit', function(e){
    e.preventDefault();
    $('#transactions').modal('show');
    var id = $(this).data('id');
    getRow(id);
  });

  $(document).on('click', '.delete', function(e){
    e.preventDefault();
    $('#delete').modal('show');
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

</script>
</body>
</html>