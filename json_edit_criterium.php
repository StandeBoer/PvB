<?php
include 'connect.php';
$edit_criterium_id = $_GET['id'];
//echo 'id = ' . $edit_kerntaak_id;
$get_selected_criterium = "SELECT werkproces_criterium_id, werkproces_criterium_naam FROM werkproces_criterium WHERE werkproces_criterium_id = $edit_criterium_id";
//echo $get_selected_kerntaak;
$result_selected_criterium = $conn->query($get_selected_criterium);
//echo $result_selected_kerntaak;
if ($result_selected_criterium->num_rows > 0) {
    while ($row_selected_criterium = $result_selected_criterium->fetch_assoc()) {
        $return_criterium["id"] = $row_selected_criterium["werkproces_criterium_id"];
        $return_criterium["name"] = $row_selected_criterium["werkproces_criterium_naam"];
    }
}

echo json_encode($return_criterium);