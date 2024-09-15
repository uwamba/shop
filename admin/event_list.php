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
                    Category
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
                if (isset($_SESSION['error'])) {
                    echo "
            <div class='alert alert-danger alert-dismissible'>
              <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
              <h4><i class='icon fa fa-warning'></i> Error!</h4>
              " . $_SESSION['error'] . "
            </div>
          ";
                    unset($_SESSION['error']);
                }
                if (isset($_SESSION['success'])) {
                    echo "
            <div class='alert alert-success alert-dismissible'>
              <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
              <h4><i class='icon fa fa-check'></i> Success!</h4>
              " . $_SESSION['success'] . "
            </div>
          ";
                    unset($_SESSION['success']);
                }
                ?>
                <div class="row">
                    <div class="col-xs-12">
                        <div class="box">
                            <div class="box-header with-border">
                                <a href="#addnew" data-toggle="modal" class="btn btn-primary btn-sm btn-flat"><i
                                        class="fa fa-plus"></i> New</a>
                            </div>
                            <div class="box-body">
                                <table class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Event ID</th>
                                            <th>Event Name</th>
                                            <th>Start Date</th>
                                            <th>End Date</th>
                                            <th>Description</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $conn = $pdo->open();
                                        $sql = "SELECT * FROM events";
                                        $result = $conn->query($sql);

                                        $stmt = $conn->prepare("SELECT * FROM events order by created_at DESC");
                                        $stmt->execute();
                                        foreach ($stmt as $row) {
                                            if($row['status']=='confirmed' or $row['status']=='cancelled'){
                                                echo "<tr>
                                                <td>" . $row['id'] . "</td>
                                                <td>" . $row['event_name'] . "</td>
                                                <td>" . $row['start_datetime'] . "</td>
                                                <td>" . $row['end_datetime'] . "</td>
                                                <td>" . $row['description'] . "</td>
                                                <td>" . $row['status'] . "</td>
                                                
                                                <td>
                                                   
                                                    <button class='btn btn-danger btn-sm delete btn-flat' data-id='" . $row['id'] . "'><i class='fa fa-trash'></i> Delete</button>
                                                </td>
                                            </tr>";
                                            }else{
                                                echo "<tr>
                                                <td>" . $row['id'] . "</td>
                                                <td>" . $row['event_name'] . "</td>
                                                <td>" . $row['start_datetime'] . "</td>
                                                <td>" . $row['end_datetime'] . "</td>
                                                <td>" . $row['description'] . "</td>
                                                <td>" . $row['status'] . "</td>
                                                
                                                <td>
                                                    <button class='btn btn-success btn-sm approve btn-flat' data-id='" . $row['id'] . "'><i class='fa fa-edit'></i> Approve</button>
                                                    <button class='btn btn-success btn-sm reject btn-flat' data-id='" . $row['id'] . "'><i class='fa fa-edit'></i> Reject</button>
                                                    <button class='btn btn-danger btn-sm delete btn-flat' data-id='" . $row['id'] . "'><i class='fa fa-trash'></i> Delete</button>
                                                </td>
                                            </tr>";
                                            }

                                            
                                        }
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
        <?php include 'includes/event_approve_modal.php'; ?>
        <?php include 'includes/event_reject.php'; ?>

    </div>
    <!-- ./wrapper -->

    <?php include 'includes/scripts.php'; ?>
    <script>
        $(function () {
            $(document).on('click', '.approve', function (e) {
                e.preventDefault();
                $('#approve').modal('show');
                var id = $(this).data('id');
                $('#event_id').val(id);
            });

            $(document).on('click', '.reject', function (e) {
                e.preventDefault();
                $('#reject').modal('show');
                var id = $(this).data('id');
                $('#event_id_2').val(id);
            });

            $(document).on('click', '.delete', function (e) {
                e.preventDefault();
                $('#delete').modal('show');
                var id = $(this).data('id');
                getRow(id);
            });

        });

        function getRow(id) {
            $.ajax({
                type: 'POST',
                url: 'category_row.php',
                data: {
                    id: id
                },
                dataType: 'json',
                success: function (response) {
                    $('.catid').val(response.id);
                    $('#edit_name').val(response.name);
                    $('.catname').html(response.name);
                }
            });
        }
    </script>
</body>

</html>