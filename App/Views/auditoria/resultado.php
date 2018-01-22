<?php
include_once '../../AutoLoad/AutoLoad.php';

$id = filter_input(INPUT_GET, 'id');

$adao = new AuditoriaDAO();
$sdao = new SetorDAO();
$aqdao = new AuditoriaQuestaoDAO();
$iqdao = new ItemQuestionarioDAO();

$dados = $adao->BuscarRegistroParaEditar($id);
$nm_setor = $sdao->BuscarNomeSetor($dados->getSetorId());
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Auditoria</title>
        <?php include '../estrutura/head.php'; ?>
    </head>
    <body>
        <?php include '../estrutura/menu.php'; ?>
        <?php
        if ($id_permissao == 1 || $id_permissao == 6) {
            
        } else {
            header('Location: ../pri/principal.php?msg=12');
        }
        ?>
        <!--header-->
        <div class="container-fluid">
            <!--documents-->
            <div class="row row-offcanvas row-offcanvas-left">
                <?php include '../estrutura/menulateral.php'; ?>
                <div class="col-xs-12 col-sm-9 content">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title"><a href="javascript:void(0);" class="toggle-sidebar"><span class="fa fa-angle-double-left" data-toggle="offcanvas" title="Esconder Menu"></span></a> Auditorias/ Resultados</h3>
                        </div>
                        <div class="panel-body">
                            <div class="content-row">
                                <div class="row">
                                    <div class="col-md-12">
                                        <form action="../../Controller/AuditoriaControll.php" method="POST">
                                            <h2 class="content-row-title">Auditoria - Resultados</h2>
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <label>Nr. Auditoria</label>
                                                    <input type="text" class="form-control" readonly="" value="<?= $dados->getId() ?>">
                                                    <input type="hidden" name="idauditoria" value="<?= $dados->getId() ?>">
                                                </div>
                                                <div class="col-md-3">
                                                    <label>Data Início</label>
                                                    <input type="date" class="form-control" name="inicio" required="" value="<?= $dados->getDataInicio() ?>">
                                                </div>
                                                <div class="col-md-3">
                                                    <label>Data Termino</label>
                                                    <input type="date" class="form-control" name="termino" required="" value="<?= $dados->getDataFim() ?>">
                                                </div>
                                                <div class="col-md-3">
                                                    <label>Situação</label>
                                                    <select class="form-control" name="situacao2">
                                                        <?php if ($dados->getSituacao() == 'A') { ?>
                                                            <option style="background-color: #bbb" value="A">ABERTA</option>
                                                            <option value="F">FECHADA</option>
                                                        <?php } ?>
                                                        <?php if ($dados->getSituacao() == 'F') { ?>
                                                            <option style="background-color: #bbb" value="F">FECHADA</option>
                                                            <option value="A">ABERTA</option>
                                                        <?php } ?>
                                                        <?php if ($dados->getSituacao() == 'C') { ?>
                                                            <option style="background-color: #bbb" value="F">CANCELADA</option>
                                                            <option value="A">ABERTA</option>
                                                            <option value="F">FECHADA</option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <br>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <label>Setor</label>
                                                    <select class="form-control" name="setor" required="">
                                                        <option value="<?= $dados->getSetorId() ?>"><?= $nm_setor->getDescricao() ?></option>
                                                        <?php foreach ($sdao->BuscarTodosSetoresMenos($dados->getSetorId()) as $set) { ?>
                                                            <option value="<?= $set->getId() ?>"><?= $set->getDescricao() ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                                <div class="col-md-6">
                                                    <label>Auditor</label>
                                                    <input type="text" class="form-control" name="auditor"  required="" value="<?= $dados->getAuditor() ?>">
                                                </div>
                                            </div>
                                            <br>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="panel panel-default">
                                                        <h4>Itens Não Conforme</h4>
                                                        <?php
                                                        $count = 0;
                                                        foreach ($aqdao->BuscarTodosNC($dados->getId()) as $idmodo) {
                                                            $count = $idmodo->getItemQuestionarioId();
                                                            ?>
                                                            <div class="row">
                                                                <div class="col-md-9">
                                                                    <?php $nm_questao = $iqdao->BuscarDescricaoQuestao($idmodo->getItemQuestionarioId()) ?>
                                                                    <textarea class="form-control" readonly=""name="" rows="3"><?= $nm_questao->getDescricao() ?></textarea>
                                                                    <input type="hidden" name="iditemquestao[]" value="<?= $idmodo->getItemQuestionarioId() ?>">
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <label>SITUAÇÃO</label>
                                                                    <select class="form-control" id="mySelect" name="situacao[]">
                                                                        <option id="NC" value="NC">NÃO CONFORME</option>
                                                                        <option id="C" value="C">CONFORME</option>
                                                                        <option id="NA" value="NA">NADA COSTA</option>
                                                                    </select>
                                                                </div>
                                                                <div class='col-md-12'>
                                                                    <label>Evidências</label>
                                                                    <input type='text' name='evidencia[]' class='form-control' value="<?= $idmodo->getEvidencias() ?>">
                                                                </div>
                                                            </div>                                       
                                                            <?php
                                                        }
                                                        if ($count == null) {
                                                            ?>
                                                            <div class='col-md-12'>
                                                                <label>Não Possui Itens Não Conforme</label>
                                                                
                                                            </div>
                                                        <?php }
                                                        ?>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <label>Sugestão de Melhorias</label>
                                                            <textarea rows="3" name="sugestao" class="form-control"></textarea>
                                                        </div>                                       
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <label>Conclusão</label>
                                                            <textarea rows="3" name="conclusao" class="form-control"></textarea>
                                                        </div>                                       
                                                    </div>
                                                </div>                                       
                                            </div>

                                            <button type="submit" name="resultado" class="btn btn-primary"> Gravar</button>
                                        </form>
                                    </div>
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
