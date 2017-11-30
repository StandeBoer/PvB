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
        ?>
        <div class="row">
            <div class="col s3" style="background-color: grey; float: left; height: 100vh;">
                Hier moeten 2 lists komen
            </div>
            <div class="col s9">
                Col 2
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
                $(".button-collapse").sideNav();

            });
        </script>
    </body>
</html>
