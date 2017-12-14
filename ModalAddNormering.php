<div id="ModalAddNormering" class="modal">
    <div class="modal-header" style="padding-left: 24px;">
        <h5>Normering toevoegen</h5>
    </div>
    <div class="modal-content">
        <form method="POST">
            <label>Om een normering toe te voegen selecteert u eerst het criterium selecteren waar de normering onder valt. Daarna vult u de specificaties in:</label>
            <br><br>
            <label>Werkproces valt onder:</label>
        <?php
        $error = '';
        $get_werkproces_criterium = "SELECT * FROM werkproces_criterium";
        $result_werkproces_criterium = $conn->query($get_werkproces_criterium);
        if ($result_werkproces_criterium->num_rows > 0) {
            ?>
            <select name="werkproces_criterium_option" required>
                <option selected="selected" disabled>Selecteer een criterium</option>
            <?php
            while ($row_werkproces_criterium = $result_werkproces_criterium->fetch_assoc()) {
                ?>
                <option value="<?php echo $row_werkproces_criterium["werkproces_criterium_id"]?>"><?php echo $row_werkproces_criterium["werkproces_criterium_naam"]?></option>
                <?php  
            }
            ?>
            </select>
        <?php
        }
        ?>
            <br>
            <i class="material-icons prefix tiny">mode_edit</i><label>Normeringsvoorwaarde:</label>
            <input type="text" class="form-control" style="border-radius: 0;" name="normering_naam" placeholder="Normering">
            <input type="submit" name="new_normering_naam" class="btn btn-success" value="Versturen" style="border-radius: 10;">
            <input type="submit" name="sluiten" class="btn btn-success data-dismiss" value="Annuleren">
        </form>
        
        <?php
        if (isset($_POST['new_normering_naam'])){
            if (isset($_POST['werkproces_criterium_option'])){
                if (isset($_POST['normering_naam'])){
                    $kerntaak_id = $_POST['werkproces_criterium_option'];
                    $werkproces_naam = $_POST['normering_naam'];
                    $add_werkproces_sql = "INSERT INTO normering(normering_naam, werkproces_criterium_id) VALUES ('" . $normering_naam . "', '" . $werkproces_criterium_id . "')"; 
                    echo "<meta http-equiv='refresh' content='0'>";
                    if ($conn->query($add_normering_sql) === TRUE) {
                        echo "Normering is toegevoegd";
                    } else {
                        echo "Probeer opnieuw";
                    }
                }
            }  else {
            $error = 'Foutmelding 2';
            }
        }
        
        if (!empty($error)){
            echo $error;
        }
        ?>       
        <!--EINDE CODE VOOR WERKPROCES TOEVOEGEN BACKEND + KOPPELING NAAR KERNTAAK TOE -->

    </div>
</div>