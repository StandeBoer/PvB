<?php
include 'connect.php';

$student = filter_var ( $_POST['student'], FILTER_SANITIZE_NUMBER_INT);

$sql = "SELECT criterium_normering_id FROM beoordeling WHERE student_id = '" . $student . "'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $results = array();
    while($row = $result->fetch_assoc()) {
        $results[] = $row;
    }
    echo json_encode($results);
}