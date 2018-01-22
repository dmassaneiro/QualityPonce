<?php
include_once '../../../Config/ConexaoPDO.php';
include_once '../../DAO/NcProcessoDAO.php';
include_once '../../Model/NaoConformidade.php';
include_once '../../DAO/TipoNaoConformidadeDAO.php';
include_once '../../Model/TipoNaoConformidade.php';
include_once '../../DAO/SetorDAO.php';
include_once '../../Model/Setor.php';
include_once '../../DAO/StatusDAO.php';
include_once '../../Model/Status.php';
include_once '../../DAO/HistoricoNcProcessoDAO.php';
include_once '../../Model/HistoricoNaoConformidade.php';
include_once '../../DAO/FuncionarioDAO.php';
include_once '../../Model/Funcionario.php';
include_once '../../DAO/UsuarioDAO.php';
include_once '../../Model/Usuario.php';


$msg = filter_input(INPUT_GET, 'msg');
$tipoconsulta = filter_input(INPUT_POST, 'tipoconsulta');
$descricao = filter_input(INPUT_POST, 'descricao');
$dtinicio = filter_input(INPUT_POST, 'dtinicio');
$dtfim = filter_input(INPUT_POST, 'dtfim');
$data = date('Y-m-d');
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
                        <?php include '../estrutura/mensagens.php'; ?>
                        <div class="panel-heading" id="ncprocesso">
                            <h3 class="panel-title"><a id="a_modific" href="javascript:void(0);" class="toggle-sidebar"><span class="fa fa-angle-double-left" data-toggle="offcanvas" title="Esconder Menu"></span></a> Não Conformidades</h3>
                        </div>
                        <div class="panel-body">
                            <div class="content-row">
                                <div class="row">
                                    <div class="col-md-12">
                                        <h2 class="content-row-title">Não Conformidades de Processos Cadastradas</h2>
                                        <div class="row">
                                            <div class="col-md-2">
                                                <a href="cadastroprocesso.php"><button type="button" class="btn btn-info "><i class="glyphicon glyphicon-plus"></i> Cadastrar</button></a>
                                            </div>
                                        </div>
                                        <br>
                                        <form method="POST">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <label>Tipo de Consulta</label>
                                                    <select class="form-control" name="tipoconsulta" id="mySelect" onchange="myFunction()">
                                                        <option value="2">PENDENTE</option>
                                                        <option value="1">CONCLUIDO</option>
                                                        <option value="3">CANCELADO</option>
                                                        <option id="Periodo" value="Periodo">PERÍODO</option>
                                                        <option id="Setor" value="Setor">SETOR</option>
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
                                                            <th>Cod.</th>
                                                            <th>Setor</th>
                                                            <th>Origem</th>
                                                            <th>Gravidade</th>
                                                            <th>Ação Corretiva</th>
                                                            <th>Data</th>
                                                            <th>Status</th>
                                                            <th>Usuário</th>
                                                            <th></th>
                                                        </tr>
                                                        <?php
                                                        $status = new StatusDAO();
                                                        $setor = new SetorDAO();
                                                        $tipoNc = new TipoNaoConformidadeDAO();
                                                        $ncprocesso = new NcProcessoDAO();
                                                        $historicoDao = new HistoricoNcProcessoDAO();
                                                        $usuariodao = new UsuarioDAO();
                                                        $resultado = $ncprocesso->BuscarTodosNcProcesso();

                                                        if ($tipoconsulta === '1' || $tipoconsulta === '2' || $tipoconsulta === '3') {
                                                            $resultado = $ncprocesso->BuscarTodosNcProcessoStatus($tipoconsulta);
                                                        } elseif ($descricao != null) {
                                                            $resultado = $ncprocesso->BuscarTodosNcProcessoSetor($descricao);
                                                        } elseif ($dtinicio != null || $dtfim != null) {
                                                            $resultado = $ncprocesso->BuscarTodosNcProcessoPeriodo($dtinicio, $dtfim);
                                                        }
                                                        foreach ($resultado as $nc) {
                                                            $nm_setor = $setor->BuscarNomeSetor($nc->getSetorId());
                                                            $nm_Nc = $tipoNc->BuscarNomeNC($nc->getTipoNaoConformidadeId());
                                                            $nm_status = $status->BuscarNomeStatus($nc->getStatusId());
                                                            $id_funcionario = $historicoDao->BuscarTodosHistoricoNCFuncionario($nc->getId());
                                                            $nm_funcionario = $usuariodao->BuscarNomeFuncionario($id_funcionario->getFuncionarioId());
                                                            ?>
                                                            <tr>
                                                                <td><?= $nc->getId() ?></td>
                                                                <td><?= $nm_setor->getDescricao() ?></td>
                                                                <td><?= $nm_Nc->getDescricao() ?></td>
                                                                <td>
                                                                    <?php
                                                                    if ($nc->getGravidade() == 'A') {
                                                                        echo 'ALTA';
                                                                    }if ($nc->getGravidade() == 'B') {
                                                                        echo 'BAIXA';
                                                                    }
                                                                    ?>
                                                                </td>
                                                                <td>
                                                                    <?php
                                                                    if ($nc->getAcaoCorretiva() == 'S') {
                                                                        echo 'SIM';
                                                                    }if ($nc->getAcaoCorretiva() == 'N') {
                                                                        echo 'NÃO';
                                                                    }
                                                                    ?>
                                                                </td>
                                                                <td><?= date("d/m/Y", strtotime($nc->getDataEmisao())) ?></td>
                                                                <td><?= $nm_status->getDescricao() ?></td>
                                                                <td><?= strtoupper($nm_funcionario->getNome()) ?></td>
                                                                <td><a href="../naoconformidade/editprocesso.php?id=<?= $nc->getId() ?>"><button class="btn btn-sm btn-primary" style=" float:left; margin: 0 4px 0 0;"><i class="glyphicon glyphicon-edit"></i> </button></a>
                                                                    <a href="relatorio.php?id=<?= $nc->getId() ?>" target="_blank"><button class="btn btn-sm btn-info  "><i class="glyphicon glyphicon-print"></i></button></a>
                                                                    <button class="btn btn-sm btn-info" data-toggle="modal" data-target="#historico<?= $nc->getId() ?>"><i class="fa fa-eye" aria-hidden="true"></i></button> 
                                                                    <?php if ($id_permissao == 1 || $id_permissao == 6) { ?>

                                                                    <button class="btn btn-sm btn-danger" data-toggle="modal" data-target="#deletar<?= $nc->getId() ?>"><i class="glyphicon glyphicon-trash"></i></button> </td>
                                                                        <?php
                                                                    } else {
//                                                                        header('Location: ../pri/principal.php?msg=12');
                                                                    }
                                                                    ?>
                                                            </tr>

                                                            <!-- Modal-->
                                                        <div class="modal fade" id="historico<?= $nc->getId() ?>" role="dialog">
                                                            <div class="modal-dialog">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                                        <center><h4 class="modal-title">Histórico</h4></center>
                                                                    </div>
                                                                    <ul class="list-group">
                                                                        <?php
                                                                        $usuariodao = new UsuarioDAO();
                                                                        $historicoDao = new HistoricoNcProcessoDAO();
                                                                        foreach ($historicoDao->BuscarTodosHistoricoNC($nc->getId()) as $his) {
                                                                            $nome_status = $status->BuscarNomeStatus($his->getStatusId());
                                                                            $nome_funcionario = $usuariodao->BuscarNomeFuncionario($his->getFuncionarioId());

                                                                            if ($nome_status->getDescricao() == 'ALTERAÇÃO') {
                                                                                ?>
                                                                                <li class="list-group-item"><span class="badge badge-warning"><?= $nome_status->getDescricao() ?></span><b><?= strtoupper($nome_funcionario->getNome()) ?></b> - <?= date('d/m/Y H:i:s', strtotime($his->getData())) ?></li>

                                                                            <?php }if ($nome_status->getDescricao() == 'CADASTRADO') {
                                                                                ?>
                                                                                <li class="list-group-item"><span class="badge badge-success"><?= $nome_status->getDescricao() ?></span><b><?= strtoupper($nome_funcionario->getNome()) ?></b> - <?= date('d/m/Y H:i:s', strtotime($his->getData())) ?></li>
                                                                                <?php
                                                                            }if ($nome_status->getDescricao() == 'EXCLUIDO') {
                                                                                ?>
                                                                                <li class="list-group-item"><span class="badge badge-danger"><?= $nome_status->getDescricao() ?></span><b><?= strtoupper($nome_funcionario->getNome()) ?></b> - <?= date('d/m/Y H:i:s', strtotime($his->getData())) ?></li>
                                                                                <?php
                                                                            }
                                                                        }
                                                                        ?>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!-- Modal-->
                                                        <div class="modal fade" id="deletar<?= $nc->getId() ?>" role="dialog">
                                                            <div class="modal-dialog">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                                        <center><h4 class="modal-title">Mensagem de Confirmação</h4></center>
                                                                    </div>
                                                                    <center>
                                                                        <strong>DESEJA REALMENTE EXCLUIR?</strong><br><br>
                                                                        <a href="../../Controller/NcProcessoControll.php?deletar=<?= $nc->getId() ?>"<button class="btn btn-success">SIM</button></a>
                                                                        <button class="btn btn-danger" class="close" data-dismiss="modal">NÃO</button>
                                                                    </center>
                                                                    <br>
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
                if (x === "Setor") {
                    document.getElementById("demo").innerHTML = " <div class='col-md-4'>" +
                            "<label>Descrição</label>" +
                            "<input type='text' name='descricao' class='form-control'>" +
                            "</div>";
                }
                if (x === "Periodo") {
                    document.getElementById("demo").innerHTML = "<div class='col-md-3'>" +
                            "<label>Dt. Início</label>" +
                            "<input type='date' name='dtinicio' value='<?= $data ?>' class='form-control'>" +
                            "</div>" +
                            "<div class='col-md-3'>" +
                            "<label>Dt. Fim</label>" +
                            "<input type='date' name='dtfim' value='<?= $data ?>' class='form-control'>" +
                            "</div>";
                }
                if (x === "1" || x === "2" || x === "3") {
                    document.getElementById("demo").innerHTML = "";
                }
            }
        </script>
    </body>
</html>
