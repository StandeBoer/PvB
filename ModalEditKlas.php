<div id="ModalEditKlas" class="modal">
    <div class="modal-header" style="padding-left: 24px;">
        <h5> Bewerken</h5>
    </div>
    <div class="modal-content">
        <form method="POST">
            <label>Om een Klas aan te passen dient u de aanpassingen op te slaan:</label>
            <input type="hidden" class="form-control" style="border-radius: 0;" name="klas_id" id="klas_id">
            <input type="text" class="form-control hide" style="border-radius: 0;" name="klas_naam" id="klas_naam" placeholder="Naam">
            <button type="submit" name="edit_klas_submit" class="btn btn-success" value="Opslaan">Opslaan</button>
            <input type="submit" name="sluiten" class="btn btn-success data-dismiss" value="Annuleren">
        </form>
    </div>
</div>
<?php
if (isset($_POST["edit_klas_submit"])) {
    if (isset($_POST["klas_naam"])) {
        $edit_klas_id = $_POST["klas_id"];
        //echo $edit_student_id;
        $edit_klas_naam = $_POST["klas_naam"];
        //echo $edit_student_naam;
        $edit_klas = "UPDATE klas SET klas_naam='$edit_klas_naam' WHERE klas_id = $edit_klas_id";
        //echo $edit_student;
        if ($conn->query($edit_klas) === TRUE) {
            //echo "Record updated successfully";
        } else {
            //echo "Error updating record: " . $conn->error;
        }
    }
}
?>