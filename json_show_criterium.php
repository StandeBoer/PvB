<?php
include 'connect.php';
$return[] = array();
$get_werkproces_id = $_GET['id'];
$get_show_criterium= "SELECT * FROM werkproces_criterium WHERE werkproces_id = '" . $get_werkproces_id . "'";
$result_show_criterium = $conn->query($get_show_criterium);
if ($result_show_criterium->num_rows > 0) {
    $i = 0;
    while ($row_show_criterium = $result_show_criterium->fetch_assoc()) {
        $return_show_criterium[$i]["criterium_naam"] = $row_show_criterium["werkproces_criterium_naam"];
        $return_show_criterium[$i]["criterium_id"] = $row_show_criterium["werkproces_criterium_id"];
        $i++;
    }
}
echo json_encode($return_show_criterium);
?>