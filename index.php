<?php
    require_once "Controller.php";
    require_once "UserController.php";
?>
<!doctype html>
<html>
    <head>
        <meta charset='utf-8'>
        <meta name='viewport' content='width=device-width, initial-scale=1'>
        <title>Un pendu en JS</title>
        <script src='https://code.jquery.com/jquery-1.12.4.js'></script>
        <script src='https://code.jquery.com/ui/1.12.1/jquery-ui.js'></script>
        <link rel='stylesheet' href='https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css'>
        <link rel='stylesheet' href='//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css'>
        <link rel='stylesheet' href='css.css'>
        <script src='https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js'></script>
		<script src='https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js'></script>
    </head>
    <body id='body'>
        <div class='container-fluid'>
            <div class='row'>
                <div class='col-12 text-center'>
                    <h1>Jeu du pendu en JS</h1>
                </div>
                <div class='col-12 marge text-center'>
                    <h3 id='nbVies'>Vies restantes : 10</h3>
                </div>
                <div class='col-12 text-center' id='timer'>5 : 00</div>
                <div class='col-12 text-center' id='affichage'>

                </div>
                <div class='col-12 text-center'>
                    <input type='text' name='lettre' id='reponse' autofocus>
                    <button id='tester'>Tester la lettre</button>
                </div>
                <div class='col-12 text-center' id='erreur'></div>
            </div>
        </div>
        <script src='js.js'></script>
    </body>
</html>