<div id="ModalAddCohort" class="modal" style="height:100%">
    <div class="modal-header" style="padding-left: 24px;">
        <h5>Cohort toevoegen</h5>
    </div>
    <div class="modal-content">
        <!-- CODE VOOR COHORT TOEVOEGEN BACK-END -->
        <?php
        $get_cohort = "SELECT * FROM cohort";
        $result_get_cohort = $conn->query($get_cohort);
        if ($result_get_cohort->num_rows > 0) {
            echo "Wij hebben de volgende jaren in het systeem staan:<br>";
            while ($row_get_cohort = $result_get_cohort->fetch_assoc()) {
                echo $row_get_cohort['cohort_jaar'] . '<br>';
            }
        } else {
            echo "<h4> Er zijn 0 resultaten</h4>";
        }
        ?>
        <form method="POST">
            <label>Cohort jaar:</label>
            <input type="text" class="form-control" style="border-radius: 0;" name="cohort_jaar" placeholder="Cohortjaar">
            <br>
            <input type="submit" name="new_cohort_submit" class="btn btn-success" value="Versturen" style="border-radius: 0;">
            <a href="#!" class="modal-action modal-close waves-effect waves-green btn btn-success ">Sluiten</a>
        </form>
        <?php
        if (isset($_POST['new_cohort_submit'])) {
            if (!empty($_POST['cohort_jaar'])) {
                $cohort_jaar = $_POST['cohort_jaar'];
                $add_cohort_sql = "INSERT INTO cohort(cohort_jaar) VALUES ('" . $cohort_jaar . "')";
                echo "<meta http-equiv='refresh' content='0'>";
                if ($conn->query($add_cohort_sql) === TRUE) {
                    echo "Cohort is toegevoegd";
                } else {
                    echo "FOUTMELDING! Probeer opnieuw";
                }
            }
        }
        ?>
        <!--EINDE CODE VOOR COHORT TOEVOEGEN BACKEND -->
    </div>
</div>