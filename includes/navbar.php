<header class="main-header">
  <nav class="navbar navbar-static-top" style="background-color: #000; ">
    <div class="container" >
      <div class="navbar-header">
         <a href="./index.php" class="navbar-brand"><img  src="images/logo.jpeg"  width="90px"    height="35px" style=" border-radius: 5px; " /></a>
       
         
      </div>

      <!-- Collect the nav links, forms, and other content for toggling -->
       <form method="POST" class="navbar-form navbar-left" action="search.php" style="padding-top:7px;">
          <div class="input-group" id="searchform">
            <span  id="spanned" style="display: block;float: left;">
            
     
            <select   style="background-color: #FFF;height:34.8px; margin-top:-0.1px; important">
            <option value="">Products Category</option>
             <?php
             
                $conn = $pdo->open();
                try{
                  $stmt = $conn->prepare("SELECT * FROM category");
                  $stmt->execute();
                  foreach($stmt as $row){
                    echo "
                      <option value='category.php?category=".$row['cat_slug']."'>".$row['name']."</option>
                    ";                  
                  }
                }
                catch(PDOException $e){
                  echo "There is some problem in connection: " . $e->getMessage();
                }

                $pdo->close();

              ?>
           </select>
                 

            
            
            </span>
             <input type="text" class="form-control" id="navbar-search-input" name="keyword" placeholder="Search for Product" style="background-color: #FFF;height:34px; margin-top:0px; important" required>
              <span  id="spanned2" >
                  <button type="submit" class="btn btn-default btn-flat"><i class="fa fa-search" style="background-color: #FFF;height:18px; margin-top:0px; important"></i> </button>
              </span>
          </div>
        </form>
        
     
      
      <!-- /.navbar-collapse -->
      <!-- Navbar Right Menu -->
      
      <div class="navbar-custom-menu"> 
     
        <ul class="nav navbar-nav">
          
          <li class="dropdown messages-menu">
            <!-- Menu toggle button -->
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-shopping-cart"></i>
              <span class="label label-success cart_count"></span>
            </a>
            <ul class="dropdown-menu" style="width:auto; !important">
              <li class="header">You have <span class="cart_count"></span> item(s) in cart</li>
              <li>
                <ul class="menu" id="cart_menu">
                </ul>
              </li>
               <form method="POST"  action="cart_view.php" >
              <li class="footer" > <button type="submit"  class="btn btn-primary btn-lg" style="width:100%; !important">Go to Cart</button></li>
              </form>
            </ul>
          </li>
          <?php
            if(isset($_SESSION['user'])){
              $image = (!empty($user['photo'])) ? 'images/'.$user['photo'] : 'images/profile.jpg';
              echo '
                <li class="dropdown user user-menu">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <img src="'.$image.'" class="user-image" alt="User Image">
                    <span class="hidden-xs">'.$user['firstname'].' '.$user['lastname'].'</span>
                  </a>
                  <ul class="dropdown-menu" id="cart">
                    <!-- User image -->
                    <li class="user-header">
                      <img src="'.$image.'" class="img-circle" alt="User Image">

                      <p>
                        '.$user['firstname'].' '.$user['lastname'].'
                        <small>Member since '.date('M. Y', strtotime($user['created_on'])).'</small>
                      </p>
                    </li>
                    <li class="user-footer">
                      <div class="pull-left">
                        <a href="profile.php" class="btn btn-default btn-flat">Profile</a>
                      </div>
                      <div class="pull-right">
                        <a href="logout.php" class="btn btn-default btn-flat">Sign out</a>
                      </div>
                    </li>
                  </ul>
                </li>
              ';
            }
            else{
              echo "
                <li><a href='login.php'>LOGIN</a></li>
                <li><a href='signup.php'>SIGNUP</a></li>
              ";
            }
          ?>
          <li class="dropdown" >
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" >Support <span class="caret"></span></a>
            <ul class="dropdown-menu" role="menu" style="background-color:#000; important">
              <li><a href=""> Tel:+250736568184</a></li>
              <li><a href=""> Tel:+250785880128</a></li>
              <li><a href="">Sales@elmax.rw </a></li>
              <li><a href="">info@elmax.rw</a></li>
            </ul>
          </li>
        </ul>
         <ul class="nav navbar-nav">
         
         
        </ul>
      </div>
      
    </div>
  </nav>
</header>
<script>
    $(function(){
      // bind change event to select
      $('#dropdown').on('change', function () {
          var url = $(this).val(); // get selected value
          if (url) { // require a URL
              window.location = url; // redirect
          }
          return false;
      });
    });
</script>