<?php
include("check.php");
include("connect.php");
?>
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
        include("navbar.php");
        include("modalAddKlas.php");
        include("modalAddCohort.php");
        //include("ModalEditKlas.php");
        include("ModalDeleteKlas.php");
        include("ModalAddKerntaak.php");
        ?>
        <div class="row" style="margin-bottom: auto;">
            <div class="col s12 m4 l3 sidebar">
                <br>
                <button data-target="ModalAddCohort" class="btn modal-trigger" style="min-width: 200px;">Cohort Toevoegen</button>

                <?php
                $error = '';
                $get_cohort = "SELECT * FROM cohort";
                $result_cohort = $conn->query($get_cohort);
                if ($result_cohort->num_rows > 0) {
                    ?>
                    <select name="selected_cohort" required>
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
            </div>
            <div class="col s12 m8 l9">
                <h4>Overzicht klassen <a data-target="ModalAddKlas" class="btn-floating btn-small waves-effect waves-light green btn modal-trigger"><i class="material-icons" >add</i></a></h4>
                <table id="show_klas" class="hide">
                    <thead>
                        <tr>
                            <th>Klas</th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody name="tbody">

                    </tbody>
                </table>
            </div>
        </div>
        <!--EINDE CODE VOOR KLAS TOEVOEGEN BACKEND -->
        <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<!--        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>-->

        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.5/js/materialize.min.js"></script>
        <script type="text/javascript">

            $(document).on('click', '#DeleteKlasID', function(e) {
                alert("Delete clicked");
                e.preventDefault();

            })
            $(document).ready(function () {
                // the "href" attribute of .modal-trigger must specify the modal ID that wants to be triggered
                $(".modal-trigger").leanModal();
                $("select").material_select();
                $(".button-collapse").sideNav();



                $("select[name=selected_cohort]").on('change', function () {

                    cohort_id = this.value;
                    //alert(cohort_id);

                    //Leegmaken ingevulde shit komt hier
                    $("tbody[name=tbody]").empty();

                    // ophalen van informatie, met ajax
                    $.ajax({
                        type: 'GET',
                        url: 'json_show_klas.php',
                        data: {id: cohort_id},
                        dataType: 'json',
                        success: function (data) {
                            //alert(data);
                            $.each(data, function (index, element) {
                                $("#show_klas").find('tbody')
                                        .append($('<tr>'
                                                ).append($('<td>', {
                                            text: element.name},
                                        )).append($(
                                                '<td><button id="EditKlasID" data-target="ModalAddKerntaak" name="EditKlas" class="btn-floating btn-large waves-effect waves-light yellow btn modal-trigger"><i class="material-icons" >edit</i></button>'
                                        )).append($(
                                                '<td><button id="DeleteKlasID"  data-target="ModalDeleteKerntaak" name="DeleteKlas" class="btn-floating btn-large waves-effect waves-light red btn modal-trigger"><i class="material-icons">delete</i></button>'

                                        ))

                                                );
                                $(".modal-trigger").leanModal();

                                //$('#show_klas').append($('<td>', {value: element.klas_id, text: element.name}, '</td>'));
                                $("#show_klas").removeClass("hide");
                            });
                        }
                    });
                });
            });


//            function myScript() {
//                var kerntaak_id = $(this).val();
//                //alert(kerntaak_id);
//            }
        </script>
    </body>
</html>