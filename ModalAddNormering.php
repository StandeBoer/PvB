<div id="ModalAddNormering" class="modal" style="height:100%">
    <div class="modal-header" style="padding-left: 24px;">
        <h5>Normering toevoegen</h5>
    </div>
    <div class="modal-content">
        <form method="POST">
            <label>Om een normering toe te voegen selecteert u eerst het criterium waar de normering onder valt. </label>
            <br><br>

            <!-- CODE VOOR CRITERIUM TOEVOEGEN BACK-END -->
            <?php
            $get_kerntaak_criterium = "SELECT * FROM kerntaak";
            $result_kerntaak_criterium = $conn->query($get_kerntaak_criterium);
            if ($result_kerntaak_criterium->num_rows > 0) {
                ?>
                <form method="POST">
                    <select name="kerntaak_option" required>
                        <option selected="selected" value="0" disabled>Kies een kerntaak</option>
                        <?php
                        while ($row_kerntaak_criterium = $result_kerntaak_criterium->fetch_assoc()) {
                            ?>
                            <option value="<?php echo $row_kerntaak_criterium["kerntaak_id"] ?>"><?php echo $row_kerntaak_criterium["kerntaak_naam"] ?></option>
                            <?php
                        }
                        ?>
                    </select>
                    <select name="werkproces_option" class="hide">
                        <option selected="selected" value="" disabled>Kies een werkproces</option>
                    </select>
                    <select name="criterium_option" class="hide">
                        <option selected="selected" value="" disabled>Kies een werkproces</option>
                    </select>
                    <textarea class="hide" id="normering_naam" style="min-height: 100px;" rows="6" cols="20" name="normering_naam" placeholder="Normering naam" ></textarea><br><br>
                    <button class="btn waves-effect waves-light hide" type="submit" name="new_normering_submit">Versturen</button>
                </form>
                <?php
            }

            if (isset($_POST['new_normering_submit'])) {
                if (isset($_POST['kerntaak_option'])) {
                    if (isset($_POST['werkproces_option'])) {
                        if (isset($_POST['criterium_option'])) {
                            if (isset($_POST['normering_naam'])) {
                                $criterium_id = $_POST['criterium_option'];
                                $normering_naam = $_POST['normering_naam'];
                                $add_normering_sql = "INSERT INTO criterium_normering (criterium_normering_naam, werkproces_criterium_id) VALUES ('" . $normering_naam . "', '" . $criterium_id . "')";
                                echo "<meta http-equiv='refresh' content='0'>";
                                if ($conn->query($add_normering_sql) === TRUE) {
                                    //echo "Normering is toegevoegd";
                                } else {
                                    echo "Probeer opnieuw";
                                }
                            }
                        }
                    }
                }
            }
            ?>       
            <!--EINDE CODE VOOR WERKPROCES TOEVOEGEN BACKEND + -->

    </div>
</div>