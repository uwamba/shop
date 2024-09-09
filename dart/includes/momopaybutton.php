<?php 
//get total amount of in cart
        $stmt = $conn->prepare("SELECT * FROM cart LEFT JOIN products on products.id=cart.product_id WHERE user_id=:user_id");
		$stmt->execute(['user_id'=>$user['id']]);

		$total = 0;
		foreach($stmt as $row){
			$subtotal = $row['price'] * $row['quantity'];
			$total += $subtotal;
		}

		$pdo->close();


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
       // unset($_SESSION['success']);
      }
    ?>
	

<div class="alert alert-warning" role="alert">Please Note That amount to be paid with momo pay must be >2000000 RWF! for amount above  2M call +250788308398</div>
<div class="register-box">
  	<div class="register-box-body">
    	<p class="login-box-msg">Enter your mobile money number here and click submit in form of 25078XXXXXXX </p>

    	<form action="momoapi.php" method="POST">
          <div class="form-group has-feedback">
            <input type="text" class="form-control" name="number" placeholder="25078XXXXXXX"  required>
		    <input type="hidden" value="<?php echo $total; ?>" name="amount">
            <span class="glyphicon glyphicon-phone-alt form-control-feedback"></span>
          </div>
          
          <hr>
      		<div class="row">
    			<div class="col-xs-4">
			
          			<button type="submit" class="btn btn-primary btn-block btn-flat" name="momo_pay"><i class="fa fa-pencil"></i> Submit</button>
        		</div>
      		</div>
    	</form>
      <br>
      <a href="index.php"><i class="fa fa-home"></i> Home</a>
  	</div>
	</div>