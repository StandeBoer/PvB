<?php
include 'connect.php';
$get_kerntaak_id = $_GET['id'];
//echo $get_kerntaak_id;
$sql_beoordeling = "SELECT wp.werkproces_id, 
    wp.werkproces_naam, wc.werkproces_criterium_id, wc.werkproces_criterium_naam, cn.criterium_normering_nummer, cn.criterium_normering_naam "
        
        . "FROM werkproces AS wp "
        . "INNER JOIN werkproces_criterium AS wc "
        . "ON wp.werkproces_id = wc.werkproces_id "
        . "INNER JOIN criterium_normering AS cn "
        . "ON wc.werkproces_criterium_id = cn.werkproces_criterium_id "
        . "WHERE wp.kerntaak_id = $get_kerntaak_id";
echo $sql_beoordeling;
$result_beoordeling = $conn->query($sql_beoordeling);
if ($result_beoordeling->num_rows > 0) {
    $i = 0;
    
    while ($row_beoordeling = $result_beoordeling->fetch_assoc()) {
    $sql_normering = "SELECT * FROM criterium_normering WHERE werkproces_criterium_id = " . $row_beoordeling["werkproces_id"];
    $result_normering = $conn->query($sql_normering);
    $normering = array();
    while ($row_normering = $result_normering->fetch_assoc()) {
        $normering[$row_normering["criterium_normering_id"]] = $row_normering["criterium_normering_naam"];
    }
    
    //print_r($normering);
        
        
//echo '<br />' . $row_beoordeling["werkproces_naam"] . '<br /> ' . $row_beoordeling["werkproces_criterium_naam"];
        $return_beoordeling[$i]["werkproces_id"] = $row_beoordeling["werkproces_id"];
        $return_beoordeling[$i]["werkproces_naam"] = $row_beoordeling["werkproces_naam"];
        $return_beoordeling[$i]["werkproces_criterium_id"] = $row_beoordeling["werkproces_criterium_id"];
        $return_beoordeling[$i]["werkproces_criterium_naam"] = $row_beoordeling["werkproces_criterium_naam"];
        
        $return_beoordeling[$i]["criterium_normering_nummer"] = $row_beoordeling["criterium_normering_nummer"];
        $return_beoordeling[$i]["criterium_normering_naam"] = $row_beoordeling["criterium_normering_naam"];
        $i++;
    }
}
echo json_encode($return_beoordeling);
?>