<?php include 'includes/session.php'; ?>
<?php
	$conn = $pdo->open();

	$slug = $_GET['product'];
    //$slug='dell-inspiron-15-7000-15-6';

	try{
		 		
	    $stmt = $conn->prepare("SELECT *, products.name AS prodname, category.name AS catname, products.id AS prodid FROM products LEFT JOIN category ON category.id=products.category_id WHERE slug = :slug");
	    $stmt->execute(['slug' => $slug]);
	    $product = $stmt->fetch();
		
	}
	catch(PDOException $e){
		echo "There is some problem in connection: " . $e->getMessage();
	}

	//page view
	$now = date('Y-m-d');
	if($product['date_view'] == $now){
		$stmt = $conn->prepare("UPDATE products SET counter=counter+1 WHERE id=:id");
		$stmt->execute(['id'=>$product['prodid']]);
	}
	else{
		$stmt = $conn->prepare("UPDATE products SET counter=1, date_view=:now WHERE id=:id");
		$stmt->execute(['id'=>$product['prodid'], 'now'=>$now]);
	}

?>

<?php include 'includes/header.php'; ?>
<body class=" skin-blue layout-top-nav">
  <script src="magnify_slider/jquery.exzoom.js"></script>
    <script src="magnify_slider/imagesloaded.pkgd.min.js"></script>
	
	
<script>
		var _gaq=[['_setAccount','UA-2508361-9'],['_trackPageview']];
		(function(d,t){var g=d.createElement(t),s=d.getElementsByTagName(t)[0];
		g.src=('https:'==location.protocol?'//ssl':'//www')+'.google-analytics.com/ga.js';
		s.parentNode.insertBefore(g,s)}(document,'script'));
	</script>
<script>
(function(d, s, id) {
	var js, fjs = d.getElementsByTagName(s)[0];
	if (d.getElementById(id)) return;
	js = d.createElement(s); js.id = id;
	js.src = 'https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.12';
	fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));
(function(d, s, id) {
	var js, fjs = d.getElementsByTagName(s)[0];
	if (d.getElementById(id)) return;
	js = d.createElement(s); js.id = id;
	js.src = 'https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.12';
	fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));

<div class="wrapper">
</script>
	<?php include 'includes/navbar.php'; ?>
	 
	  <div class="content-wrapper">
        <div class="container">
            <section class="content">
                <div class="row">
                   <div class="col-sm-9">
				   <div class="callout" id="callout" style="display:none">
	        			<button type="button" class="close"><span aria-hidden="true">&times;</span></button>
	        			<span class="message"></span>
	        		</div>
                    <div class="row">
                           <div class="col-sm-6" style="pading-right:60px; important">
						 
                            <div class="p-3 mb-2 bg-primary text-white" style="padding:1px 3px 4px 6px;">   <h4>Product Photos</h4></div>
                           
                              <br>
                                   <div style="float: right; width: 400; height: 300px; background: #EEE;"></div>
										<div class="easyzoom easyzoom--adjacent easyzoom--with-thumbnails">
											<a href="<?php echo 'images/'.$product['photo']; ?>" >
												<img src="<?php echo 'images/'.$product['photo']; ?>" alt="" width="400" height="300" />
											</a>
										</div>

										<ul class="thumbnails" style="overflow: hidden;margin: 1em 0;padding: 0;text-align: center;height:70px;">
				                             <li style="display: inline-block;width: 80px;margin: 0 5px;">
												<a href="<?php echo 'images/'.$product['photo']; ?>" data-standard="<?php echo 'images/'.$product['photo']; ?>">
													<img src="<?php echo 'images/'.$product['photo']; ?>" width="80" height="60"  alt="" />
												</a>
											</li>
											 <li style="display: inline-block;width: 80px;margin: 0 5px;">
												<a href="<?php echo 'images/'.$product['photo1']; ?>" data-standard="<?php echo 'images/'.$product['photo1']; ?>">
													<img src="<?php echo 'images/'.$product['photo1']; ?>" width="80" height="60"  alt="" />
												</a>
											</li>
											 <li style="display: inline-block;width: 80px;margin: 0 5px;">
												<a href="<?php echo 'images/'.$product['photo2']; ?>" data-standard="<?php echo 'images/'.$product['photo2']; ?>">
													<img src="<?php echo 'images/'.$product['photo2']; ?>" width="80" height="60"  alt="" />
												</a>
											</li>
											 <li style="display: inline-block;width: 80px;margin: 0 5px;">
												<a href="<?php echo 'images/'.$product['photo3']; ?>" data-standard="<?php echo 'images/'.$product['photo3']; ?>">
													<img src="<?php echo 'images/'.$product['photo3']; ?>" width="80" height="60"  alt="" />
												</a>
											</li>
										</ul>
                               
							 
                                <br><br> <br><br>
							<form class="form-inline" id="productForm">
                                <button type="submit" class="btn btn-primary btn-lg btn-flat"><i class="fa fa-shopping-cart"></i> Add to Cart</button>&nbsp;&nbsp;&nbsp;&nbsp;
                                <button type="submit" class="btn btn-primary btn-lg btn-flat" onclick="document.location='cart_view.php?paynow=paynow'"> Buy It Now </button>
                             </div>
                            <div class="col-sm-6">
                               <div class="p-3 mb-2 bg-primary text-white" style="padding:1px 3px 4px 6px;"> <h4>Product Specifications</h4></div>
                            
                             <br>
                                <h1 class="page-header"><?php echo $product['prodname']; ?></h1>
                               
                                    <div class="form-group">
                                        <div class="input-group col-sm-5">
                                            <span class="input-group-btn">
                                                <label>Quantity</label>
                                            </span>
                                            <span class="input-group-btn">
                                                <button type="button" id="minus" class="btn btn-default btn-flat btn-lg"><i class="fa fa-minus"></i></button>
                                            </span>
                                            <input type="text" name="quantity" id="quantity" class="form-control input-lg" value="1">
                                            <span class="input-group-btn">
                                                <button type="button" id="add" class="btn btn-default btn-flat btn-lg"><i class="fa fa-plus"></i>
                                                </button>
                                            </span>
                                            
                                            <input type="hidden" value="<?php echo $product['prodid']; ?>" name="id">
                                        </div>
                                        
                                    </div>
									
                                </form>
                                <h3><b>RWF <?php echo number_format($product['price'], 2); ?></b></h3>
                                <p><b>Category:</b> <a href="category.php?category=<?php echo $product['cat_slug']; ?>"><?php echo $product['catname']; ?></a></p>
                                <p><b>Description:</b></p>
                                <p><?php echo $product['description']; ?></p>
                            </div>
                        </div>
                         <br>
						  <h2>Popular products</h2>
					
		            <h1 class="page-header"></h1>
				   	<?php
		       			
		       			$conn = $pdo->open();
	                    $inc = 3;	
		       			try{
							$catid='1';
							$now = date('Y-m-d');
				
						    $stmt = $conn->prepare("SELECT * FROM products ORDER BY counter DESC LIMIT 6");
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
   	<?php $pdo->close(); ?>
  	<?php include 'includes/footer.php'; ?>
</div>


<?php include 'includes/scripts2.php'; ?>

<script type="text/javascript">



$(function(){
	$('#add').click(function(e){
		e.preventDefault();
		var quantity = $('#quantity').val();
		quantity++;
		$('#quantity').val(quantity);
	});
	$('#minus').click(function(e){
		e.preventDefault();
		var quantity = $('#quantity').val();
		if(quantity > 1){
			quantity--;
		}
		$('#quantity').val(quantity);
	});

});



</script>
<script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
	<script src="magnify/dist/easyzoom.js"></script>
	<script>
		// Instantiate EasyZoom instances
		var $easyzoom = $('.easyzoom').easyZoom();

		// Setup thumbnails example
		var api1 = $easyzoom.filter('.easyzoom--with-thumbnails').data('easyZoom');

		$('.thumbnails').on('click', 'a', function(e) {
			var $this = $(this);

			e.preventDefault();

			// Use EasyZoom's `swap` method
			api1.swap($this.data('standard'), $this.attr('href'));
		});

		// Setup toggles example
		var api2 = $easyzoom.filter('.easyzoom--with-toggle').data('easyZoom');

		$('.toggle').on('click', function() {
			var $this = $(this);

			if ($this.data("active") === true) {
				$this.text("Switch on").data("active", false);
				api2.teardown();
			} else {
				$this.text("Switch off").data("active", true);
				api2._init();
			}
		});
	</script>
</body>
</html>
