<div id="ModalAddKerntaak" class="modal">
    <div class="modal-header" style="padding: 24px;">
        <h5>Kerntaak toevoegen</h5>
    </div>
    <div class="modal-content">
        <form method="POST">
            <label>Om een kerntaak toe te voegen dient u hieronder de naam van de kerntaak aan te geven:</label>
            <input type="text" class="form-control" style="border-radius: 0;" name="kerntaak_naam" placeholder="Kerntaak naam" required>
            <input type="text" class="form-control" style="border-radius: 0;" name="kerntaak_omschrijving" placeholder="omschrijving" required>
            <input type="submit" name="new_kerntaak_submit" class="btn btn-success" value="Versturen" style="border-radius: 0;">
        </form>
            <?php
            if (isset($_POST['new_kerntaak_submit'])) {
            if (!empty($_POST['kerntaak_naam'])) {
                if (!empty($_POST['kerntaak_omschrijving'])){
                $kerntaak_name = $_POST['kerntaak_naam'];
                $kerntaak_desc = $_POST['kerntaak_omschrijving'];
                $add_kerntaak_sql = "INSERT INTO kerntaak(kerntaak_naam, kerntaak_omschrijving) VALUES ('" . $kerntaak_name .  "' , '" . $kerntaak_desc . "')";
                echo "<meta http-equiv='refresh' content='0'>";
                if ($conn->query($add_kerntaak_sql) === TRUE) {
                    echo "Kerntaak is toegevoegd";
                } else {
                    echo "FOUTMELDING! Probeer opnieuw";
                } 
                }

            }
        }
        ?>
    </div>
</div>