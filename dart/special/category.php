<?php include 'includes/session.php'; ?>
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
         Item issuing Approved
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li>Products</li>
        <li class="active">Category</li>
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
             
            </div>
            <div class="box-body">
              <table id="example1" class="table table-bordered">
                <thead>
                  <th>Items Name</th>
                  <th>Serial number</th>
                  <th>Brand</th>
                  <th>Date</th>
                  
                </thead>
                <tbody>
                  
                  <?php
                    $conn = $pdo->open();

                    try{
                         	$stmt_user = $conn->prepare("SELECT * FROM users WHERE id=:id");
                    	$stmt_user->execute(['id'=>$_SESSION['store']]);
                    	$admin = $stmt_user->fetch();
                        $site=$admin['company']; 
                      $stmt = $conn->prepare("SELECT *, products.name as name FROM items JOIN products on items.name=products.id WHERE instore='No' ");
                      $stmt->execute();
                      foreach($stmt as $row){
                          
                         $stmt_user_item = $conn->prepare("SELECT * FROM users WHERE id=:id ");
                    	$stmt_user_item->execute(['id'=>$row['user_id']]);
                    	$user_id = $stmt_user_item->fetch();
                        $site_item=$user_id['company'];
                        
                        if( $site== $site_item){     
                        echo "
                       
                          <tr>
                             <td>".$row['name']."</td>
                            <td>".$row['serial_number']."</td>
                            <td>".$row['brand']."</td>
                            <td>".$row['purchase_date']."</td>
                           
                        
                          </tr>
                         
                        ";
                        }
                        
                      }
                    }
                    catch(PDOException $e){
                      echo $e->getMessage();
                    }

                    $pdo->close();
                  ?>
                
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </section>
     
  </div>
  	<?php include 'includes/footer.php'; ?>
    <?php include 'includes/category_modal.php'; ?>

</div>
<!-- ./wrapper -->

<?php include 'includes/scripts.php'; ?>
<script>
$(function(){
  $(document).on('click', '.edit', function(e){
    e.preventDefault();
    $('#edit').modal('show');
    var id = $(this).data('id');
    getRow(id);
  });

  $(document).on('click', '.delete', function(e){
    e.preventDefault();
    $('#delete').modal('show');
    var id = $(this).data('id');
    getRow(id);
  });

});

function getRow(id){
  $.ajax({
    type: 'POST',
    url: 'category_row.php',
    data: {id:id},
    dataType: 'json',
    success: function(response){
      $('.catid').val(response.id);
      $('#edit_name').val(response.name);
      $('.catname').html(response.name);
    }
  });
}
</script>
</body>
</html>
