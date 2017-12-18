<?php
include 'connect.php';
$edit_normering_id = $_GET['id'];
//echo 'id = ' . $edit_kerntaak_id;
$get_selected_normering = "SELECT criterium_normering_id, criterium_normering_naam FROM criterium_normering WHERE criterium_normering_id = $edit_normering_id";
//echo $get_selected_kerntaak;
$result_selected_normering= $conn->query($get_selected_normering);
//echo $result_selected_kerntaak;
if ($result_selected_normering->num_rows > 0) {
    while ($row_selected_normering = $result_selected_normering->fetch_assoc()) {
        $return_normering["id"] = $row_selected_normering["criterium_normering_id"];
        $return_normering["name"] = $row_selected_normering["criterium_normering_naam"];
    }
}

echo json_encode($return_normering);