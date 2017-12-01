<div id="ModalAddCriterium" class="modal">
    <div class="modal-header">
        <h5>Criterium toevoegen</h5>
    </div>
    <div class="modal-content">
        <!-- CODE VOOR CRITERIUM TOEVOEGEN BACK-END -->
        <?php
        $get_kerntaak_criterium = "SELECT * FROM kerntaak";
        $result_kerntaak_criterium = $conn->query($get_kerntaak_criterium);
        if ($result_kerntaak_criterium->num_rows > 0) {
            ?>
            <form method="POST">
                <label>Om een criterium toe te voegen selecteerd u eerst de kerntaak en daarna het werkproces:</label>
                <br>
                <select name = "kerntaak_criterium_option" required>
                    <option selected = "selected" disabled>Kies een kerntaak</option>
                    <?php
                    while ($row_kerntaak_criterium = $result_kerntaak_criterium->fetch_assoc()) {
                        ?>
                        <option value="<?php echo $row_kerntaak_criterium["kerntaak_id"] ?>"><?php echo $row_kerntaak_criterium['kerntaak_id'] . ' - ' . $row_kerntaak_criterium["kerntaak_naam"] ?></option>
                        <?php
                    }
                    ?>
                </select>
                <?php
            }
            $selected_kerntaak_id = $_POST['kerntaak_criterium_option'];
            $get_werkproces_criterium = "SELECT * FROM werkproces WHERE kerntaak_id = '" . $selected_kerntaak_id . "'";
            $result_werkproces_criterium = $conn->query($get_werkproces_criterium);
            if ($result_werkproces_criterium->num_rows > 0) {
                ?>
                <form method="POST">
                    <br>
                    <select name = "kerntaak_werkproces_option" required>
                        <option selected = "selected" disabled>Kies een werkproces</option>
                        <?php
                        while ($row_werkproces_criterium = $result_werkproces_criterium->fetch_assoc()) {
                            ?>
                            <option value="<?php echo $row_werkproces_criterium['werkproces_id'] ?>"><?php echo $row_werkproces_criterium['werkproces_id'] . ' - ' . $row_werkproces_criterium["werkproces_naam"] ?></option>
                            <?php
                        }
                        ?>
                    </select>
                    <?php
                } else {
                    echo 'nothing';
                }
                ?>    
                <i class="material-icons prefix tiny">mode_edit</i><label>Naam criterium:</label>
                <input type="text" class="form-control" style="border-radius: 0;" name="new_criterium" placeholder="Naam"><br><br>
                <input type="text" class="form-control" style="border-radius: 0;" name="beoordeling1" placeholder="Criterium een">
                <input type="text" class="form-control" style="border-radius: 0;" name="beoordeling2" placeholder="Criterium twee">
                <input type="text" class="form-control" style="border-radius: 0;" name="beoordeling3" placeholder="Criterium drie">
                <input type="text" class="form-control" style="border-radius: 0;" name="beoordeling4" placeholder="Criterium vier">
                <input type="submit" name="new_criterium_submit" class="btn btn-success" value="Versturen" style="border-radius: 0;">

                <input type="submit" name="sluiten" class="btn btn-success data-dismiss" value="Annuleren">
            </form>
            <script type="text/javascript">
                $(document).ready(function () {
                    $('#modalClose').click(function () {
                        window.setTimeout(function () {
                            $('#contact').modal('hide');
                        }, 5000);
                    });
                });
            </script>
            <!--EINDE CODE VOOR CRITERIUM TOEVOEGEN BACKEND -->
    </div>
</div>