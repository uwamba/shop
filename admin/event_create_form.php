<?php
include 'includes/session.php';
require '../vendor/autoload.php';
include 'includes/format.php';


?>

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
                    New Event
                </h1>
                <ol class="breadcrumb">
                    <li><a href="#"><i class="fa fa-dashboard"></i> New Event</a></li>
                    <li class="active">New Event</li>
                </ol>
            </section>

            <!-- Main content -->
            <section class="content">

                <h2>Create Event</h2>
                <form action="event_insert.php" method="POST">
            <div class="mb-3 col-xs-7">
                <label for="event_name" class="form-label">Event Name:</label>
                <input type="text" id="event_name" name="event_name" class="form-control" placeholder="Enter event name" required>
            </div>

            <div class="mb-3 col-xs-7">
                <label for="start_date" class="form-label">Start Date:</label>
                <input type="date" id="start_date" name="start_date" class="form-control" required>
            </div>

            <div class="mb-3 col-xs-7">
                <label for="end_date" class="form-label">End Date:</label>
                <input type="date" id="end_date" name="end_date" class="form-control" required>
            </div>

            <div class="mb-3 col-xs-7">
                <label for="description" class="form-label">Description:</label>
                <textarea id="description" name="description" class="form-control" rows="4" placeholder="Enter event description" required></textarea>
            </div>
          
            <div class="mb-3 col-xs-7">
            <button type="submit" name="add" class="btn btn-primary mt-3">Submit</button>
            </div>

            
        </form>


            </section>
            <!-- right col -->
        </div>
        <?php include 'includes/footer.php'; ?>

    </div>
    <!-- ./wrapper -->

    <?php $pdo->close(); ?>
    <?php include 'includes/scripts.php'; ?>


</body>

</html>