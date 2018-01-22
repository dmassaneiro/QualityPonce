<?php
include_once '../../../Config/ConexaoPDO.php';
include_once '../../DAO/SetorDAO.php';
include_once '../../Model/Setor.php';
include_once '../../DAO/TipoNaoConformidadeProdutoDAO.php';
include_once '../../Model/TipoNaoConformidadeProduto.php';

include_once '../../DAO/NcProdutoDAO.php';
include_once '../../Model/NaoConformidadeProduto.php';

$ncdao = new NcProdutoDAO();
$setordao = new SetorDAO();
$tipodencdao = new TipoNaoConformidadeProdutoDAO();

$id_nc_processo = filter_input(INPUT_GET, 'id');

$dados = $ncdao->BuscarRegistroParaEditar($id_nc_processo);
//$nome_setor = $setordao->BuscarNomeSetor($dados->getSetorId());
$nome_tipo_nc = $tipodencdao->BuscarNomeNC($dados->getTipoNaoConformidadeProdutoId());

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
                                                    <input type="text" class="form-control" value="<?= $dados->getId()?>"readonly="">
                                                    <input type="hidden" name="idfuncionario" value="<?= $id_funcionario ?>">
                                                    <input type="hidden" name="id" value="<?= $dados->getId() ?>">
                                                   
                                                </div>
                                                <div class="col-md-3">
                                                    <label>Data</label>
                                                    <input type="date" name="data" class="form-control" required="" value="<?=$dados->getDataEmissao()?>">
                                                </div>
                                                <div class="col-md-3">
                                                    <label>Tp. Não Conformidade</label>
                                                    <select class="form-control" name="tiponc" required="">
                                                        <option value="<?=$dados->getTipoNaoConformidadeProdutoId()?>"><?=$nome_tipo_nc->getDescricao()?></option>
                                                        <?php
                                                        foreach ($tipodencdao->BuscarTodosNcProcessoMenos($dados->getTipoNaoConformidadeProdutoId()) as $nc) {
                                                            ?>
                                                            <option value="<?= $nc->getId() ?>"><?= $nc->getDescricao() ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                                <div class="col-md-3">
                                                    <label>N° Controle Interno</label>
                                                    <input type="text" class="form-control" name="controle" required="" value="<?=$dados->getControle()?>">
                                                </div>
                                            </div>
                                            <br>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <label>Descrição da Não Conformidade</label>
                                                    <textarea rows="3" class="form-control" name="descricao" required=""><?=strip_tags($dados->getDescricao())?></textarea>
                                                </div>                                       
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <label>Ação Executada</label>
                                                    <textarea rows="2" class="form-control" name="acaoexecutada" required=""><?=strip_tags($dados->getAcaoExecutada())?></textarea>
                                                </div>
                                                <div class="col-md-5">
                                                    <label>Responsável</label>
                                                    <input type="text" class="form-control" name="responsavel1" required="" value="<?=$dados->getResponsavel1()?>">
                                                </div>
                                            </div>
                                            <br>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <label>Destinação</label>
                                                    <textarea rows="2" class="form-control" name="destinacao" required=""><?=strip_tags($dados->getDestino())?></textarea>
                                                </div>
                                                <div class="col-md-5">
                                                    <label>Responsável</label>
                                                    <input type="text" class="form-control" name="responsavel2" required="" value="<?=$dados->getResponsavel2()?>">
                                                </div>
                                            </div>                                       
                                            <h4>Avaliação</h4>
                                            <hr>
                                            <div class="row">
                                                <div class="col-md-2">
                                                    <label>Investigar?</label>
                                                    <select class="form-control" required="" name="investigar">
                                                         <?php if ($dados->getInvestigar() == 'S') { ?>
                                                            <option value="SIM">SIM</option>
                                                            <option value="NÃO">NÃO</option>
                                                        <?php }if ($dados->getInvestigar() == 'N') { ?>
                                                            <option value="NÃO">NÃO</option>
                                                            <option value="SIM">SIM</option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                                <div class="col-md-6">
                                                    <label>Responsável</label>
                                                    <input type="text" class="form-control" name="responsavel3" required=""value="<?=$dados->getResponsavel3()?>">
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <label>Pessoas Notificadas</label>
                                                    <textarea rows="2" class="form-control" name="pessoasnotificadas" required=""><?=strip_tags($dados->getNotificados())?></textarea>
                                                </div>
                                            </div>
                                            <br>
                                            <a><button type="submit" name="edit" class="btn btn-success "> Gravar</button></a>
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
