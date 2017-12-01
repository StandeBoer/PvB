<?php
/**
 * Created by PhpStorm.
 * User: wouter
 * Date: 30-11-17
 * Time: 14:55
 */
//print_r($_GET);
//$return[] = array();
if ($_GET['id'] == 1) {
    $return[0]["name"] = "1.1 Werkproces";
    $return[0]["id"] = 6;
    $return[1]["name"] = "1.2 Werkproces";
    $return[1]["id"] = 7;
}
if ($_GET['id'] == 5) {
    $return[0]["name"] = "2.1 Werkproces";
    $return[0]["id"] = 9;
    $return[1]["name"] = "2.3 Werkproces";
    $return[1]["id"] = 10;
    $return[2]["name"] = "2.5 Werkproces";
    $return[2]["id"] = 11;
}
    echo json_encode($return);