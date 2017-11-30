<div id="ModalAddCriterium" class="modal" style="height:50vh">
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
                    <div id="Addcrit"></div>
                    <input type="submit" name="new_criterium_submit" class="btn btn-success" value="Versturen" style="border-radius: 0;">
                    <!--EINDE CODE VOOR CRITERIUM TOEVOEGEN BACKEND -->
                    <input type="submit" name="sluiten" class="btn btn-success data-dismiss" value="Annuleren">
                    </form>
                    <?php
                }
                ?>
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