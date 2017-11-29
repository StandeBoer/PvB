<div id="ModalEditKerntaak" class="modal">
    <div class="modal-header">
        <h5>Kerntaak toevoegen</h5>
    </div>
    <div class="modal-content">
        <?php
        $edit_kerntaak_inhoud = "SELECT * FROM kerntaak WHERE ";
        $result_edit_kerntaak_inhoud = $conn->query($edit_kerntaak_inhoud);
        if ($result_edit_kerntaak_inhoud->num_rows > 0) {
            while ($row_edit_kerntaak_inhoud = $result_edit_kerntaak_inhoud->fetch_assoc()) {
                
            }
        }
                ?>
                <form method="POST">
                    <label>Om een kerntaak toe te voegen dient u hieronder de naam van de kerntaak aan te geven:</label>
                    <input type="text" class="form-control" style="border-radius: 0;" name="kerntaak_naam" placeholder="Kerntaak naam" required>
                    <input type="text" class="form-control" style="border-radius: 0;" name="kerntaak_omschrijving" placeholder="omschrijving" required>
                    <input type="submit" name="edit_kerntaak_submit" class="btn btn-success" value="Versturen" style="border-radius: 0;">
                </form>
                <?php
                if (isset($_POST['edit_kerntaak_submit'])) {
                    
                }
                ?>
        
    </div>
</div>
