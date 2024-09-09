
<?php include 'includes/session.php'; ?>
<?php include 'includes/header2.php'; ?>
<body class="hold-transition skin-blue layout-top-nav">
<div class="wrapper">

	<?php include 'includes/navbar.php'; ?>
	 
	  <div class="content-wrapper">
	    <div class="container">

	      <!-- Main content -->
	      <section class="content">
	        <div class="row">
	        	<div class="col-sm-9">
	        		<h1 class="page-header">Payment Confirmation</h1>
	        		<div class="box box-solid">
	        			<div class="box-body">
		        		<div class="card">
						  
						  <div class="card-body">
							<?php
							  if(isset($_SESSION['error'])){
								echo "
								  <div class='callout callout-danger text-center'>
									<p>".$_SESSION['error']."</p> 
								  </div>
								";
								unset($_SESSION['error']);
							  }

							  if(isset($_SESSION['success'])){
								echo "
								  <div class='callout callout-success text-center'>
									<p>".$_SESSION['success']."</p> 
								  </div>
								";
								unset($_SESSION['success']);
							  }
							?>
							
						  </div>
						</div>
						


	        			</div>
	        		</div>
					
					<a href="momo_reference.php" class="btn btn-primary">Click Here To continue</a>
	        	</div>
	        	<div class="col-sm-3">
	        		<?php include 'includes/sidebar.php'; ?>
	        	</div>
				
	        </div>
		           
	      </section>
	     
	    </div>
	  </div>
  	<?php $pdo->close(); ?>
  	<?php include 'includes/footer.php'; ?>
</div>
