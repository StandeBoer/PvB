<div id="ModalAddWerkproces" class="modal">
    <div class="modal-header">
        <h5>Werkproces toevoegen</h5>
    </div>
    <div class="modal-content">
    <!--START CODE VOOR WERKPROCES TOEVOEGEN BACKEND + KOPPELING NAAR KERNTAAK TOE -->
        <form method="POST">
            <label>Om een werkproces toe te voegen selecteerd u eerst de kerntaak en daarna vult u het werkproces in:</label>
            <br><br>
            <label>Werkproces valt onder:</label>
        <?php
        $error = '';
        $get_kerntaak = "SELECT * FROM kerntaak";
        $result_kerntaak = $conn->query($get_kerntaak);
        if ($result_kerntaak->num_rows > 0) {
            ?>
            <select name="kerntaak_option" required>
                <option selected="selected" disabled>Kies een kerntaak</option>
            <?php
            while ($row_kerntaak = $result_kerntaak->fetch_assoc()) {
                ?>
                <option value="<?php echo $row_kerntaak["kerntaak_id"]?>"><?php echo $row_kerntaak["kerntaak_naam"]?></option>
                <?php  
            }
            ?>
            </select>
        <?php
        }
        ?>
            <br>
            <i class="material-icons prefix tiny">mode_edit</i><label>Werkproces naam:</label>
            <input type="text" class="form-control" style="border-radius: 0;" name="werkproces_naam" placeholder="Werkproces">
            <input type="submit" name="new_werkproces_naam" class="btn btn-success" value="Versturen" style="border-radius: 10;">
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
        if (isset($_POST['new_werkproces_naam'])){
            if (isset($_POST['kerntaak_option'])){
                if (isset($_POST['werkproces_naam'])){
                    $kerntaak_id = $_POST['kerntaak_option'];
                    $werkproces_naam = $_POST['werkproces_naam'];
                    $add_werkproces_sql = "INSERT INTO werkproces(werkproces_naam, kerntaak_id) VALUES ('" . $werkproces_naam . "', '" . $kerntaak_id . "')"; 
                    echo "<meta http-equiv='refresh' content='0'>";
                    if ($conn->query($add_werkproces_sql) === TRUE) {
                        echo "Werkproces is toegevoegd";
                    } else {
                        echo "FOUTMELDING! Probeer opnieuw";
                    }
                }
            }  else {
            $error = 'Foutmelding, selecteer een kerntaak';
            }
        }
        
        if (!empty($error)){
            echo $error;
        }
        ?>       
        <!--EINDE CODE VOOR WERKPROCES TOEVOEGEN BACKEND + KOPPELING NAAR KERNTAAK TOE -->

    </div>
</div>