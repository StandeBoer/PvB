<div id="ModalAddKlas" class="modal">
    <div class="modal-header" style="padding: 24px;">
        <h5>Add Klas</h5>
    </div>
    <div class="modal-content">
<!-- CODE VOOR KLAS TOEVOEGEN BACK-END -->
<?php
$get_klas = "SELECT * FROM klas";
$result_get_klas = $conn->query($get_klas);
if ($result_get_klas->num_rows > 0) {
    echo "Wij hebben de volgende klassen in het systeem staan:<br>";
    while ($row_get_klas = $result_get_klas->fetch_assoc()) {
        echo $row_get_klas['klas_naam'] . '<br>';
    }
} else {
    echo "<h4> Er zijn 0 klassen</h4>";
}
?>
<form method="POST">
    <label>Klas</label>
    <input type="text" class="form-control" style="border-radius: 0;" name="klas_naam" placeholder="Klas" required>
    <br>
    <input type="submit" name="new_klas_submit" class="btn btn-success" value="Versturen" style="border-radius: 0;">
</form>
<?php
if (isset($_POST['new_klas_submit'])) {
    if (!empty($_POST['klas_naam'])) {
        $klas = $_POST['klas_naam'];
        $add_klas_sql = "INSERT INTO klas(klas_naam) VALUES ('" . $klas . "')";
        echo "<meta http-equiv='refresh' content='0'>";
        if ($conn->query($add_klas_sql) === TRUE) {
            echo "Klas is toegevoegd";
        } else {
            echo "FOUTMELDING! Probeer opnieuw";
        }
    }
}
?>
<!--EINDE CODE VOOR KLAS TOEVOEGEN BACKEND -->
    </div>
</div>