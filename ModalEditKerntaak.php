<div id="ModalEditKerntaak" class="modal">
    <div class="modal-header" style="padding-left: 24px;">
        <h5> Bewerken</h5>
    </div>
    <div class="modal-content">
        <form method="POST">
            <label>Om een kerntaak aan te passen voert u hier de wijziging in:</label>
            <input type="hidden" class="form-control" style="border-radius: 0;" name="kerntaak_id" id="kerntaak_id">
            <input type="text" class="form-control hide" style="border-radius: 0;" name="kerntaak_naam" id="kerntaak_naam" placeholder="Kerntaak naam">
            <button type="submit" name="edit_kerntaak_submit" class="btn btn-success" value="Opslaan">Opslaan</button>
            <a href="#!" class="modal-action modal-close waves-effect waves-green btn btn-success ">Sluiten</a>
        </form>
    </div>
</div>
<?php
if (isset($_POST["edit_kerntaak_submit"])) {
    if (isset($_POST["kerntaak_naam"])) {
        $edit_kerntaak_id = $_POST["kerntaak_id"];
        $edit_kerntaak_naam = $_POST["kerntaak_naam"];
        $edit_kerntaak = "UPDATE kerntaak SET kerntaak_naam='$edit_kerntaak_naam' WHERE kerntaak_id = $edit_kerntaak_id";
        if ($conn->query($edit_kerntaak) === TRUE) {
            //echo "Record updated successfully";
        } else {
            //echo "Error updating record: " . $conn->error;
        }
    }
}
?>