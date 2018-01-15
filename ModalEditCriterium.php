<div id="ModalEditCriterium" class="modal">
    <div class="modal-header" style="padding-left: 24px;">
        <h5> Bewerken</h5>
    </div>
    <div class="modal-content">
        <form method="POST">
            <i class="material-icons prefix tiny">mode_edit</i><label>Om een criterium aan te passen voert u hier de wijziging in:</label>
            <input type="hidden" class="form-control" style="border-radius: 0;" name="criterium_id" id="criterium_id">
            <input type="text" class="form-control hide" style="border-radius: 0;" name="criterium_naam" id="criterium_naam" placeholder="Criterium naam">
            <button type="submit" name="edit_criterium_submit" class="btn btn-success" value="Opslaan">Opslaan</button>
            <a href="#!" class="modal-action modal-close waves-effect waves-green btn btn-success ">Sluiten</a>
        </form>
    </div>
</div>
<?php
if (isset($_POST["edit_criterium_submit"])) {
    if (isset($_POST["criterium_naam"])) {
        $edit_criterium_id = $_POST["criterium_id"];
        $edit_criterium_naam = $_POST["criterium_naam"];
        $edit_criterium = "UPDATE werkproces_criterium SET werkproces_criterium_naam='$edit_criterium_naam' WHERE werkproces_criterium_id = $edit_criterium_id";
        if ($conn->query($edit_criterium) === TRUE) {
            //echo "Record updated successfully";
        } else {
            //echo "Error updating record: " . $conn->error;
        }
    }
}
?>
