<?php
include 'connect.php';
global $conn;
$criterium_id = $_GET['id'];
$sql_delete_werkproces = "DELETE FROM werkproces_criterium WHERE werkproces_criterium_id = $criterium_id";
if ($conn->query($sql_delete_werkproces) === TRUE) {
    
} else {
    
}
?>
<script type="text/javascript">location.href = 'criterium.php';</script>