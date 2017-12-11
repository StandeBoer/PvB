<?php
include 'connect.php';
$return[] = array();
$edit_student_id = $_GET['id'];
//echo 'id = ' . $edit_kerntaak_id;
$get_selected_student = "SELECT student_id, student_naam, student_emailadres FROM student WHERE student_id = $edit_student_id";
//echo $get_selected_student;
$result_selected_student = $conn->query($get_selected_student);
//echo $result_selected_kerntaak;
if ($result_selected_student->num_rows > 0) {
    while ($row_selected_student = $result_selected_student->fetch_assoc()) {
        $return_student["id"] = $row_selected_student["student_id"];
        $return_student["name"] = $row_selected_student["student_naam"];
        $return_student["email"] = $row_selected_student["student_emailadres"];
    }
}

echo json_encode($return_student);