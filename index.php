<?php
include("check.php");
include("modalAddStudent.php");
include("navbar.php");
?>


<html>
    <head>
        <meta charset="UTF-8">
        <title>MiniProeve</title>
        <link type="text/css" rel="stylesheet" href="stylesheet.css">
        <link type="text/css" rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
        <link type="text/css" rel="stylesheet" media="screen,projection" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.5/css/materialize.min.css" />
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.5/js/materialize.min.js"></script>
    </head>
    <body>
        <div class="sideMenu">
            <!--         Button voor de modal voor het toevoegen van een student -->
            <ul class="collection">
                <li class="collection-item"><button data-target="ModalAddStudent" class="btn modal-trigger">Add Student</button></li>
                <li class="collection-item"><button data-target="ModalAddStudent" class="btn modal-trigger">Add Student</button></li>
            </ul>
        </div>

        <script type="text/javascript">
            $(document).ready(function () {
                // the "href" attribute of .modal-trigger must specify the modal ID that wants to be triggered
                $('.modal-trigger').leanModal();
            });
        </script>
    </body>
</html>