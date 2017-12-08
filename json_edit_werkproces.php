<?php
include 'connect.php';
$return[] = array();
$edit_werkproces_id = $_GET['id'];
//echo 'id = ' . $edit_kerntaak_id;
$get_selected_werkproces = "SELECT werkproces_id, werkproces_naam FROM werkproces WHERE werkproces_id = $edit_werkproces_id";
//echo $get_selected_kerntaak;
$result_selected_werkproces = $conn->query($get_selected_werkproces);
//echo $result_selected_kerntaak;
if ($result_selected_werkproces->num_rows > 0) {
    while ($row_selected_werkproces = $result_selected_werkproces->fetch_assoc()) {
        $return_werkproces["id"] = $row_selected_werkproces["werkproces_id"];
        $return_werkproces["name"] = $row_selected_werkproces["werkproces_naam"];
    }
}

echo json_encode($return_werkproces);
