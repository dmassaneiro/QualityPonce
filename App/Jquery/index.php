<?php
session_start();
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
    <head>
        <title>Teste</title>
        <link rel="stylesheet" href="js/jquery-ui.css" />
        <script src="js/jquery-1.9.1.js"></script>
        <script src="js/jquery-ui.js"></script>

    </head>
    <body>

        <form >
            <p>
            <DIV class="col-md-5">
                <input type="text" class="form-control" id="esporte" onblur="validaCampoNome()"/>
            </div>
        </form>

        <script>
            $(function () {

                $("#esporte").autocomplete({
                    source: 'autoCompleteFornecedor.php'
                });
            });
        </script>
<!--        <script type="text/javascript">
            function validaCampoNome() {
                if ($("#esporte").val().trim() === "") {
                   
                    $("#esporte").css("border", "1px solid red");

                } else {
                    $("#esporte").css("border", "1px solid green");
                }
            }
        </script> -->
    </body>
</html>
