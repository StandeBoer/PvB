<div id="ModalAddCriterium" class="modal" style="height:100%">
    <div class="modal-header" style="padding-left: 24px;">
        <h5>Criterium toevoegen</h5>
    </div>
    <div class="modal-content">
        <!-- CODE VOOR CRITERIUM TOEVOEGEN BACK-END -->
        <?php
        $get_kerntaak_criterium = "SELECT * FROM kerntaak";
        $result_kerntaak_criterium = $conn->query($get_kerntaak_criterium);
        if ($result_kerntaak_criterium->num_rows > 0) {
            ?>
            Om een criterium toe te voegen selecteerd u eerst de kerntaak en daarna het werkproces:
            <br><br>
            <form method="POST">
                <select name="kerntaak_criterium_option" required>
                    <option selected="selected" value="0" disabled>Kies een kerntaak</option>
                    <?php
                    while ($row_kerntaak_criterium = $result_kerntaak_criterium->fetch_assoc()) {
                        ?>
                        <option value="<?php echo $row_kerntaak_criterium["kerntaak_id"] ?>"><?php echo $row_kerntaak_criterium["kerntaak_naam"] ?></option>
                        <?php
                    }
                    ?>
                </select>
                <select name="werkproces_criterium_option" class="hide">
                    <option selected="selected" value="" disabled>Kies een werkproces</option>
                </select>
                <input type="text" class="hide" name="criterium_oms" placeholder="Criterium omschrijving" required>
                <button class="btn waves-effect waves-light hide" type="submit" name="new_criterium_submit">Versturen</button>
            </form>
            <?php
        }

        if (isset($_POST['new_criterium_submit'])) {
//            echo 'hoi <br>';
            if (isset($_POST['kerntaak_criterium_option'])) {
//                echo 'kerntaak gezet <br>';
                if (isset($_POST['werkproces_criterium_option'])) {
                    $werkproces_id = $_POST['werkproces_criterium_option'];
//                    echo $r;
//                    echo 'werkproces gezet<br>';
                    if (isset($_POST['criterium_oms'])) {
                        $criterium_omschrijving = $_POST['criterium_oms'];
//                        echo $criterium_omschrijving;
                        $add_criterium = "INSERT INTO werkproces_criterium (werkproces_criterium_naam, werkproces_id) VALUES ('" . $criterium_omschrijving . "','" . $werkproces_id . "')";
                        if ($conn->query($add_criterium) === TRUE) {
//                            echo "Klas is toegevoegd";
                        } else {
//                            echo "FOUTMELDING! Probeer opnieuw";
                        }
                    }
                }
            }
        }
        ?>
        <!--EINDE CODE VOOR CRITERIUM TOEVOEGEN BACKEND -->
    </div>
</div>