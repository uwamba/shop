<?php
include 'includes/session.php';
require '../vendor/autoload.php';
include 'includes/format.php';

use benhall14\phpCalendar\Calendar;

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
                    Calendar
                </h1>
                <ol class="breadcrumb">
                    <li><a href="#"><i class="fa fa-dashboard"></i> Calendar</a></li>
                    <li class="active">Calendar</li>
                </ol>
            </section>

            <!-- Main content -->
            <section class="content">
                <?php
                $conn = $pdo->open();

                $calendar = new Calendar;
                $calendar->stylesheet();

                $month = 9;  // September
                $year = 2024;
                $query = $conn->prepare("
    SELECT event_name, start_datetime, end_datetime, user_id, status, payment, description
    FROM events 
    WHERE MONTH(start_datetime) = :month AND YEAR(start_datetime) = :year
");
                $query->execute(['month' => $month, 'year' => $year]);
                $events = $query->fetchAll(PDO::FETCH_ASSOC);
                // Add some events (you can fetch these from a database or array)
               
                foreach ($events as $event) {
                    $day = (int)date('j', strtotime($event['start_datetime'])); // Get day of the event
                    
                    // Prepare the event details for display
                    $calendar->addEvent(
                        date('Y-m-d', strtotime($event['start_datetime'])),   # start date in either Y-m-d or Y-m-d H:i if you want to add a time.
                        date('Y-m-d', strtotime($event['end_datetime'])),   # end date in either Y-m-d or Y-m-d H:i if you want to add a time.
                        $event['event_name'],  # event name text
                        true,           # should the date be masked - boolean default true
                        ['myclass', 'abc'],   # (optional) additional classes in either string or array format to be included on the event days
                        ['event-class', 'abc']   # (optional) additional classes in either string or array format to be included on the event summary box
                    );
                   
                }
               
               

                echo $calendar->draw(date('Y-m-d')); # draw this months calendar 

                $pdo->close();
                ?>
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