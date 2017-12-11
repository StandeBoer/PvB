<div id="ModalEditStudent" class="modal">
    <div class="modal-header" style="padding-left: 24px;">
        <h5> Bewerken</h5>
    </div>
    <div class="modal-content">
        <form method="POST">
            <label>Om een student aan te passen dient u de aanpassingen op te slaan:</label>
            <input type="hidden" class="form-control" style="border-radius: 0;" name="student_id" id="student_id">
            <input type="text" class="form-control hide" style="border-radius: 0;" name="student_naam" id="student_naam" placeholder="Naam">
            <input type="text" class="form-control hide" style="border-radius: 0;" name="student_email" id="student_email" placeholder="Emailadres">
            <button type="submit" name="edit_student_submit" class="btn btn-success" value="Opslaan">Opslaan</button>
            <input type="submit" name="sluiten" class="btn btn-success data-dismiss" value="Annuleren">
        </form>
    </div>
</div>
<?php
if (isset($_POST["edit_student_submit"])) {
    if (isset($_POST["student_naam"])) {
        $edit_student_id = $_POST["student_id"];
        //echo $edit_student_id;
        $edit_student_naam = $_POST["student_naam"];
        //echo $edit_student_naam;
        $edit_student_emailadres = $_POST["student_email"];
        //echo $edit_student_emailadres;
        $edit_student = "UPDATE student SET student_naam='$edit_student_naam', student_emailadres='$edit_student_emailadres' WHERE student_id = $edit_student_id";
        //echo $edit_student;
        if ($conn->query($edit_student) === TRUE) {
            //echo "Record updated successfully";
        } else {
            //echo "Error updating record: " . $conn->error;
        }
    }
}
?>