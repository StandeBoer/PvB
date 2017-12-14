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
        include("ModalAddStudent.php");
        include("ModalEditStudent.php");
        include("ModalDeleteStudent.php");
        ?>
        <div class="row" style="margin-bottom: auto;">
            <div class="col s12 m4 l3" style="background-color: gray; height: 100%;">
                <br>
                <?php
                $get_cohort = "SELECT * FROM cohort";
                $result_cohort = $conn->query($get_cohort);
                if ($result_cohort->num_rows > 0) {
                    ?>
                    <select name="selected_cohort" required>
                        <option selected="selected" disabled>Kies een cohort</option>
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
                <select name="selected_klas" class="hide">

                </select>
            </div>
            <div class="col s12 m8 l9">
                <h4>Overzicht studenten <a data-target="ModalAddStudent" class="btn-floating btn-small waves-effect waves-light green btn modal-trigger"><i class="material-icons" >add</i></a></h5>
                    <table id="show_student" class="">
                        <thead>
                            <tr>
                                <th>Studentnaam</th>
                                <th>Emailadres</th>
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
        <script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.5/js/materialize.min.js"></script>
        <script type="text/javascript">
            $(document).ready(function () {
                // the "href" attribute of .modal-trigger must specify the modal ID that wants to be triggered
                $('.modal-trigger').leanModal();
                $('select').material_select();
                $(".button-collapse").sideNav();

                $("select[name=selected_cohort]").on('change', function () {
                    cohort_id = this.value;
                    //alert(cohort_id);

                    $("select[name=selected_klas]").empty().append($('<option>', {
                        value: 0,
                        text: "Kies een klas",
                    }));

                    // ophalen van informatie, met ajax
                    $.ajax({
                        type: 'GET',
                        url: 'json_show_klas.php',
                        data: {id: cohort_id},
                        dataType: 'json',
                        success: function (data) {
                            //alert(data);
                            $("select[name=selected_klas]").removeClass("hide");
                            $.each(data, function (index, element) {
                                //console.log(element.name);
                                $("select[name=selected_klas]").append($('<option>', {
                                    value: element.klas_id,
                                    text: element.klas_name
                                }));
                            });
                            $("select[name=selected_klas]").material_select();
                            
                        }
                    });
                });

                $("select[name=selected_klas]").on('change', function () {
                    klas_id = this.value;
                    //alert(klas_id);
                    
                    $("tbody[name=tbody]").empty();

                    // ophalen van informatie, met ajax
                    $.ajax({
                        type: 'GET',
                        url: 'json_show_student.php',
                        data: {id: klas_id},
                        dataType: 'json',
                        success: function (data) {
                            //alert(data);
                            $.each(data, function (index, element) {
                                $("#show_student").find('tbody')
                                        .append($('<tr>'
                                                ).append($('<td>', {
                                            text: element.student_name}
                                        )).append($('<td>', {
                                            text:element.student_email}
                                        )).append($(
                                                '<td><button data-target="ModalEditWerkproces" name="EditWerkproces" class="btn-floating btn-large waves-effect waves-light yellow btn modal-trigger"><i class="material-icons" >edit</i></button>', {
                                                    value: element.id
                                                }
                                        )).append($(
                                                '<td><button data-target="ModalDeleteWerkproces" name="DeleteWerkproces" class="btn-floating btn-large waves-effect waves-light red btn modal-trigger"><i class="material-icons">delete</i></button>', {
                                                    value: element.id,
                                                }
                                        ))

                                                );
                                //$('#show_klas').append($('<td>', {value: element.klas_id, text: element.name}, '</td>'));
                                $("#show_klas").removeClass("hide");
                            });
                        }
                    });

                });

                // Edit button
                $("button[name=EditStudent]").on('click', function () {
                    // waarde van het geselecteerde id ophalen
                    id_student = $(this).data("id");
                    //alert(id_student);

                    // Velden leeg maken
                    document.getElementById("student_id").value = "";
                    document.getElementById("student_naam").value = "";
                    document.getElementById("student_email").value = "";

                    // ophalen van informatie, met ajax om naam/omschrijving kerntaak op te halen
                    $.ajax({
                        type: 'GET',
                        url: 'json_edit_student.php',
                        data: {id: id_student},
                        dataType: 'json',
                        success: function (data) {
                            $("#student_id").val(data.id);
                            $("#student_naam").val(data.name);
                            $("#student_naam").removeClass("hide");
                            $("#student_email").val(data.email);
                            $("#student_email").removeClass("hide");
                        },
                        error: function () {
                            console.log('error');
                        }
                    });
                });

                // DELETE BUTTON
                $("button[name=DeleteStudent]").click(function (event) {
                    event.preventDefault();
                    // ophalen van het id
                    var student_id = $(this).data("id");
                    // link aanpassen
                    $("#delhref").attr("href", "delete_student.php?id=" + student_id);
                });
            });
        </script>
    </body>
</html>
