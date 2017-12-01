<div id="ModalEditKerntaak" class="modal">
    <div class="modal-header" style="padding-left: 24px;">
        <h5> Bewerken</h5>
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
                    <input type="text" class="form-control" style="border-radius: 0;" name="kerntaak_naam" placeholder="Kerntaak naam">
                    <input type="text" class="form-control" style="border-radius: 0;" name="kerntaak_omschrijving" placeholder="omschrijving">
                    <input type="submit" name="edit_kerntaak_submit" class="btn btn-success" value="Versturen" style="border-radius: 0;">
                    <input type="submit" name="sluiten" class="btn btn-success data-dismiss" value="Annuleren">
            
        </form>
        
         <script type="text/javascript">
               $(document).ready(function () {
     $('#modalClose').click(function (){
                window.setTimeout(function () {
                  $('#contact').modal('hide');
                }, 5000);
              });
          });
          </script>
                <?php
                if (isset($_POST['edit_kerntaak_submit'])) {
                    
                }
                ?>
        
    </div>
</div>
