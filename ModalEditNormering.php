<div id="ModalEditNormering" class="modal">
    <div class="modal-header" style="padding-left: 24px;">
        <h5> Bewerken</h5>
    </div>
    <div class="modal-content">
        <form method="POST">
            <i class="material-icons prefix tiny">mode_edit</i><label>Om een normeringswaarde aan te passen voert u hier de wijziging in:</label>
            <input type="hidden" class="form-control" style="border-radius: 0;" name="normering_id" id="normering_id">
            <input type="text" class="form-control hide" style="border-radius: 0;" name="normering_naam" id="normering_naam" placeholder="Normering">
            <button type="submit" name="edit_normering_submit" class="btn btn-success" value="Opslaan">Opslaan</button>
            <input type="submit" name="sluiten" class="btn btn-success data-dismiss" value="Annuleren">
        </form>
    </div>
</div>
<?php
if (isset($_POST["edit_normering_submit"])) {
    if (isset($_POST["normering_naam"])) {
        $edit_normering_id = $_POST["normering_id"];
        $edit_normering_naam = $_POST["normering_naam"];
        $edit_normering = "UPDATE criterium_normering SET criterium_normering_naam='$edit_normering_naam' WHERE criterium_normering_id = $edit_normering_id";
        if ($conn->query($edit_normering) === TRUE) {
            //echo "Record updated successfully";
        } else {
            //echo "Error updating record: " . $conn->error;
        }
    }
}
?>
