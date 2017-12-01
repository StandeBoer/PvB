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
        include("ModalAddKerntaak.php");
        include("ModalEditKerntaak.php");
        include("ModalDeleteKerntaak.php");
        ?>
        <div class="row" style="margin-bottom: auto;">
            <div class="col s12 m4 l3" style="background-color: gray; height: 100%;"></div>
            <div class="col s12 m8 l9" margin="0 auto">
                <h4>Overzicht kerntaken <a data-target="ModalAddKerntaak" class="btn-floating btn-small waves-effect waves-light green btn modal-trigger"><i class="material-icons" >add</i></a></h5>
                <table>
                    <thead>
                        <tr>
                            <th>Naam</th>
                            <th>Omschrijving</th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $get_kerntaak_inhoud = "SELECT * FROM kerntaak";
                        $result_get_kerntaak_inhoud = $conn->query($get_kerntaak_inhoud);
                        if ($result_get_kerntaak_inhoud->num_rows > 0) {
                            while ($row_get_kerntaak_inhoud = $result_get_kerntaak_inhoud->fetch_assoc()) {
                                ?>
                                <tr>
                                    <td><?php echo $row_get_kerntaak_inhoud['kerntaak_naam']; ?></td>
                                    <td><?php echo $row_get_kerntaak_inhoud['kerntaak_omschrijving']; ?></td>
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
