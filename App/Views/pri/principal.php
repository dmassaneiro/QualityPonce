<?php
include_once '../../AutoLoad/AutoLoad.php';
$dt = date("Y-m-d");

$fdao = new FichaTecnicaDAO();
$f = new FichaTecnica();

foreach ($fdao->VerificaData2($dt) as $ficha) {
    $f->setId($ficha->getId());
    $f->setStatusId(3);

    $fdao->Cancela($f);
}

$i = 0;
foreach ($fdao->VerificaData($dt) as $ix) {
    $i++;
}

///////
$idao = new InstrumentoDAO();
$teste = $idao->VerificaValidade($dt);

//////
$adao = new AuditoriaDAO();
$aa = new Auditoria();
$teste2 = $adao->VerificaData($dt);
foreach ($adao->VerificaData2($dt) as $aud) {
    $aa->setId($aud->getId());
    $aa->setSituacao("C");

    $adao->Cancela($aa);
}
/////
$tdao = new TreinamentoDAO();
$t = new Treinamento();
$teste3 = $tdao->VerificaData($dt);
foreach ($tdao->VerificaData2($dt) as $tre) {
    $t->setId($tre->getId());
    $t->setStatusId(3);

    $tdao->Cancela($t);
}
///

$ddo = new DocumentoDAO();
$doc = $ddo->VerificaValidade($dt);
?>

<!DOCTYPE html>
<html>
    <head>

        <title>Quality Ponce</title>
        <?php include '../estrutura/head.php'; ?>
    </head>
    <body>
        <?php include '../estrutura/menu.php'; ?>
        <!--header-->
        <div class="container-fluid">
            <!--documents-->
            <div class="row row-offcanvas row-offcanvas-left">
                <?php include '../estrutura/menulateral.php'; ?>
                <div class="col-xs-12 col-sm-9 content">
                    <?php include '../estrutura/mensagens.php'; ?>
                     <?php if ($i != null) { ?>
                        <div class="alert alert-warning alert-dismissable">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                            <strong>ATENÇÃO! </strong>  Você possui <b>Ficha Técnica</b> Pendente à Vencer! <a href="../fichatecnica/inicio.php?ver=2" class="alert-link">VERIFICAR</a>
                        </div>
                        <?php
                    } else {
                        
                    }
                    ?>
                        <?php if ($teste->getId() != null) { ?>
                        <div class="alert alert-warning alert-dismissable">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                            <strong>ATENÇÃO! </strong>  Você possui <b>Instrumentos</b> Ativos Vencidos! <a href="../cadastros/Instrumentos.php" class="alert-link">VERIFICAR</a>
                        </div>
                    <?php } ?>
                     <?php if ($teste2->getId() != null) {                  
                        ?>
                        <div class="alert alert-warning alert-dismissable">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                            <strong>ATENÇÃO! </strong>  Você possui <b>Auditorias</b> Abertas à Vencer! <a href="../auditoria/inicio.php?ver=2" class="alert-link">VERIFICAR</a>
                        </div>
                    <?php } ?>
                    <?php if ($teste3->getId() != null) {
                        ?>
                        <div class="alert alert-warning alert-dismissable">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                            <strong>ATENÇÃO! </strong>  Você possui <b>Treinamento</b> Pendente à Vencer! <a href="../treinamento/inicio.php?ver=2" class="alert-link">VERIFICAR</a>
                        </div>
                    <?php } ?>
                    <?php if ($doc->getId() != null) {
                        ?>
                        <div class="alert alert-warning alert-dismissable">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                            <strong>ATENÇÃO! </strong>  Você possui <b>Documentos</b> Vencidos! <a href="../documentos/inicio.php?ver=2" class="alert-link">VERIFICAR</a>
                        </div>
                    <?php } ?>
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title"><a id="a_modific" href="javascript:void(0);" class="toggle-sidebar"><span class="fa fa-angle-double-left" data-toggle="offcanvas" title="Esconder Menu"></span></a> Página Principal</h3>
                        </div>
                        <div class="panel-body">
                            <div class="content-row">
                                <div>
                                    <center><img src="../../../img/logo1.png" width="65%"></center>
                                </div>

                                <br>
                                <br>
                                <br>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
