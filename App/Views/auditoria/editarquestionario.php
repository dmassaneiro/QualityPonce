<?php
include_once '../../AutoLoad/AutoLoad.php';

$id = filter_input(INPUT_GET, 'id');

$adao = new AuditoriaDAO();
$sdao = new SetorDAO();
$iqdao = new ItemQuestionarioDAO();
$aqdao = new AuditoriaQuestaoDAO();

$dados = $adao->BuscarRegistroParaEditar($id);
$nm_setor = $sdao->BuscarNomeSetor($dados->getSetorId());
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Auditoria</title>
        <?php include '../estrutura/head.php'; ?>
        <script src="../js/questionario.js" type="text/javascript"></script>
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
                            <h3 class="panel-title"><a href="javascript:void(0);" class="toggle-sidebar"><span class="fa fa-angle-double-left" data-toggle="offcanvas" title="Esconder Menu"></span></a> Auditorias/ Questionário</h3>
                        </div>
                        <div class="panel-body">
                            <div class="content-row">
                                <div class="row">
                                    <div class="col-md-12">
                                        <form id="formulario" action="../../Controller/AuditoriaControll.php" method="POST">
                                            <h2 class="content-row-title">Auditoria - Questionário</h2>
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <label>Nr. Auditoria</label>
                                                    <input type="text" class="form-control" readonly="" value="<?= $dados->getId() ?>">
                                                    <input type="hidden" name="idauditoria" value="<?= $dados->getId() ?>">
                                                    <input type="hidden" name="idfuncionario" value="<?= $id_funcionario ?>">
                                                </div>
                                                <div class="col-md-3">
                                                    <label>Data Início</label>
                                                    <input type="date" class="form-control" name="inicio" required="" value="<?= $dados->getDataInicio() ?>">
                                                </div>
                                                <div class="col-md-3">
                                                    <label>Data Termino</label>
                                                    <input type="date" class="form-control" name="termino" required="" value="<?= $dados->getDataFim() ?>">
                                                </div>
                                            </div>
                                            <br>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <label>Setor</label>
                                                    <select class="form-control" name="setor" required="">
                                                        <option value="<?= $dados->getSetorId() ?>"><?= $nm_setor->getDescricao() ?></option>
                                                        <?php foreach ($sdao->BuscarTodosSetoresMenos($dados->getSetorId()) as $set) {
                                                            
                                                            ?>
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
                                            <h4>QUÊSTIONÁRIOS</h4>
                                            <?php
                                            $count = 0;
                                            foreach ($aqdao->BuscarTodosID($id) as $idmodo) {
                                                $count = $idmodo->getAuditoriaId();
                                                        $idao = new ItemQuestionarioDAO();
                                                $nm_questao = $idao->BuscarDescricaoQuestao($idmodo->getItemQuestionarioId());
                                                if ($count != null) {
                                                    ?>
                                                    <div class="row">
                                                        <div class="col-md-9">
                                                            <textarea class="form-control" readonly="" name="" rows="3"><?= $nm_questao->getDescricao() ?></textarea>
                                                            <input type="hidden" name="iditemquestao[]" value="<?= $idmodo->getItemQuestionarioId() ?>">
                                                        </div>
                                                        <div class="col-md-3">
                                                            <label>SITUAÇÃO</label>
                                                            <select class="form-control" id="mySelect" name="situacao[]">
                                                                <?php if ($idmodo->getResposta() == 'C') { ?>
                                                                    <option id="C" value="C">CONFORME</option>
                                                                    <option id="NC" value="NC">NÃO CONFORME</option>
                                                                    <option id="NA" value="NA">NADA COSTA</option>
                                                                <?php } ?>
                                                                <?php if ($idmodo->getResposta() == 'NC') { ?>
                                                                    <option id="NC" value="NC">NÃO CONFORME</option>
                                                                    <option id="C" value="C">CONFORME</option>
                                                                    <option id="NA" value="NA">NADA COSTA</option>
                                                                <?php } ?>
                                                                <?php if ($idmodo->getResposta() == 'NA') { ?>
                                                                    <option id="NA" value="NA">NADA COSTA</option>
                                                                    <option id="C" value="C">CONFORME</option>
                                                                    <option id="NC" value="NC">NÃO CONFORME</option>
                                                                <?php } ?>
                                                            </select> 
                                                        </div>
                                                        <div class='col-md-12'>
                                                            <label>Evidências</label>
                                                            <input type='text' name='evidencia[]' class='form-control' value="<?= $idmodo->getEvidencias() ?>">
                                                        </div>
                                                    </div>                                       
                                                    <?php
                                                }
                                            }if ($count == null) {
                                                ?>
                                                <?php foreach ($iqdao->BuscarTodos() as $idmodo) { ?>
                                                    <div class="row">
                                                        <div class="col-md-9">
                                                            <textarea class="form-control" readonly="" name="" rows="3"><?= $idmodo->getDescricao() ?></textarea>
                                                            <input type="hidden" name="iditemquestao[]" value="<?= $idmodo->getId() ?>">
                                                        </div>
                                                        <div class="col-md-3">
                                                            <label>SITUAÇÃO</label>
                                                            <select class="form-control" id="mySelect" name="situacao[]">
                                                                <option id="C" value="C">CONFORME</option>
                                                                <option id="NC" value="NC">NÃO CONFORME</option>
                                                                <option id="NA" value="NA">NADA COSTA</option>
                                                            </select>
                                                        </div>
                                                        <div class='col-md-12'>
                                                            <label>Evidências</label>
                                                            <input type='text' name='evidencia[]' class='form-control'>
                                                        </div>
                                                    </div>                                       
                                                <?php } ?>
                                            <?php } ?>
                                            <hr>
                                            <button type="submit" id="questionario" name="editarquestionario" class="btn btn-info"> Resultados</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                </body>
                </html>
