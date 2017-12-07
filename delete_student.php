<?php
include 'connect.php';
global $conn;
$student_id = $_GET['id'];
$sql_delete_student = "DELETE FROM student WHERE student_id = $student_id";
if ($conn->query($sql_delete_student) === TRUE) {
    
} else {
    
}
?>
<script type="text/javascript">location.href = 'studenten.php';</script>