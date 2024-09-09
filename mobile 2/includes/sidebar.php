
<div >
      <div class="box box-solid" >
         <a href="warranty.php" class="btn btn-primary stretched-link" style="width:90%; margin-left:10px; margin-right:10px; margin-top:10px; margin-bottom:10px; border-style:solid;border-color:black;border-width:6px; ">WARRANTY LOOKUP</a>
	  	<div class="box-header with-border" style="width:100%; margin-left:0px; margin-right:0px;  " >
	   
	    <button type="button" class="btn btn-secondary btn-lg btn-block">Category</button>
	  	</div>
	  	
	  	<div class="box-body">
	  	  <ul class="list-group">
		   <?php
             
                $conn = $pdo->open();
                try{
                  $stmt = $conn->prepare("SELECT * FROM category");
                  $stmt->execute();
                  foreach($stmt as $row){
                   ?>
                   <a href="category.php?category=<?php echo $row['cat_slug']; ?>" class="list-group-item list-group-item-action active" style="background-color: #000; important"><?php echo $row['name']; ?></a>
				   <?php
                                    
                  }
                }
                catch(PDOException $e){
                  echo "There is some problem in connection: " . $e->getMessage();
                }

                $pdo->close();

              ?>
          </ul>
	  	</div>
	</div>

<!-- As a heading -->
	<div class="box box-solid">
	  	<div class="border-success card mb-3" style="padding:20px;display: flex;align-items: center">
  <img class="card-img-top" src="images/wholesale.png" alt="MTN MOMO PAY" width="100%" height="auto">
  
</div>
	</div>
	
	</div>

	<div class="box box-solid">
	  	<div class="box-header with-border">
	    	<h3 class="box-title"><b>Payment method</b></h3>
	  	</div>
	  	<div class="box-body">
	    	<img src="images/momo.png" alt="MTN MOMO PAY" width="100%" height="auto">
	  	</div>
	</div>
	
</div>
</div>
