<?php

include("connect.php");

$sql_beoordeling = "SELECT wp.werkproces_id, wp.werkproces_naam, wc.werkproces_criterium_id, wc.werkproces_criterium_naam FROM werkproces AS wp INNER JOIN werkproces_criterium AS wc ON wp.werkproces_id = wc.werkproces_id WHERE wp.kerntaak_id = 1";
$get_kerntaak_id = $_GET['id'];

$result_beoordeling = $conn->query($sql_beoordeling);
if ($result_beoordeling->num_rows > 0) {
    $i = 0;

    $totaal = array();

    while ($row_beoordeling = $result_beoordeling->fetch_assoc()) {
        $sql_normering = "SELECT * FROM criterium_normering WHERE werkproces_criterium_id = " . $row_beoordeling["werkproces_criterium_id"];
        $result_normering = $conn->query($sql_normering);
        $normering = array();
        
        
        $totaal[$i] = array();
        $totaal[$i]["werkproces_naam"] = $row_beoordeling["werkproces_naam"];
        $totaal[$i]["werkproces_criterium_naam"] = $row_beoordeling["werkproces_criterium_naam"];
        $m = 1;
        while ($row_normering = $result_normering->fetch_assoc()) {
            $totaal[$i]["normering" . $m] = $row_normering["criterium_normering_naam"];
            $totaal[$i]["normering" . $m ."_id"] = $row_normering["criterium_normering_id"];
            $m++;
        }
        
        if ($i > 0) {
            //$totaal[$i - 1]["werkproces_naam"] = "";
            if ($totaal[$i - 1]["werkproces_naam"] == $totaal[$i]["werkproces_naam"]) {
                $totaal[$i]["werkproces_naam"] = "";
            }
        }
        //print_r($totaal);
        $i++;
    }
    
    echo json_encode($totaal);
}