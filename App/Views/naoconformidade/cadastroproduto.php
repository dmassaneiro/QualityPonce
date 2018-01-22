<?php
include_once '../../../Config/ConexaoPDO.php';
include_once '../../DAO/TipoNaoConformidadeProdutoDAO.php';
include_once '../../Model/TipoNaoConformidadeProduto.php';

include_once '../../DAO/NcProdutoDAO.php';
include_once '../../Model/NaoConformidadeProduto.php';

$ncdao = new NcProdutoDAO();
$tipoNc = new TipoNaoConformidadeProdutoDAO();

$proximo_id = $ncdao->BuscarUltimoRegistro();


$data = date('Y-m-d');
$msg = filter_input(INPUT_GET, 'msg');
?>


<!DOCTYPE html>
<html>
    <head>
        <title>NC - Processos</title>
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
                    <div class="panel panel-default">
                        <?php if ($msg == '1') { ?>
                            <div class="alert alert-danger alert-dismissable">
                                <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                                <strong>Erro! </strong> Preencha os Campos Obrigatorios.
                            </div>
                        <?php } ?>
                        <div class="panel-heading" id="ncproduto">
                            <h3 class="panel-title"><a id="a_modific" href="javascript:void(0);" class="toggle-sidebar"><span class="fa fa-angle-double-left" data-toggle="offcanvas" title="Esconder Menu"></span></a> NC - Produto</h3>
                        </div>
                        <div class="panel-body">
                            <div class="content-row">
                                <div class="row">
                                    <div class="col-md-12">
                                        <h2 class="content-row-title">NC Produtos - Cadastro</h2>
                                        <form action="../../Controller/NcProdutoControll.php" method="POST">
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <label>Cod. NC Produto</label>
                                                    <input type="text" class="form-control" value="<?= $proximo_id->getId() + 1 ?>"readonly="">
                                                    <input type="hidden" name="idfuncionario" value="<?= $id_funcionario ?>">
                                                    <input type="hidden" name="id" value="<?= $proximo_id->getId() + 1; ?>">
                                                </div>
                                                <div class="col-md-3">
                                                    <label>Data</label>
                                                    <input type="date" name="data" class="form-control" required="" value="<?= $data ?>">
                                                </div>
                                                <div class="col-md-3">
                                                    <label>Tp. Não Conformidade</label>
                                                    <select class="form-control" name="tiponc" required="">
                                                        <option value="">Selecione...</option>
                                                        <?php
                                                        foreach ($tipoNc->BuscarTodosNcProduto() as $nc) {
                                                            ?>
                                                            <option value="<?= $nc->getId() ?>"><?= $nc->getDescricao() ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                                <div class="col-md-3">
                                                    <label>N° Controle Interno</label>
                                                    <input type="text" class="form-control" name="controle" required="">
                                                </div>
                                            </div>
                                            <br>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <label>Descrição da Não Conformidade</label>
                                                    <textarea rows="3" class="form-control" name="descricao" required=""></textarea>
                                                </div>                                       
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <label>Ação Executada</label>
                                                    <textarea rows="2" class="form-control" name="acaoexecutada" required=""></textarea>
                                                </div>
                                                <div class="col-md-5">
                                                    <label>Responsável</label>
                                                    <input type="text" class="form-control" name="responsavel1" required="">
                                                </div>
                                            </div>
                                            <br>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <label>Destinação</label>
                                                    <textarea rows="2" class="form-control" name="destinacao" required=""></textarea>
                                                </div>
                                                <div class="col-md-5">
                                                    <label>Responsável</label>
                                                    <input type="text" class="form-control" name="responsavel2" required="">
                                                </div>
                                            </div>                                       
                                            <h4>Avaliação</h4>
                                            <hr>
                                            <div class="row">
                                                <div class="col-md-2">
                                                    <label>Investigar?</label>
                                                    <select class="form-control" required="" name="investigar">
                                                        <option>Selecione...</option>
                                                        <option value="S">SIM</option>
                                                        <option value="N">NÃO</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-6">
                                                    <label>Responsável</label>
                                                    <input type="text" class="form-control" name="responsavel3" required="">
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <label>Pessoas Notificadas</label>
                                                    <textarea rows="2" class="form-control" name="pessoasnotificadas" required=""></textarea>
                                                </div>
                                            </div>
                                            <br>
                                            <a><button type="submit" name="gravar" class="btn btn-success "> Gravar</button></a>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
