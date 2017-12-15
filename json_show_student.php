<?php
include 'connect.php';
$get_klas_id = $_GET['id'];
//echo $get_kerntaak_id;
$get_student = "SELECT student_id, student_naam, student_emailadres FROM student WHERE klas_id = '" . $get_klas_id . "'";
//echo $get_student;
$result_student = $conn->query($get_student);
//echo $result_student;
if ($result_student->num_rows > 0) {
    $i = 0;
    while ($row_student = $result_student->fetch_assoc()) {
        $return_student[$i]["student_id"] = $row_student["student_id"];
        $return_student[$i]["student_name"] = $row_student["student_naam"];
        $return_student[$i]["student_email"] = $row_student["student_emailadres"];
        $i++;
    }
}
echo json_encode($return_student);
