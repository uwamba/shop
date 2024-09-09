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
        Orders History
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Sales</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header with-border">
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
              <div class="pull-right">
                <form method="POST" class="form-inline" action="sales_print.php">
                  <div class="input-group">
                    <div class="input-group-addon">
                      <i class="fa fa-calendar"></i>
                    </div>
                    <input type="text" class="form-control pull-right col-sm-8" id="reservation" name="date_range">
                  </div>
                  <button type="button" class="btn btn-success btn-sm btn-flat" name="print"></span> </button>
                </form>
              </div>
            </div>
            <div class="box-body">
              <table id="example1" class="table table-bordered">
                <thead>
                  <th class="hidden"></th>
                  <th>Date</th>
                  <th>Name</th>
                  <th>note</th> 
                  <th>Total</th>
                  <th>Status </th>
                  <th>View </th>
                  <th>Action </th>
                  
                </thead>
                <tbody>
                  <?php
                    $conn = $pdo->open();

                      

                    try{
                        
                        $stmt_user = $conn->prepare("SELECT * FROM users WHERE id=:id");
                    	$stmt_user->execute(['id'=>$_SESSION['store']]);
                    	$admin = $stmt_user->fetch();
                        $site=$admin['company'];
                       
                      $stmt = $conn->prepare("SELECT * FROM sales_order ORDER BY status ASC");
                      $stmt->execute();
                      foreach($stmt as $row){
                          
                         $stmt_user_item = $conn->prepare("SELECT * FROM users WHERE id=:id ");
                      	
                    	$stmt_user_item->execute(['id'=>$row['user_id']]);
                    	$user_id = $stmt_user_item->fetch();
                        $site_item=$user_id['company'];
                      
                        if( $site== $site_item){
                          
                         $status="";
                         if($row['status']==0){
                             echo "
                          <tr>
                            <td class='hidden'></td>
                            <td>".$row['date']."</td>
                           <td>".$row['name']."</td>
                            <td>".$row['note']."</td>
                            <td>".$row['total']."</td>
                            <td>New Order</td>
                            <td><button type='button' class='btn btn-info btn-sm btn-flat order' data-id='".$row['id']."'><i class='fa fa-search'></i> View</button></td>
                           
                            <td>
                            <form class='form-horizontal' method='POST' action='create_delivery.php'> 
                           <input type='hidden' value='".$row['id']."' name='id'>
                           <input type='hidden' value='".$row['name']."' name='name'>
                            <input type='hidden' value='".$row['user_id']."' name='user_id'>
                           <button type='submit' name='approve' class='btn btn-success btn-sm  btn-flat' data-id='".$row['id']."'><i class='fa fa-edit'></i> Create Delivery Note</button>
                           
                           </form>
                           </td>
                         </tr>
                        ";
                         }
                         else{
                            echo "
                          <tr>
                            <td class='hidden'></td>
                            <td>".$row['date']."</td>
                           <td>".$row['name']."</td>
                            <td>".$row['note']."</td>
                            <td>".$row['total']."</td>
                            <td>Closed</td>
                            <td><button type='button' class='btn btn-info btn-sm btn-flat order' data-id='".$row['id']."'><i class='fa fa-search'></i> View</button></td>
                           <td></td>
                            
                           
                           </form>
                           </td>
                         </tr>
                        ";
                         }
                       
                        
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
    <?php include 'includes/order_modal.php'; ?>

</div>
<!-- ./wrapper -->

<?php include 'includes/scripts.php'; ?>
<!-- Date Picker -->
<script>
$(function(){
  //Date picker
  $('#datepicker_add').datepicker({
    autoclose: true,
    format: 'yyyy-mm-dd'
  })
  $('#datepicker_edit').datepicker({
    autoclose: true,
    format: 'yyyy-mm-dd'
  })

  //Timepicker
  $('.timepicker').timepicker({
    showInputs: false
  })

  //Date range picker
  $('#reservation').daterangepicker()
  //Date range picker with time picker
  $('#reservationtime').daterangepicker({ timePicker: true, timePickerIncrement: 30, format: 'MM/DD/YYYY h:mm A' })
  //Date range as a button
  $('#daterange-btn').daterangepicker(
    {
      ranges   : {
        'Today'       : [moment(), moment()],
        'Yesterday'   : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
        'Last 7 Days' : [moment().subtract(6, 'days'), moment()],
        'Last 30 Days': [moment().subtract(29, 'days'), moment()],
        'This Month'  : [moment().startOf('month'), moment().endOf('month')],
        'Last Month'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
      },
      startDate: moment().subtract(29, 'days'),
      endDate  : moment()
    },
    function (start, end) {
      $('#daterange-btn span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'))
    }
  )
  
});
</script>
<script>
$(function(){
  $(document).on('click', '.order', function(e){
    e.preventDefault();
    $('#order_detail').modal('show');
    var id = $(this).data('id');
    $.ajax({
      type: 'POST',
      url: 'order_details.php',
      data: {id:id},
      dataType: 'json',
      success:function(response){
        $('#date').html(response.date);
        $('#transid').html(response.transaction);
        $('#detail').prepend(response.list);
        $('#total').html(response.total);
        $('#shipping').html(response.shipping_price);
      }
    });
  });

  $("#order_detail").on("hidden.bs.modal", function () {
      $('.prepend_items').remove();
  });
});
</script>
</body>
</html>
