<div id="ModalAddKlas" class="modal">
    <div class="modal-header" style="padding-left: 24px;">
        <h5>Add Klas</h5>
    </div>
    <div class="modal-content">
        <!-- CODE VOOR KLAS TOEVOEGEN BACK-END -->
        <form method="POST">
            <?php
            $error = '';
            $get_cohort = "SELECT * FROM cohort";
            $result_cohort = $conn->query($get_cohort);
            if ($result_cohort->num_rows > 0) {
                ?>
                <select name="cohort_option" required>
                    <option selected="selected" disabled>Kies een Cohort</option>
                    <?php
                    while ($row_cohort = $result_cohort->fetch_assoc()) {
                        ?>
                        <option value="<?php echo $row_cohort["cohort_id"] ?>"><?php echo $row_cohort["cohort_jaar"] ?></option>
                        <?php
                    }
                    ?>
                </select>
                <?php
            }
            ?>
            <input type="text" class="form-control" style="border-radius: 0;" name="klas_naam" placeholder="Klas">
            <br>
            <input type="submit" name="new_klas_submit" class="btn btn-success" value="Versturen" style="border-radius: 0;">
            <input type="submit" name="sluiten" class="btn btn-success data-dismiss" value="Annuleren">
        </form>

        <?php
        if (isset($_POST['new_klas_submit'])) {
            if (isset($_POST['cohort_option'])) {
                if (isset($_POST['klas_naam'])) {
                    $cohort_id = $_POST['cohort_option'];
                    //echo $cohort_id;
                    $klas_naam = $_POST['klas_naam'];
                    $add_klas_sql = "INSERT INTO klas(klas_naam, cohort_id) VALUES ('" . $klas_naam . "', '" . $cohort_id . "')";
                    if ($conn->query($add_klas_sql) === TRUE) {
                        //echo "Werkproces is toegevoegd";
                    } else {
                        //echo "FOUTMELDING! Probeer opnieuw";
                    }
                }
            } else {
                $error = 'Foutmelding, selecteer een kerntaak';
            }
        }
        if (!empty($error)) {
            echo $error;

        } 
        ?>


        <!--EINDE CODE VOOR KLAS TOEVOEGEN BACKEND -->
    </div>
</div>