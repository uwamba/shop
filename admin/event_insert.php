
<?php
include 'includes/session.php';

if (isset($_POST['add'])) {
    $event_name = trim($_POST['event_name']);
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];
    $description = trim($_POST['description']);
    $user_id=$admin['id'];
    echo $user_id;
    $conn = $pdo->open();


    try {
        $stmt = $conn->prepare("INSERT INTO events (event_name, start_datetime, end_datetime, description,user_id) VALUES (:event_name, :start_datetime, :end_datetime, :description,:user_id)");
        $stmt->execute(['event_name' => $event_name, 'start_datetime' => $start_date, 'end_datetime' => $end_date, 'description' => $description,'user_id' => $user_id]);
        $_SESSION['success'] = 'Event added successfully';
    } catch (PDOException $e) {
        $_SESSION['error'] = $e->getMessage();
    }


    $pdo->close();
} else {
    $_SESSION['error'] = 'Fill up required field form first';
}

header('location: event_calendar.php');

?>