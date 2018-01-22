<?php
include_once '../../../Config/ConexaoPDO.php';
include_once '../../DAO/NcProdutoDAO.php';
include_once '../../Model/NaoConformidadeProduto.php';
include_once '../../DAO/StatusDAO.php';
include_once '../../Model/Status.php';
include_once '../../DAO/TipoNaoConformidadeProdutoDAO.php';
include_once '../../Model/TipoNaoConformidadeProduto.php';
include_once '../../DAO/UsuarioDAO.php';
include_once '../../Model/Usuario.php';
include_once '../../DAO/FuncionarioDAO.php';
include_once '../../Model/Funcionario.php';
include_once '../../DAO/HistoricoNcProdutoDAO.php';
include_once '../../Model/HistoricoConformidadeProduto.php';

$ncDao = new NcProdutoDAO();
$status = new StatusDAO();
$tipoNc = new TipoNaoConformidadeProdutoDAO();
$historicoDao = new HistoricoNcProdutoDAO();
$usuariodao = new UsuarioDAO();

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
        <title>NC - Produtos</title>
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
                    <div class="panel panel-default" >
                        <?php if ($msg == '1') { ?>
                            <div class="alert alert-danger alert-dismissable">
                                <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                                <strong>Erro! </strong> Preencha os Campos Obrigatorios.
                            </div>
                        <?php } ?>
                        <div class="panel-heading" id="ncproduto">
                            <h3 class="panel-title" ><a id="a_modific" href="javascript:void(0);" class="toggle-sidebar"><span class="fa fa-angle-double-left" data-toggle="offcanvas" title="Esconder Menu"></span></a> Não Conformidades</h3>
                        </div>
                        <div class="panel-body" >
                            <div class="content-row">
                                <div class="row">
                                    <div class="col-md-12">
                                        <h2 class="content-row-title">Não Conformidades de Produtos Cadastradas</h2>
                                        <div class="row">
                                            <div class="col-md-2">
                                                <a href="cadastroproduto.php"><button type="button" class="btn btn-info "><i class="glyphicon glyphicon-plus"></i> Cadastrar</button></a>
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
                                                        <option id="Setor" value="nr">NR. CONTROLE INTERNO</option>
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
                                                            <th>Data</th>
                                                            <th>Tp. NC</th>
                                                            <th>Investigar</th>
                                                            <th>Status</th>
                                                            <th>Usuário</th>
                                                            <th></th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <?php
                                                            $resultado = $ncDao->BuscarTodosNcProduto();

                                                            if ($tipoconsulta === '1' || $tipoconsulta === '2' || $tipoconsulta === '3') {
                                                                $resultado = $ncDao->BuscarTodosNcProdutosStatus($tipoconsulta);
                                                            } elseif ($descricao != null) {
                                                                $resultado = $ncDao->BuscarTodosNcProdutosControle($descricao);
                                                            } elseif ($dtinicio != null || $dtfim != null) {
                                                                $resultado = $ncDao->BuscarTodosNcProdutoPeriodo($dtinicio, $dtfim);
                                                            }
                                                            foreach ($resultado as $nc) {
                                                                $nm_Nc = $tipoNc->BuscarNomeNC($nc->getTipoNaoConformidadeProdutoId());
                                                                $nm_status = $status->BuscarNomeStatus($nc->getStatusId());
                                                                $id_funcionario = $historicoDao->BuscarTodosHistoricoNCFuncionario($nc->getId());
                                                                $nm_funcionario = $usuariodao->BuscarNomeFuncionario($id_funcionario->getFuncionarioId());
                                                                ?>

                                                                <td><?= $nc->getId() ?></td>
                                                                <td><?=date("d/m/Y", strtotime( $nc->getDataEmissao())) ?></td>
                                                                <td><?= $nm_Nc->getDescricao() ?></td>
                                                                <td> <?php
                                                                    if ($nc->getInvestigar() == 'S') {
                                                                        echo 'SIM';
                                                                    }if ($nc->getInvestigar() == 'N') {
                                                                        echo 'NÃO';
                                                                    }
                                                                    ?></td>
                                                                <td><?= $nm_status->getDescricao() ?></td>
                                                                <td><?= strtoupper($nm_funcionario->getNome()) ?></td>
                                                                <td><a href="../naoconformidade/editproduto.php?id=<?= $nc->getId() ?>"><button class="btn btn-sm btn-primary" style=" float:left; margin: 0 4px 0 0;"><i class="glyphicon glyphicon-edit"></i> </button></a>
                                                                    <a href="relatoriopro.php?id=<?= $nc->getId() ?>" target="_blank"><button class="btn btn-sm btn-info  "><i class="glyphicon glyphicon-print"></i></button></a>
                                                                    <button class="btn btn-sm btn-info" data-toggle="modal" data-target="#historico<?= $nc->getId() ?>"><i class="fa fa-eye" aria-hidden="true"></i></button> 
                                                                    <?php if ($id_permissao == 1 || $id_permissao == 6) { ?>

                                                                    <button class="btn btn-sm btn-danger" data-toggle="modal" data-target="#deletar<?= $nc->getId() ?>"><i class="glyphicon glyphicon-trash"></i></button> </td>
                                                                        <?php
                                                                    } else {
//                                                                        header('Location: ../pri/principal.php?msg=12');
                                                                    }
                                                                    ?>
                                                            </tr>
                                                        </tbody>
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
                                                                        <a href="../../Controller/NcProdutoControll.php?deletar=<?= $nc->getId() ?>"<button class="btn btn-success">SIM</button></a>
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
                if (x === "nr") {
                    document.getElementById("demo").innerHTML = " <div class='col-md-4'>" +
                            "<label>Descrição</label>" +
                            "<input type='text' name='descricao' class='form-control'>" +
                            "</div>";
                }
                if (x === "Periodo") {
                    document.getElementById("demo").innerHTML = "<div class='col-md-3'>" +
                            "<label>Dt. Início</label>" +
                            "<input type='date' name='dtinicio'value='<?=$data?>' class='form-control'>" +
                            "</div>" +
                            "<div class='col-md-3'>" +
                            "<label>Dt. Fim</label>" +
                            "<input type='date' name='dtfim' value='<?=$data?>' class='form-control'>" +
                            "</div>";
                }
                if (x === "1" || x === "2" || x === "3") {
                    document.getElementById("demo").innerHTML = "";
                }
            }
        </script>
    </body>
</html>
