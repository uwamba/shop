<aside class="main-sidebar">
  <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar">
    <!-- Sidebar user panel -->
    <div class="user-panel">
      <div class="pull-left image">
        <img src="<?php echo (!empty($admin['photo'])) ? '../images/'.$admin['photo'] : '../images/profile.jpg'; ?>" class="img-circle" alt="User Image">
      </div>
      <div class="pull-left info">
        <p><?php echo $admin['firstname'].' '.$admin['lastname']; ?></p>
        <a><i class="fa fa-circle text-success"></i> Online</a>
      </div>
    </div>
    <!-- sidebar menu: : style can be found in sidebar.less -->
    <ul class="sidebar-menu" data-widget="tree">
      <li class="header">REPORTS</li>
      <li><a href="home.php"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li>
      
      <li class="header">MANAGE</li>
      
       <li><a href="users.php"><i class="fa fa-users"></i> <span>Users</span></a></li>
      <li class="treeview">
        <a href="#">
          <i class="fa fa-barcode"></i>
          <span>Options</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
            <li><a href="create_invoices.php"><i class="glyphicon glyphicon-plus"></i>Create Invoice</a></li>
            <li><a href="invoice_list2.php"><i class="glyphicon glyphicon-th-list"></i>Invoice List</a></li>
           	<li><a href="create_invoice.php"><i class="glyphicon glyphicon-plus"></i>Create Proforma Invoice</a></li>
           	<li><a href="invoice_list.php"><i class="glyphicon glyphicon-th-list"></i>Proforma invoice</a></li>
            <li><a href="expense.php"><i class="glyphicon glyphicon-th-list"></i>General Expenses</a></li>
            <li><a href="order_list2.php"><i class="glyphicon glyphicon-plus"></i>Create Delivery note</a></li>
            <li><a href="delivery_list.php"><i class="glyphicon glyphicon-th-list"></i>Delivery note</a></li>
            
		 
        </ul>
      </li>
      <li class="treeview">
        <a href="#">
          <i class="fa fa-barcode"></i>
          <span>Credits</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
             <li><a href="new_credit.php"><i class="glyphicon glyphicon-th-list"></i>New Credit</a></li>
          
          <li><a href="credit_list.php"><i class="glyphicon glyphicon-th-list"></i>All Credits</a></li>
           <?php
             
                $conn = $pdo->open();
                try{
                  $stmt = $conn->prepare("SELECT * FROM site");
                  $stmt->execute();
                  foreach($stmt as $row){
                   ?>
                    <li><a href="credit_list2.php?shop=<?php echo $row['name']; ?>"><i class="glyphicon glyphicon-th-list"></i><?php echo $row['name']; ?></a></li>
            
				   <?php
                                    
                  }
                }
                catch(PDOException $e){
                  echo "There is some problem in connection: " . $e->getMessage();
                }

                $pdo->close();

              ?>
        </ul>
      </li>
            <li class="treeview">
        <a href="#">
          <i class="fa fa-barcode"></i>
          <span>Sim Managements</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
             <li><a href="new_sim.php"><i class="glyphicon glyphicon-th-list"></i>Sim Registation</a></li>
          
          <li><a href="simcard_list.php"><i class="glyphicon glyphicon-th-list"></i>All Sim Registered</a></li>

        </ul>
      </li>
    </ul>
  </section>
  <!-- /.sidebar -->
</aside>