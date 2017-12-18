<?php
include 'connect.php';
$get_normering_id = $_GET['id'];
//echo $get_cohort_id;
$get_normering = "SELECT criterium_normering_id, criterium_normering_naam FROM criterium_normering WHERE werkproces_criterium_id = '" . $get_normering_id . "'";
//echo $get_klas;
$result_criterium_normering = $conn->query($get_normering);
if ($result_criterium_normering->num_rows > 0) {
    $i = 0;
    while ($row_criterium_normering = $result_criterium_normering->fetch_assoc()) {
        $return_criterium_normering[$i]["criterium_normering_name"] = $row_criterium_normering["criterium_normering_naam"];
        $return_criterium_normering[$i]["criterium_normering_id"] = $row_criterium_normering["criterium_normering_id"];
        $i++;
    }
}
echo json_encode($return_criterium_normering);
?>
