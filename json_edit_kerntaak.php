<?php
include 'connect.php';
$return[] = array();
$edit_kerntaak_id = $_GET['id'];
//echo 'id = ' . $edit_kerntaak_id;
$get_selected_kerntaak = "SELECT kerntaak_naam, kerntaak_omschrijving FROM kerntaak WHERE kerntaak_id = $edit_kerntaak_id";
//echo $get_selected_kerntaak;
$result_selected_kerntaak = $conn->query($get_selected_kerntaak);
//echo $result_selected_kerntaak;
if ($result_selected_kerntaak->num_rows > 0) {
    while ($row_selected_kerntaak = $result_selected_kerntaak->fetch_assoc()) {
        $return_kerntaak["name"] = $row_selected_kerntaak["kerntaak_naam"];
        $return_kerntaak["description"] = $row_selected_kerntaak["kerntaak_omschrijving"];
    }
}

echo json_encode($return_kerntaak);