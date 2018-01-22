<?php
include_once '../../AutoLoad/AutoLoad.php';


//$id_permissao = $_SESSION['permissao_id'];



$ver = filter_input(INPUT_GET, 'ver');
$adao = new AuditoriaDAO();
$sdao = new SetorDAO();

$tipoconsulta = filter_input(INPUT_POST, 'tipoconsulta');
$descricao = filter_input(INPUT_POST, 'descricao');
$dtinicio = filter_input(INPUT_POST, 'dtinicio');
$dtfim = filter_input(INPUT_POST, 'dtfim');

$dt = date('Y-m-d');
$teste = $adao->VerificaData($dt);


//$adao = new AuditoriaDAO();
$aa = new Auditoria();
$teste2 = $adao->VerificaData($dt);
foreach ($adao->VerificaData2($dt) as $aud) {
    $aa->setId($aud->getId());
    $aa->setSituacao("C");

    $adao->Cancela($aa);
}
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
                    <?php if ($teste->getId() != null) {
                        ?>
                        <div class="alert alert-warning alert-dismissable">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                            <strong>ATENÇÃO! </strong>  Você possui Auditorias Abertas à Vencer!.
                        </div>
                    <?php } ?>
                    <?php include '../estrutura/mensagens.php'; ?>
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title"><a href="javascript:void(0);" class="toggle-sidebar"><span class="fa fa-angle-double-left" data-toggle="offcanvas" title="Esconder Menu"></span></a> Auditorias</h3>
                        </div>
                        <div class="panel-body">
                            <div class="content-row">
                                <div class="row">
                                    <div class="col-md-12">
                                        <h2 class="content-row-title">Auditorias Cadastradas</h2>
                                        <div class="row">
                                            <div class="col-md-2">
                                                <a href="cadastro.php"><button type="button" class="btn btn-info "><i class="glyphicon glyphicon-plus"></i> Cadastrar</button></a>
                                            </div>
                                        </div>
                                        <br>
                                        <form method="POST">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <label>Tipo de Consulta</label>
                                                    <select class="form-control" name="tipoconsulta" id="mySelect" onchange="myFunction();">
                                                        <option >TODOS</option>
                                                        <option value="A">ABERTA</option>
                                                        <option value="F">FECHADA</option>
                                                        <option value="C">CANCELADA</option>
                                                        <option id="Periodo" value="Periodo">PERÍODO</option>
                                                        <option id="Setor" value="Setor">SETOR</option>
                                                        <option id="a" value="auditor">AUDITOR</option>
                                                    </select>
                                                </div>

                                                <div class="col-md-1">
                                                    <br>
                                                    <button type="submit" class="btn btn-warning"><span class="glyphicon glyphicon-search"></span> Pesquisar</button>
                                                </div>
                                            </div>
                                            <div id="demo" class="row">
                                            </div>
                                        </form>
                                        <br>
                                        <div class="row">
                                            <div class="table-responsive">
                                                <table class="table">
                                                    <thead>
                                                        <tr>
                                                            <th>Nr.</th>
                                                            <th>Auditor</th>
                                                            <th>Início</th>
                                                            <th>Termino</th>
                                                            <th>Setor</th>
                                                            <th>Situação</th>
                                                            <th></th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        $resultado = $adao->BuscarTodos();

                                                        if ($tipoconsulta === 'A' || $tipoconsulta === 'F' || $tipoconsulta === '5' || $tipoconsulta === 'C') {
                                                            $resultado = $adao->BuscarTodosPorStatus($tipoconsulta);
                                                        } elseif ($tipoconsulta == 'Setor') {
                                                            $resultado = $adao->BuscarSetor($descricao);
                                                        } elseif ($dtinicio != null || $dtfim != null) {
                                                            $resultado = $adao->BuscarTodosPorPeriodo($dtinicio, $dtfim);
                                                        } elseif ($tipoconsulta === 'auditor') {
                                                            $resultado = $adao->BuscarTodosPorAuditor($descricao);
                                                        } elseif ($ver != null) {
                                                            $resultado = $adao->BuscarTodosPorStatus('A');
                                                        }

                                                        foreach ($resultado as $d) {
                                                            $nm_setor = $sdao->BuscarNomeSetor($d->getSetorId());
                                                            ?>
                                                            <?php if ($d->getDataFim() <= $data_banco && $d->getSituacao() == 'A') { ?>
                                                                <tr style="background-color: #F5D76E">
                                                                <?php } elseif ($d->getSituacao() == 'C') { ?>
                                                                <tr style="background-color: #f2838f">
                                                                <?php } else { ?>
                                                                <tr>
                                                                <?php } ?>
                                                                <td><?= $d->getId(); ?></td>
                                                                <td><?= $d->getAuditor() ?></td>
                                                                <td><?= date("d/m/Y", strtotime($d->getDataInicio())) ?></td>
                                                                <td><?= date("d/m/Y", strtotime($d->getDataFim())) ?></td>
                                                                <td><?= $nm_setor->getDescricao() ?></ttd>
                                                                <td>
                                                                    <?php
                                                                    if ($d->getSituacao() == 'A') {
                                                                        echo 'ABERTA';
                                                                    } if ($d->getSituacao() == 'F') {
                                                                        echo 'FECHADA';
                                                                    }if ($d->getSituacao() == 'C') {
                                                                        echo 'CANCELADA';
                                                                    }
                                                                    ?>
                                                                </td>
                                                                <td><a href="../auditoria/editarauditoria.php?id=<?= $d->getId() ?>"><button class="btn btn-sm btn-primary" style=" float:left; margin: 0 4px 0 0;"><i class="glyphicon glyphicon-edit"></i> </button></a>
                                                                    <a href="relatorio.php?id=<?= $d->getId() ?>" target="_blank"><button class="btn btn-sm btn-info  "><i class="glyphicon glyphicon-print"></i></button></a>
                                                                    <button class="btn btn-sm btn-info" data-toggle="modal" data-target="#historico<?= $d->getId() ?>"><i class="fa fa-eye" aria-hidden="true"></i></button> 
                                                                    <?php?>
                                                                    <button class="btn btn-sm btn-danger" data-toggle="modal" data-target="#deletar<?= $d->getId() ?>"><i class="glyphicon glyphicon-trash"></i></button> </td>
                                                                    <?php?>
                                                            </tr>
                                                        </tbody>
                                                        <!-- Modal-->
                                                        <div class="modal fade" id="deletar<?= $d->getId() ?>" role="dialog">
                                                            <div class="modal-dialog">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                                        <center><h4 class="modal-title">Mensagem de Confirmação</h4></center>
                                                                    </div>
                                                                    <center>
                                                                        <strong>DESEJA REALMENTE EXCLUIR?</strong><br><br>
                                                                        <a href="../../Controller/AuditoriaControll.php?deletar=<?= $d->getId() ?>"<button class="btn btn-success">SIM</button></a>
                                                                        <button class="btn btn-danger" class="close" data-dismiss="modal">NÃO</button>
                                                                    </center>
                                                                    <br>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal fade" id="historico<?= $d->getId() ?>" role="dialog">
                                                            <div class="modal-dialog">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                                        <center><h4 class="modal-title">Histórico</h4></center>
                                                                    </div>
                                                                    <ul class="list-group">
                                                                        <?php
                                                                        $usuariodao = new UsuarioDAO();
                                                                        $historicoDao = new HistoricoAuditoriaDAO();
                                                                        $status = new StatusDAO();
                                                                        foreach ($historicoDao->BuscarTodosHistorico($d->getId()) as $his) {
                                                                            $nome_status = $status->BuscarNomeStatus($his->getStatusId());
                                                                            $nome_funcionario = $usuariodao->BuscarNomeFuncionario($his->getFuncionarioId());
                                                                            if ($nome_status->getDescricao() == 'ALTERAÇÃO') {
                                                                                ?>
                                                                                <li class="list-group-item"><span class="badge badge-warning"><?= $nome_status->getDescricao() ?></span><b><?= strtoupper($nome_funcionario->getNome()) ?></b> - <?= date('d/m/Y H:i:s', strtotime($his->getData())) ?></li>

                                                                            <?php }if ($nome_status->getDescricao() == 'CADASTRADO') {
                                                                                ?>
                                                                                <li class="list-group-item"><span class="badge badge-success"><?= $nome_status->getDescricao() ?></span><b><?= strtoupper($nome_funcionario->getNome()) ?></b> - <?= date('d/m/Y H:i:s', strtotime($his->getData())) ?></li>
                                                                                <?php
                                                                            }if ($nome_status->getDescricao() == 'APROVADO') {
                                                                                ?>
                                                                                <li class="list-group-item"><span class="badge badge-success"><?= $nome_status->getDescricao() ?></span><b><?= strtoupper($nome_funcionario->getNome()) ?></b> - <?= date('d/m/Y H:i:s', strtotime($his->getData())) ?></li>
                                                                                <?php
                                                                            }if ($nome_status->getDescricao() == 'REPROVADO') {
                                                                                ?>
                                                                                <li class="list-group-item"><span class="badge badge-danger"><?= $nome_status->getDescricao() ?></span><b><?= strtoupper($nome_funcionario->getNome()) ?></b> - <?= date('d/m/Y H:i:s', strtotime($his->getData())) ?></li>
                                                                            <?php } if ($nome_status->getDescricao() == 'ALTERAÇÃO - QUESTIONÁRIO') {
                                                                                ?>
                                                                                <li class="list-group-item"><span class="badge badge-warning"><?= $nome_status->getDescricao() ?></span><b><?= strtoupper($nome_funcionario->getNome()) ?></b> - <?= date('d/m/Y H:i:s', strtotime($his->getData())) ?></li>
                                                                                <?php
                                                                            } if ($nome_status->getDescricao() == 'ALTERAÇÃO - RESULTADO') {
                                                                                ?>
                                                                                <li class="list-group-item"><span class="badge badge-warning"><?= $nome_status->getDescricao() ?></span><b><?= strtoupper($nome_funcionario->getNome()) ?></b> - <?= date('d/m/Y H:i:s', strtotime($his->getData())) ?></li>
                                                                                        <?php
                                                                                    }
                                                                                }
                                                                                ?>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    <?php } ?>
                                                </table> 
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script>
            function myFunction() {
                var x = document.getElementById("mySelect").value;
                if (x === "Setor" || x === "auditor") {
                    document.getElementById("demo").innerHTML = " <div class='col-md-4'>" +
                            "<label>Descrição</label>" +
                            "<input type='text' name='descricao' class='form-control'>" +
                            "</div>";
                }
                if (x === "Periodo") {
                    document.getElementById("demo").innerHTML = "<div class='col-md-3'>" +
                            "<label>Dt. Início</label>" +
                            "<input type='date' name='dtinicio' value='<?= $data_banco ?>' class='form-control'>" +
                            "</div>" +
                            "<div class='col-md-3'>" +
                            "<label>Dt. Fim</label>" +
                            "<input type='date' name='dtfim' value='<?= $data_banco ?>' class='form-control'>" +
                            "</div>";
                }
                if (x === "1" || x === "A" || x === "F") {
                    document.getElementById("demo").innerHTML = "";
                }
            }
        </script> 
    </body>
</html>
