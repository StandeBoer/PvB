<html>
    <head>
        <meta charset="UTF-8">
        <title>MiniProeve</title>
        <link type="text/css" rel="stylesheet" href="stylesheet.css">
        <link type="text/css" rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
        <link type="text/css" rel="stylesheet" media="screen,projection" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.5/css/materialize.min.css" />
    </head>
    <body> 
        <?php
        include("check.php");
        include("connect.php");
        include("navbar.php");
        include("modalAddStudent.php");
        include("ModalAddKerntaak.php");
        include("ModalAddWerkproces.php");
        include("ModalAddCriterium.php");
        include("ModalDeleteKerntaak.php");
        include("ModalEditKerntaak.php");
        ?>
        <div class="row">
            <div class="col s12 m4 l3" style="background-color: gray; height: 100%;">
                <br>
                <!-- Dropdown  -->
                <a class='dropdown-button btn' href='#' data-activates='dropdown1'>Selecteer kerntaak</a>
                <ul id='dropdown1' class='dropdown-content'>
                    <li><a href="#!"></a></li>
                    <li>Levert bijdrage ontwikkeltraject</li>
                    <li>Realiseert en test onderdelen</li>
                    <li>Levert product op</li>
                </ul><br><br>
                <!-- Dropdown -->
                <a class='dropdown-button btn' href='#' data-activates='dropdown1'>Selecteer werkproces</a>
                <ul id='dropdown1' class='dropdown-content'>
                    <li><a href="#!"></a></li>
                    <li>Stel de opdracht</li>
                    <li>Levert bijdrage projectplan</li>
                    <li>Levert bijdrage onderwerp</li>
                    <li>Bereidt realisatie voor</li>
                    <li>Realiseert product</li>
                    <li>Test het ontwikkelde product</li>
                    <li>Optimaliseer dit product</li>
                    <li>Levert product op</li>
                    <li>Evalueert opgeleverde product</li>
                </ul>
            </div>
            <div class="col s12 m8 l9">
               <h5>Overzicht criteria <a data-target="ModalAddCriterium" class="btn-floating btn-large waves-effect waves-light green btn modal-trigger"><i class="material-icons" >add</i></a></h5>
                <table>
                    <thead>
                        <tr>
                            <th>Kerntaak</th>
                            <th>Naam</th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $get_werkproces_criterium_inhoud = "SELECT * FROM kerntaak";
                        $result_get_werkproces_criterium_inhoud = $conn->query($get_werkproces_criterium_inhoud);
                        if ($result_get_werkproces_criterium_inhoud->num_rows > 0) {
                            while ($row_get_werkproces_criterium_inhoud = $result_get_werkproces_criterium_inhoud->fetch_assoc()) {
                                ?>
                                <tr>
                                    <td><?php echo $row_get_werkproces_criterium_inhoud['kerntaak_naam']; ?></td>
                                    <td><?php echo $row_get_werkproces_criterium_inhoud['kerntaak_omschrijving']; ?></td>
                                    <td><a data-target="ModalEditKerntaak" class="btn-floating btn-large waves-effect waves-light yellow btn modal-trigger"><i class="material-icons" >edit</i></a></td>
                                    <td><a data-target="ModalDeleteKerntaak" class="btn-floating btn-large waves-effect waves-light red btn modal-trigger"><i class="material-icons">delete</i></a></td>
                                <tr>
                                    <?php
                                }
                            } else {
                                echo '0 results';
                            }
                            ?>
                    </tbody>
                </table>
            </div>
        </div>
        <!--EINDE CODE VOOR KLAS TOEVOEGEN BACKEND -->
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.5/js/materialize.min.js"></script>
        <script type="text/javascript">
            $(document).ready(function () {
                // the "href" attribute of .modal-trigger must specify the modal ID that wants to be triggered
                $('.modal-trigger').leanModal();
                $('select').material_select();
            });
        </script>
    </body>
</html>
