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
            </div>
            <div class="col s12 m8 l9">
                <h4>Studenten <a data-target="ModalAddStudent" class="btn-floating btn-small waves-effect waves-light green btn modal-trigger"><i class="material-icons" >add</i></a></h5>
                    <table>
                        <thead>
                            <tr>
                                <th>Naam</th>
                                <th>Emailadres</th>
                                <th></th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $get_student_inhoud = "SELECT * FROM student";
                            $result_get_student_inhoud = $conn->query($get_student_inhoud);
                            if ($result_get_student_inhoud->num_rows > 0) {
                                while ($row_get_student_inhoud = $result_get_student_inhoud->fetch_assoc()) {
                                    ?>
                                    <tr>
                                        <td><?php echo $row_get_student_inhoud['student_naam']; ?></td>
                                        <td><?php echo $row_get_student_inhoud['student_emailadres']; ?></td>
                                        <td><button data-id="<?php echo $row_get_student_inhoud['student_id']; ?>" data-target="ModalEditStudent" name="EditStudent" class="btn-floating btn-large waves-effect waves-light yellow btn modal-trigger"><i class="material-icons" >edit</i></button></td>
                                        <td><button data-id="<?php echo $row_get_student_inhoud['student_id']; ?>" data-target="ModalDeleteStudent" name="DeleteStudent" class="btn-floating btn-large waves-effect waves-light red btn modal-trigger"><i class="material-icons">delete</i></button></td>
                                    <tr>
                                        <?php
                                    }
                                } else {
                                    
                                }
                                ?>
                        </tbody>
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
                                        error: function(){
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
