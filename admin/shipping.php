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
        Locations
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li>Shipping</li>
        <li class="active">Shipping</li>
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
                  <th>Fname</th>
                   <th>LName</th>
                    <th>Email</th>
                     <th>phone</th>
                      <th>street</th>
                       <th>date</th>
                       <th>Address</th>
                  <th>Price</th>
                </thead>
                <tbody>
                  <?php
                    $conn = $pdo->open();
                    try{
                        
                         $stmt_user = $conn->prepare("SELECT * FROM users WHERE id=:id");
                    	$stmt_user->execute(['id'=>$_SESSION[admin]]);
                    	$admin = $stmt_user->fetch();
                        $site=$admin['company'];
                        
                        $stmt = $conn->prepare("SELECT *, shipping.id AS shipping_id, shipping.status AS shipping_status FROM shipping LEFT JOIN users ON shipping.user_id=users.id WHERE users.company= :company ORDER BY date DESC");
                      $stmt->execute(['company'=>$site]);
                      foreach($stmt as $row){
                           $stmt2 = $conn->prepare("SELECT * FROM district WHERE id=:id");
                           $stmt2->execute(['id'=>$row['location']]);
                            $row2 = $stmt2->fetch();
                        echo "
                          <tr>
                            <td>".$row['firstname']."</td>
                             <td>".$row['lastname']."</td>
                              <td>".$row['email']."</td>
                               <td>".$row['phone']."</td>
                               <td>".$row['street']."</td>
                               <td>".$row['date']."</td>
                               <td>".$row2['name']."</td>
                                <td>".$row2['price']."</td>
                                 <td>".$row['shipping_status']."</td>
                            <td>
                              <button class='btn btn-success btn-sm edit btn-flat' data-id='".$row['shipping_id']."'><i class='fa fa-edit'></i> Change Status</button>
                              <button class='btn btn-danger btn-sm delete btn-flat' data-id='".$row['shipping_id']."'><i class='fa fa-trash'></i> Delete</button>
                            </td>
                          </tr>
                        ";
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
    <?php include 'includes/shipping_modal.php'; ?>

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
    url: 'shipping_row.php',
    data: {id:id},
    dataType: 'json',
    success: function(response){
      $('.ship_id').val(response.id);
      $('.email').val(response.email);
       $('.status').val(response.status);
     
    }
  });
}
</script>
</body>
</html>
