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
	        		<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
		                <ol class="carousel-indicators">
		                  <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
		                  <li data-target="#carousel-example-generic" data-slide-to="1" class=""></li>
		                  <li data-target="#carousel-example-generic" data-slide-to="2" class=""></li>
						  <li data-target="#carousel-example-generic" data-slide-to="2" class=""></li>
		                </ol>
		                <div class="carousel-inner" style="margin:0px ; padding-top:10px; important">
		                  <div class="item">
		                    <img src="images/slider2.jpg" alt="Second slide" >
		                  </div>
		                  <div class="item">
		                    <img src="images/slider3.jpg" alt="Third slide" >
		                  </div>
						  <div class="item active">
		                    <img src="images/slider1.jpg" alt="First slide" >
		                  </div>
						  <div class="item">
		                    <img src="images/slider4.jpg" alt="Forth slide" >
		                  </div>
						   <div class="item">
		                    <img src="images/slider5.jpg" alt="Forth slide" >
		                  </div>
		                </div>
		                <a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
		                  <span class="fa fa-angle-left"></span>
		                </a>
		                <a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
		                  <span class="fa fa-angle-right"></span>
		                </a>
		            </div>
		            
		            <h2>Today Deals</h2>
					
		            <h1 class="page-header"></h1>
		            <div>
		       		<?php
		       		

		       			
		       			$conn = $pdo->open();
	                    $inc = 3;	
		       			try{
							$catid='1';
							$now = date('Y-m-d');
		       			 
						    $stmt = $conn->prepare("SELECT * FROM products WHERE display=0 ORDER BY price ASC LIMIT 3");
						    $stmt->execute();
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
					<h2>New Products</h2>
					 <div>
		       		<?php
		       		

		       			
		       			$conn = $pdo->open();
	                    $inc = 3;	
		       			try{
							$catid='1';
							$now = date('Y-m-d');
		       			 
						    $stmt = $conn->prepare("SELECT * FROM products WHERE display=0 ORDER BY date DESC LIMIT 3");
						    $stmt->execute();
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
						<h2>Popular products</h2>
					 <div>
		       		<?php
		       		

		       			
		       			$conn = $pdo->open();
	                    $inc = 3;	
		       			try{
							$catid='1';
							$now = date('Y-m-d');
		       			 
						    $stmt = $conn->prepare("SELECT * FROM products WHERE display=0 ORDER BY counter DESC LIMIT 3");
						    $stmt->execute();
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