<?php
include 'connect.php';
global $conn;
$kerntaak_id = $_GET['id'];
$sql_delete_kerntaak = "DELETE FROM kerntaak WHERE kerntaak_id = $kerntaak_id";
if ($conn->query($sql_delete_kerntaak) === TRUE) {
    
} else {
    
}
?>
<script type="text/javascript">location.href = 'kerntaken.php';</script>