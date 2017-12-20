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
        include("ModalAddNormering.php");
        include("ModalEditNormering.php");
        include("ModalDeleteNormering.php");
        ?>
        <div class="row" style="margin-bottom: auto;">
            <div class="col s12 m4 l3 sidebar">
                <br />
                <?php
                $get_kerntaak = "SELECT * FROM kerntaak";
                $result_kerntaak = $conn->query($get_kerntaak);
                if ($result_kerntaak->num_rows > 0) {
                    ?>
                    <select name="selected_kerntaak" required>
                        <option selected="selected" disabled>Kies een kerntaak</option>
                        <?php
                        while ($row_kerntaak = $result_kerntaak->fetch_assoc()) {
                            ?>
                            <option value="<?php echo $row_kerntaak["kerntaak_id"] ?>"><?php echo $row_kerntaak["kerntaak_naam"] ?></option>
                            <?php
                        }
                        ?>
                    </select>
                    <?php
                }
                ?>
                <select name="selected_werkproces" class="hide">

                </select>
                <select name="selected_criteria" class="hide">

                </select><br />
            </div>
            <div class="col s12 m8 l9">
                <h4>Overzicht normeringen <a data-target="ModalAddNormering" class="btn-floating btn-small waves-effect waves-light green btn modal-trigger"><i class="material-icons" >add</i></a></h4>
                <table id="show_normering" class="hide">
                    <thead>
                        <tr>
                            <th>Normering</th>
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
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.5/js/materialize.min.js"></script>
        <script type="text/javascript">
            $(document).ready(function () {
                // the "href" attribute of .modal-trigger must specify the modal ID that wants to be triggered
                $(".modal-trigger").leanModal();
                $("select").material_select();
                $(".button-collapse").sideNav();

                //Show criterium
                $("select[name=selected_kerntaak]").on('change', function () {
                    // waarde van geslecteerde id ophalen
                    kerntaak_id = this.value;
                    //alert(kerntaak_id);

                    // Alles leeg maken:
                    $("select[name=selected_werkproces]").empty().append($('<option>', {
                        value: 0,
                        text: "Kies een werkproces",
                    }));

                    $("select[name=selected_criteria]").empty().append($('<option>', {
                        value: 0,
                        text: "Kies een werkproces",
                    }));

                    // ophalen van informatie, met ajax
                    $.ajax({
                        type: 'GET',
                        url: 'json_show_werkproces.php',
                        data: {id: kerntaak_id},
                        dataType: 'json',
                        success: function (data) {
                            //alert(data);
                            $.each(data, function (index, element) {
                                //console.log(element.name);
                                $("select[name=selected_werkproces]").append($('<option>', {
                                    value: element.id,
                                    text: element.name
                                }));
                            });
                            // toepassen css
                            // ** material only! **
                            $("select[name=selected_werkproces]").material_select();
                            $("select[name=selected_criteria]").material_select();
                            // als alles is opgehaald. Select weer laten zien.
                            $("select[name=selected_werkproces]").closest('.select-wrapper').removeClass("hide");
                        }
                    });
                });

                $("select[name=selected_werkproces]").on("change", function () {
                    werkproces_id = this.value;
                    //alert(werkproces_id);

                    // Alles leeg maken:
                    $("select[name=selected_criteria]").empty().append($('<option>', {
                        value: 0,
                        text: "Kies een criteria"
                    }));

                    // Ophalen informatie met Ajax
                    $.ajax({
                        type: 'GET',
                        url: 'json_show_criterium.php',
                        data: {id: werkproces_id},
                        dataType: 'json',
                        success: function (data) {
                            $.each(data, function (index, element) {
                                //console.log(element.criterium_id, element.criterium_naam);
                                $("select[name=selected_criteria]").append($('<option>', {
                                    value: element.criterium_id,
                                    text: element.criterium_naam
                                }));
                            });
                            $("select[name=selected_criteria]").material_select();
                            //$("select[name=selected_criteria]").show();
                            $("select[name=selected_criteria]").closest('.select-wrapper').removeClass("hide");
                        }
                    });
                });

                $("select[name=selected_criteria]").on("change", function () {
                    criteria_id = this.value;
                    //alert(criteria_id);

                    // Table overzicht leegmaken voordat er nieuwe data ingeladen wordt.
                    $("tbody[name=tbody]").empty();

                    // Ophalen informatie met Ajax
                    $.ajax({
                        type: 'GET',
                        url: 'json_show_normering.php',
                        data: {id: criteria_id},
                        dataType: 'json',
                        success: function (data) {
                            //console.log(data);
                            $.each(data, function (index, element) {
                                //console.log(element.criterium_id, element.criterium_naam);
                                $("#show_normering").find('tbody')
                                        .append($('<tr>', {id: element.criterium_normering_id}
                                        ).append($('<td>', {
                                            text: element.criterium_normering_name},
                                                )).append($(
                                                '<td><button data-target="ModalEditNormering" class="EditNormering btn-floating btn-large waves-effect waves-light yellow btn modal-trigger"><i class="material-icons" >edit</i></button>'
                                                )).append($(
                                                '<td><button data-target="ModalDeleteNormering" class="DeleteNormering btn-floating btn-large waves-effect waves-light red btn modal-trigger"><i class="material-icons">delete</i></button>'
                                                ))

                                                );
                                //$("select[name=criteria]").material_select();
                                //$("select[name=selected_criteria]").show();
                                $("table[id=show_normering]").removeClass("hide");
                                $(".modal-trigger").leanModal();
                            });
                            // Edit normering
                            $(".EditNormering").on('click', function () {
                                // waarde van het geselecteerde id ophalen
                                id_normering = $(this).parent().parent().attr('id');
                                //alert(id_normering);

                                // Velden leeg maken
                                document.getElementById("normering_id").value = "";
                                document.getElementById("normering_naam").value = "";

                                // ophalen van informatie, met ajax om naam/omschrijving kerntaak op te halen
                                $.ajax({
                                    type: 'GET',
                                    url: 'json_edit_normering.php',
                                    data: {id: id_normering},
                                    dataType: 'json',
                                    success: function (data) {
                                        //console.log(data);
                                        $("#normering_id").val(data.id);
                                        $("#normering_naam").val(data.name);
                                        $("#normering_naam").removeClass("hide");
                                    },
                                });
                            });

                            //DELETE normering
                            $(".DeleteNormering").on('click', function () {
                                // ophalen van het id
                                var criterium_normering_id = $(this).parent().parent().attr('id');
                                //console.log(werkproces_criterium_id);

                                // link aanpassen
                                $("#delhref").attr("href", "delete_normering.php?id=" + criterium_normering_id);
                            });


                        }
                    });
                });

                // Add normering
                $("select[name=kerntaak_option]").on('change', function () {
                    // waarde van geslecteerde id ophalen
                    kt = this.value;
                    //alert(kt);

                    // Alles leeg maken:
                    $("select[name=werkproces_option]").empty().append($('<option>', {
                        value: 0,
                        text: "Kies een werkproces",
                    }));
                    $("select[name=criterium_option]").empty().append($('<option>', {
                        value: 0,
                        text: "Kies een criterium",
                    }));

                    // ophalen van informatie, met ajax
                    $.ajax({
                        type: 'GET',
                        url: 'json_show_werkproces.php',
                        data: {id: kt},
                        dataType: 'json',
                        success: function (data) {
                            //alert(data);
                            $.each(data, function (index, element) {
                                //console.log(element.name);
                                $("select[name=werkproces_option]").append($('<option>', {
                                    value: element.id,
                                    text: element.name
                                }));
                            });
                            // toepassen css
                            // ** material only! **
                            $("select[name=werkproces_option]").material_select();
                            $("select[name=criterium_option]").material_select();
                            // als alles is opgehaald. Select weer laten zien.
                            //$("select[name=werkproces]").show();
                            $("select[name=werkproces_option]").closest('.select-wrapper').removeClass("hide");
//                            $("select[name=criterium_option]").closest('.select-wrapper').removeClass("hide");
                        }
                    });
                });

                $("select[name=werkproces_option]").on('change', function () {
                    // waarde van geslecteerde id ophalen
                    wp = this.value;
                    //alert(kt);

                    $("select[name=criterium_option]").empty().append($('<option>', {
                        value: 0,
                        text: "Kies een criterium",
                    }));

                    // ophalen van informatie, met ajax
                    $.ajax({
                        type: 'GET',
                        url: 'json_show_criterium.php',
                        data: {id: wp},
                        dataType: 'json',
                        success: function (data) {
                            //alert(data);
                            $.each(data, function (index, element) {
                                //console.log(element.name);
                                $("select[name=criterium_option]").append($('<option>', {
                                    value: element.criterium_id,
                                    text: element.criterium_naam
                                }));
                            });
                            // toepassen css
                            // ** material only! **
                            $("select[name=criterium_option]").material_select();
                            // als alles is opgehaald. Select weer laten zien.
                            //$("select[name=werkproces]").show();
                            //$("select[name=werkproces_option]").closest('.select-wrapper').removeClass("hide");
                            $("select[name=criterium_option]").closest('.select-wrapper').removeClass("hide");
                        }
                    });
                });
                
                $("select[name=criterium_option]").on('change', function () {
                    $("input[name=normering_naam]").removeClass("hide");
                    $("button[name=new_normering_submit]").removeClass("hide");
                });

            });
        </script>
    </body>
</html>
