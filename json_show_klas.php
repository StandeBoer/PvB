<?php 
include 'connect.php';
$get_cohort_id = $_GET['id'];
//echo $get_cohort_id;
$get_klas = "SELECT klas_id, klas_naam, cohort_id FROM klas WHERE cohort_id = '" . $get_cohort_id . "'";
//echo $get_klas;
$result_klas = $conn->query($get_klas);
if ($result_klas->num_rows > 0) {
    $i = 0;
    while ($row_klas = $result_klas->fetch_assoc()) {
        $return_klas[$i]["name"] = $row_klas["klas_naam"];
        $return_klas[$i]["klas_id"] = $row_klas["klas_id"];
        $return_klas[$i]["cohort_id"] = $row_klas["cohort_id"];
        $i++;
    }
}
echo json_encode($return_klas);
?>
