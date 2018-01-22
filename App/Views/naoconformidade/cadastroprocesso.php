<?php
include_once '../../../Config/ConexaoPDO.php';
include_once '../../DAO/SetorDAO.php';
include_once '../../Model/Setor.php';
include_once '../../DAO/TipoNaoConformidadeDAO.php';
include_once '../../Model/TipoNaoConformidade.php';

include_once '../../DAO/NcProcessoDAO.php';
include_once '../../Model/NaoConformidade.php';

$ncdao = new NcProcessoDAO();
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
                        <div class="panel-heading" id="ncprocesso">
                            <h3 class="panel-title"><a id="a_modific" href="javascript:void(0);" class="toggle-sidebar"><span class="fa fa-angle-double-left" data-toggle="offcanvas" title="Esconder Menu"></span></a> NC - Processos</h3>
                        </div>
                        <div class="panel-body">
                            <form action="../../Controller/NcProcessoControll.php" method="POST">
                                <div class="content-row">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <h2 class="content-row-title">NC Processos - Cadastro</h2>
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <label>Cod. NC Processo</label>
                                                    <input type="text" class="form-control" readonly="" value="<?= $proximo_id->getId() + 1; ?>">
                                                    <input type="hidden" name="idfuncionario" value="<?= $id_funcionario ?>">
                                                    <input type="hidden" name="id" value="<?= $proximo_id->getId() + 1; ?>">
                                                </div>
                                                <div class="col-md-3">
                                                    <label>Data</label>
                                                    <input type="date" class="form-control" name="data" required="" value="<?= $data ?>">
                                                </div>

                                            </div>
                                            <br>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <label>Areá de Detecção</label>
                                                    <select class="form-control" required="" name="areadeteccao">
                                                        
                                                        <?php
                                                        $setoodao = new SetorDAO();
                                                        foreach ($setoodao->BuscarTodosSetores() as $setor) {
                                                            ?>
                                                            <option value="<?= $setor->getId() ?>"><?= $setor->getDescricao() ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                                <div class="col-md-4">
                                                    <label>Origem</label>
                                                    <select class="form-control" required="" name="origem">
                                                        <option value="">Selecione...</option>
                                                        <?php
                                                        $tiponcdao = new TipoNaoConformidadeDAO();
                                                        foreach ($tiponcdao->BuscarTodosNcProcesso() as $nc) {
                                                            ?>
                                                            <option value="<?= $nc->getId() ?>"><?= $nc->getDescricao() ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>

                                            </div>
                                            <br>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <label>Descrição da Não Conformidade</label>
                                                    <textarea rows="3" class="form-control" required="" name="descricaonc"></textarea>
                                                </div>                                       
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <label>Justificativa</label>
                                                    <textarea rows="3" class="form-control" required="" name="justificativa"></textarea>
                                                </div>                                       
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <label>Ação Executada</label>
                                                    <textarea rows="3" class="form-control" name="acaoexecutada"></textarea>
                                                </div>                                       
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label>Notificado(s)</label>
                                                    <input type="text" class="form-control" required="" name="notificados">
                                                </div>                                       
                                            </div>
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <label>Exige Ação Corretiva</label>
                                                    <select class="form-control" required="" name="acaocorretiva">
                                                        <option>Selecione...</option>
                                                        <option value="SIM">SIM</option>
                                                        <option value="NÃO">NÃO</option>
                                                    </select>


                                                </div>                                       
                                                <div class="col-md-3">
                                                    <label>Gravidade</label>
                                                    <select class="form-control" required="" name="gravidade">
                                                        <option>Selecione...</option>
                                                        <option value="ALTA">ALTA</option>
                                                        <option value="BAIXA">BAIXA</option>
                                                    </select>
                                                </div>                                       
                                                <div class="col-md-3">
                                                    <label>Situacao</label>
                                                    <select class="form-control" required="" name="situacao">                                                       
                                                        <option value="2">PENDENTE</option>
                                                        <option value="1">CONCLUIDO</option>
                                                    </select>
                                                </div>                                       
                                            </div>
                                            <a><button type="submit" name="gravar" class="btn btn-success">Gravar</button></a>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
