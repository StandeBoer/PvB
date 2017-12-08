<div id="ModalEditWerkproces" class="modal">
    <div class="modal-header" style="padding-left: 24px;">
        <h5> Bewerken</h5>
    </div>
    <div class="modal-content">
        <form method="POST">
            <label>Om een kerntaak aan te passen dient u de aanpassingen op te slaan:</label>
            <input type="hidden" class="form-control" style="border-radius: 0;" name="werkproces_id" id="werkproces_id">
            <input type="text" class="form-control hide" style="border-radius: 0;" name="werkproces_naam" id="werkproces_naam" placeholder="Werkproces naam">
            <button type="submit" name="edit_werkproces_submit" class="btn btn-success" value="Opslaan">Opslaan</button>
            <input type="submit" name="sluiten" class="btn btn-success data-dismiss" value="Annuleren">
        </form>
    </div>
</div>
<?php
if (isset($_POST["edit_werkproces_submit"])) {
    if (isset($_POST["werkproces_naam"])) {
        $edit_werkproces_id = $_POST["werkproces_id"];
        $edit_werkproces_naam = $_POST["werkproces_naam"];
        $edit_werkproces = "UPDATE werkproces SET werkproces_naam='$edit_werkproces_naam' WHERE werkproces_id = $edit_werkproces_id";
        if ($conn->query($edit_werkproces) === TRUE) {
            //echo "Record updated successfully";
        } else {
            //echo "Error updating record: " . $conn->error;
        }
    }
}
?>