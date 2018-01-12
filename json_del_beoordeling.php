<?php
include 'connect.php';
    print_r($_POST);

    $criterium = filter_var ( $_POST['criterium'], FILTER_SANITIZE_NUMBER_INT);
    $student = filter_var ( $_POST['student'], FILTER_SANITIZE_NUMBER_INT);

    $sql = "DELETE FROM beoordeling WHERE student_id=$student AND werkproces_criterium_id=$criterium";

    if ($conn->query($sql) === TRUE) {
        echo "Record deleted successfully";
    } else {
        echo "Error deleting record: " . $conn->error;
    }