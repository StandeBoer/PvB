<?php
include("connect.php");
$return[] = array();
$get_id = $_GET['id'];
$get_werkprocessen = "SELECT * FROM werkproces WHERE kerntaak_id = '" . $get_id . "'";
//echo $get_werkprocessen;
$result_werkproces = $conn->query($get_werkprocessen);
if ($result_werkproces->num_rows > 0) {
    $i = 0;
    while ($row_werkproces = $result_werkproces->fetch_assoc()) {
        $return[$i]["name"] = $row_werkproces["werkproces_naam"];
        $return[$i]["id"] = $row_werkproces["werkproces_id"];
        $i++;
    }
}

echo json_encode($return);



