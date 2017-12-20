<?php
include 'connect.php';
global $conn;
$klas_id = $_GET['id'];
$sql_delete_klas = "DELETE FROM klas WHERE klas_id = $klas_id";
if ($conn->query($sql_delete_klas) === TRUE) {
    
} else {
    
}
?>
<script type="text/javascript">location.href = 'klassen.php';</script>