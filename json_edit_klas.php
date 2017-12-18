<?php
include 'connect.php';
$return[] = array();
$edit_klas_id = $_GET['id'];
//echo 'id = ' . $edit_kerntaak_id;
$get_selected_klas = "SELECT klas_id, klas_naam FROM klas WHERE klas_id = $edit_klas_id";
//echo $get_selected_student;
$result_selected_klas = $conn->query($get_selected_klas);
//echo $result_selected_kerntaak;
if ($result_selected_klas->num_rows > 0) {
    while ($row_selected_klas = $result_selected_klas->fetch_assoc()) {
        $return_klas["id"] = $row_selected_klas["klas_id"];
        $return_klas["name"] = $row_selected_klas["klas_naam"];
    }
}
echo json_encode($return_klas);