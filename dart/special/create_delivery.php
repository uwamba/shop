
<?php 
include 'includes/session.php';
include('header.php');
include 'includes/header.php'; 

?>

<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <?php include 'includes/navbar.php'; ?>
  <?php include 'includes/menubar.php'; ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Create Delivery<br><br> 
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li>Products</li>
        <li class="active">Create Delivery</li>
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
         <div class="box-header with-border">
              <div class="pull-right">
                
              </div>
            </div>
        
      <div class="container content-invoice">
	<form action="delivery_add.php" id="invoice-form" method="post" class="order-form" role="form" novalidate=""> 
		<div class="load-animate animated fadeInUp">
		
			<input id="currency" type="hidden" value="RWF">
			<div class="row">
				<div class="col-xs-8 col-sm-5 col-md-5 col-lg-5">
				
					<div class="form-group">
						<input type="hidden" class="form-control" name="client" id="companyName" Value="<?php echo $_POST['name']; ?>" autocomplete="on" >
						<input type="hidden" class="form-control" name="id" id="id" Value="<?php echo $_POST['id']; ?>" autocomplete="on" >
						<input type="hidden" class="form-control" name="user_id" id="id" Value="<?php echo $_POST['user_id']; ?>" autocomplete="on" >
					</div>
				
				</div>      		
			
			</div>
			<div class="row">
				<div class="col-xs-10 col-sm-10 col-md-10 col-lg-10">
					<table class="table table-bordered table-hover" id="invoiceItem">	
						<tr>
							<th width="2%"><input id="checkAll" class="formcontrol" type="checkbox"></th>
							<th width="30%">Item Code</th>
							<th width="70%">Item Name</th>
						
						</tr>							
						<tr>
							<td><input class="itemRow" type="checkbox"></td>
							<td><input type="text" name="productCode[]" id="1" class="productCode form-control" value="" required></td>
							<td><input type="text" name="productName[]" id="product1" class="productName form-control" value="" required></td>
	
						</tr>
						
				
					</table>
				</div>
			</div>
			<div class="row">
				<div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">
					<button class="btn btn-danger delete" id="removeRows" type="button">- Delete</button>
					<button class="btn btn-success" id="addRows" type="button">+ Add More</button>
				</div>
			</div>
			<div class="row">	
				<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 pull-left">
					<h3>Notes: </h3>
					<div class="form-group">
						<textarea class="form-control txt" rows="5" name="notes" id="notes" placeholder="Your Notes" required></textarea>
					</div>
					<br>
					<div class="form-group">
						<input type="hidden" value="40" class="form-control" name="userId">
						<input data-loading-text="Saving Invoice..." type="submit" name="order_btn" value="Save Delivery Note" class="btn btn-success submit_btn invoice-save-btm">						
					</div>
					
				</div>
			
			</div>
			<div class="clearfix"></div>		      	
		</div>
	</form>			
</div>
</div>	
    </section>
     
  </div>
  	<?php include 'includes/footer.php'; ?>
    <?php include 'includes/category_modal.php'; ?>

</div>
<!-- ./wrapper -->
<!-- jQuery 3 -->

<!-- jQuery UI 1.11.4 -->
<!-- Bootstrap 3.3.7 -->
<script src="../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- Select2 -->
<script src="../bower_components/select2/dist/js/select2.full.min.js"></script>
<!-- Moment JS -->
<script src="../bower_components/moment/moment.js"></script>
<!-- DataTables -->
<script src="../bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="../bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<!-- ChartJS -->
<script src="../bower_components/chart.js/Chart.js"></script>
<!-- daterangepicker -->
<script src="../bower_components/moment/min/moment.min.js"></script>
<script src="../bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
<!-- datepicker -->
<script src="../bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<!-- bootstrap time picker -->
<script src="../plugins/timepicker/bootstrap-timepicker.min.js"></script>
<!-- Slimscroll -->
<script src="../bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="../bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="../dist/js/adminlte.min.js"></script>
<!-- CK Editor -->
<script src="../bower_components/ckeditor/ckeditor.js"></script>
<script type='text/javascript' >
$(function(){
	/** add active class and stay opened when selected */
	var url = window.location;
  
	// for sidebar menu entirely but not cover treeview
	$('ul.sidebar-menu a').filter(function() {
	    return this.href == url;
	}).parent().addClass('active');

	// for treeview
	$('ul.treeview-menu a').filter(function() {
	    return this.href == url;
	}).parentsUntil(".sidebar-menu > .treeview-menu").addClass('active');

});
</script>
<!-- Data Table Initialize -->
<script>

  $(function () {
    $('#example1').DataTable({
      responsive: true
    })
    $('#example2').DataTable({
      'paging'      : true,
      'lengthChange': false,
      'searching'   : false,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : false
    })
  })
</script>
<script>
  $(function(){
    //Initialize Select2 Elements
    $('.select2').select2()

    //CK Editor
    CKEDITOR.replace('editor1')
    CKEDITOR.replace('editor2')
  });
</script>

<script type='text/javascript' >
$('body').on('keypress', '.productCode', function(e) {
    if (e.keyCode == 13) {
        e.preventDefault()
        
        var id = $(this).attr('id');
        var searchKey =$("#"+id).val( );
        getItem(searchKey,id);
       
        
    }
});
$('bodyg').on('click', '.productCode', function() {

    $(this).autocomplete({
       source: function( request, response,response2 ) {
               
                $.ajax({
                    url: "fetchData.php",
                    type: 'post',
                    dataType: "json",
                    data: {
                        search: request.term
                    },
                    success: function( data ) {
                        response( data );
                    }
                });
            },
 
           select: function (event, ui) {
                 var id = $(this).attr('id');
                 
               $("#product"+id).val( ui.item.value );
                 $("#"+id).val( ui.item.label );
                
                return false;
            },
            focus: function(event, ui){
                 var id = $(this).attr('id');
                 $("#product"+id).val( ui.item.value );
                 $("#"+id).val( ui.item.label );
              
                return false;
            },
           
            
    });
    
    
});
function getItem(searchKey,id) {
    $.ajax({
        url: 'get_single_item.php',
        type: 'POST',
        dataType: 'json',
        data: {item: searchKey},
        
        success: function(data) {

            $("#product"+id).val(data.userdata);
            
        }
    });        
}

 

    </script>
    
   
</body>
</html>
