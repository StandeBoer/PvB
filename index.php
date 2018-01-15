<html>
    <head>
        <meta charset="UTF-8">
        <title>MiniProeve</title>
        <link type="text/css" rel="stylesheet" media="screen,projection" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.5/css/materialize.min.css" />
        <link type="text/css" rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
        <link type="text/css" rel="stylesheet" href="stylesheet.css">
        <style>
            textArea{
                min-height: 500px;
            }
        </style>

    </head>
    <body class="achtergrond"> 
        <?php
        include("check.php");
        include("connect.php");
        include("navbar.php");
        include("ModalAddStudent.php");
        include("ModalAddKerntaak.php");
        include("ModalAddWerkproces.php");
        include("ModalAddCriterium.php");
        ?>
        <div class="row">
            <div class="col s12 m4 l3 sidebar">
                <h2>Welkom</h2>
                <?php
                $get_name = "SELECT user_first_name, user_last_name FROM users WHERE user_emailadres = '" . $_SESSION['email'] . "'";
                $result_get_name = $conn->query($get_name);
                if ($result_get_name->num_rows > 0) {
                    while ($row_get_name = $result_get_name->fetch_assoc()) {
                        ?>
                        <h4><?php echo $row_get_name['user_first_name'] . ' ' . $row_get_name['user_last_name']; ?></h4>    
                        <?php
                    }
                } else {
                    echo 'Not logged in';
                }
                ?>
                <!--         Button voor de modal voor het toevoegen van een student -->
                <ul class="collection">
                    <li class="collection-item"><button data-target="ModalAddStudent" class="btn modal-trigger" style="width:250px">Student Toevoegen</button></li>
                    <li class="collection-item"><button data-target="ModalAddKerntaak" class="btn modal-trigger" style="width:250px">Kerntaak Toevoegen</button></li>
                    <li class="collection-item"><button data-target="ModalAddWerkproces" class="btn modal-trigger" style="width:250px">Werkproces Toevoegen</button></li>
                    <li class="collection-item"><button data-target="ModalAddCriterium" class="btn modal-trigger" style="width:250px">Criterium Toevoegen</button></li>
                </ul>
            </div>
            <div class="col s12 m8 l9">

            </div>
        </div>
        <!--EINDE CODE VOOR KLAS TOEVOEGEN BACKEND -->
        <script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.5/js/materialize.min.js"></script>
        <script type="text/javascript">
            $(document).ready(function () {
                // the "href" attribute of .modal-trigger must specify the modal ID that wants to be triggered
                $(".modal-trigger").leanModal();
                $("select").material_select();
                $(".button-collapse").sideNav();

                // Edit criteria
                $("button[name=EditCriterium]").on('click', function () {
                    // waarde van het geselecteerde id ophalen
                    id_criterium = $(this).data("id");
                    //alert(id_criterium);

                    // Velden leeg maken
                    document.getElementById("criterium_id").value = "";
                    document.getElementById("criterium_naam").value = "";

                    // ophalen van informatie, met ajax om naam/omschrijving kerntaak op te halen
                    $.ajax({
                        type: 'GET',
                        url: 'json_edit_criterium.php',
                        data: {id: id_criterium},
                        dataType: 'json',
                        success: function (data) {
                            //console.log(data);
                            $("#criterium_id").val(data.id);
                            $("#criterium_naam").val(data.name);
                            $("#criterium_naam").removeClass("hide");
                        },
                    });
                });

                // Delete criteria
                $("button[name=DeleteCriterium]").click(function (event) {
                    event.preventDefault();
                    // ophalen van het id
                    var werkproces_criterium_id = $(this).data("id");

                    // link aanpassen
                    $("#delhref").attr("href", "delete_criterium.php?id=" + werkproces_criterium_id);
                });

                // Add criteria
                $("select[name=kerntaak_criterium_option]").on('change', function () {
                    // waarde van geslecteerde id ophalen
                    kt = this.value;
                    //alert(kt);

                    // Alles leeg maken:
                    $("select[name=werkproces_criterium_option]").empty().append($('<option>', {
                        value: 0,
                        text: "Kies een werkproces",
                    }));
                    // ophalen van informatie, met ajax
                    $.ajax({
                        type: 'GET',
                        url: 'json_add_criterium.php',
                        data: {id: kt},
                        dataType: 'json',
                        success: function (data) {
                            //alert(data);
                            $.each(data, function (index, element) {
                                //console.log(element.name);
                                $("select[name=werkproces_criterium_option]").append($('<option>', {
                                    value: element.id,
                                    text: element.name
                                }));
                            });
                            // toepassen css
                            // ** material only! **
                            $("select[name=werkproces_criterium_option]").material_select();
                            // als alles is opgehaald. Select weer laten zien.
                            //$("select[name=werkproces]").show();
                            $("select[name=werkproces_criterium_option]").closest('.select-wrapper').removeClass("hide");
                        }
                    });
                });
                $("select[name=werkproces_criterium_option]").on('change', function () {
                    $("input[name=criterium_oms]").removeClass("hide");
                    $("button[name=new_criterium_submit]").removeClass("hide");
                });

                //Student toevoegen modal klas afhankelijk van cohort
                $("select[name=cohort_option]").on('change', function () {
                    modal_cohort_id = this.value;
                    //alert(modal_cohort_id);

                    $("select[name=klas_option]").empty().append($('<option>', {
                        value: 0,
                        text: "Kies een klas",
                    }));

                    // ophalen van informatie, met ajax
                    $.ajax({
                        type: 'GET',
                        url: 'json_show_klas.php',
                        data: {id: modal_cohort_id},
                        dataType: 'json',
                        success: function (data) {
                            //console.log(data);
                            $.each(data, function (index, element) {
                                //console.log(element.klas_name);
                                $("select[name=klas_option]").append($('<option>', {
                                    value: element.klas_id,
                                    text: element.klas_name
                                }));
                            });
                            $("select[name=klas_option]").removeClass("hide");
                            $("select[name=klas_option]").material_select();
                        }
                    });

                }); F
            });
        </script>
    </body>
</html>