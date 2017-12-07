<?php
include 'connect.php';
global $conn;
$werkproces_id = $_GET['id'];
$sql_delete_werkproces = "DELETE FROM werkproces WHERE werkproces_id = $werkproces_id";
if ($conn->query($sql_delete_werkproces) === TRUE) {
    
} else {
    
}
?>
<script type="text/javascript">location.href = 'werkprocessen.php';</script>