<?php
include 'connect.php';
global $conn;
$normering_id = $_GET['id'];
$sql_delete_normering = "DELETE FROM criterium_normering WHERE criterium_normering_id = $normering_id";
if ($conn->query($sql_delete_normering) === TRUE) {
    
} else {
    
}
?>
<script type="text/javascript">location.href = 'normering.php';</script>