<?php
include '../../../Config/valida/session.php';
include_once '../../../Config/ConexaoPDO.php';
include_once '../../DAO/UsuarioDAO.php';
include_once '../../Model/Funcionario.php';

$id_user = $_SESSION['user_id'];
$id_funcionario = $_SESSION['funcionario_id'];
$id_permissao = $_SESSION['permissao_id'];

$msg = filter_input(INPUT_GET, 'msg');

$data_formatada = date('d/m/Y');
$data_banco = date('Y-m-d');
       
$usudao = new UsuarioDAO();
$nm_user = $usudao->BuscarNomeFuncionario($id_funcionario);
$nome_usuario_ativo = strtoupper($nm_user->getNome());

?>
<!--nav-->
<nav role="navigation" class="navbar navbar-custom">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header" >
            <button data-target="#bs-content-row-navbar-collapse-5" data-toggle="collapse" class="navbar-toggle" type="button">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a href="../pri/principal.php" class="navbar-brand" style="color: white;font-size: 26px">
                Quality Ponce
                <!--<img class="img-responsive" src="../../../img/logo1.png" width="120px" style="margin-top: 25px" >-->
            </a>
        </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div id="bs-content-row-navbar-collapse-5" class="collapse navbar-collapse">
            <ul class="nav navbar-nav navbar-right">
                <li class="active"><a href=""><i class="fa fa-calendar fa-lg"></i> <?=$data_formatada?></a></li>
                <li class="active"><a href=""><i class="fa fa-user fa-lg"></i> <?= $nome_usuario_ativo?></a></li>
                <li class="active"><a href="../pri/login.php"><i class="fa fa-sign-out fa-lg "></i> Sair</a></li>
                
            </ul>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>