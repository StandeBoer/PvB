<div id="ModalAddCriterium" class="modal" style="height:100%">
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
            <label>Om een criterium toe te voegen selecteerd u eerst de kerntaak en daarna het werkproces:</label>
            <br>
            <select name="kerntaak_criterium_option" required>
                <option selected="selected" value="0" disabled>Kies een kerntaak</option>
                <?php
                while ($row_kerntaak_criterium = $result_kerntaak_criterium->fetch_assoc()) {
                    ?>
                    <option value="<?php echo $row_kerntaak_criterium["kerntaak_id"] ?>"><?php echo $row_kerntaak_criterium['kerntaak_id'] . ' - ' . $row_kerntaak_criterium["kerntaak_naam"] ?></option>
                    <?php
                }
                ?>
            </select>
            <select name="werkproces_criterium_option" class="hide">
                <option value="0">-</option>
            </select>
            <?php
        }
        ?>
        <!--EINDE CODE VOOR CRITERIUM TOEVOEGEN BACKEND -->
        <script type = "text/javascript">
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