<?php
session_start();
session_destroy();
unset($_SESSION);

$msg= filter_input(INPUT_GET, 'msg');
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Idêntifique-se</title>
        <?php include '../estrutura/head.php'; ?>
        <style>
            body {
                padding-top: 40px;
                padding-bottom: 40px;
                background-color: #303641;
                color: #C1C3C6
            }
        </style>
    </head>
    <body>
        <div class="container" style="margin-top: 5%">
            <form class="form-signin" role="form" method="POST" action="../../../Config/valida/valida.php">
        <?php if ($msg == '1') { ?>
            <div class="alert alert-danger alert-dismissable">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                <strong>Erro! </strong> Acesso Negado!.
            </div>
        <?php } ?>
                <center><h3 class="form-signin-heading">Login</h3></center>
                <div class="form-group">
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="glyphicon glyphicon-user"></i>
                        </div>
                        <input type="text" class="form-control" name="login" id="login" placeholder="Login" />
                    </div>
                </div>
                <div class="form-group">
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class=" glyphicon glyphicon-lock "></i>
                        </div>
                        <input type="password" class="form-control" name="senha" id="senha" placeholder="Senha"/>
                    </div>
                </div>
                <button class="btn btn-lg btn-primary btn-block" type="submit">Entrar</button>
            </form>

        </div>
        <div class="clearfix"></div>
        <br><br>
        <!--footer-->
    </body>
</html>
