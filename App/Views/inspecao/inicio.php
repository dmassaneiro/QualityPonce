<?php
include_once '../../AutoLoad/AutoLoad.php';

$ldao = new LaudoInspecaoDAO();
$fdao = new FornecedorDAO();
$mdao = new MateriaPrimaDAO();
$sdao = new StatusDAO();


$tipoconsulta = filter_input(INPUT_POST, 'tipoconsulta');
$descricao = filter_input(INPUT_POST, 'descricao');
$dtinicio = filter_input(INPUT_POST, 'dtinicio');
$dtfim = filter_input(INPUT_POST, 'dtfim');
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Inspeção de Matéria-Prima</title>
        <?php include '../estrutura/head.php'; ?>
    </head>
    <body>
        <?php include '../estrutura/menu.php'; ?>
        <?php
        if ($id_permissao == 1 || $id_permissao == 6 || $id_permissao == 4 || $id_permissao == 5 || $id_permissao == 2) {
            
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
                    <?php include '../estrutura/mensagens.php'; ?>
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title"><a href="javascript:void(0);" class="toggle-sidebar"><span class="fa fa-angle-double-left" data-toggle="offcanvas" title="Esconder Menu"></span></a> Inspeção</h3>
                        </div>
                        <div class="panel-body">
                            <div class="content-row">
                                <div class="row">
                                    <div class="col-md-12">
                                        <h2 class="content-row-title">Inspeções Cadastradas</h2>
                                        <div class="row">
                                            <div class="col-md-2">
                                                <a href="cadastro"><button type="button" class="btn btn-info "><i class="glyphicon glyphicon-plus"></i> Cadastrar</button></a>
                                            </div>
                                        </div>
                                        <br>
                                        <form method="POST">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <label>Tipo de Consulta</label>
                                                    <select class="form-control" name="tipoconsulta" id="mySelect" onchange="myFunction();">
                                                        <option value="4">APROVADO</option>
                                                        <option value="5">REPROVADO</option>
                                                        <!--                                                        <option value="3">Cancelado</option>-->
                                                        <option id="Periodo" value="Periodo">PERÍODO</option>
                                                        <option id="Setor" value="Setor">FORNCEDOR</option>
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
                                                            <th>Fornecedor</th>
                                                            <th>Matéria-prima</th>
                                                            <th>Data</th>
                                                            <th>Tp. Inspeção</th>
                                                            <th>Status</th>
                                                            <th>Usuário</th>
                                                            <th></th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <?php
                                                            $usuariodao = new UsuarioDAO();
                                                            $historicoDao = new HistoricoLaudoInspecaoDAO();
//                                                                        $sdao = new StatusDAO();
                                                            $resultado = $ldao->BuscarTodos();
                                                            if ($tipoconsulta === '4' || $tipoconsulta === '5') {
                                                                $resultado = $ldao->BuscarTodosPorStatus($tipoconsulta);
                                                            } elseif ($descricao != null) {
                                                                $resultado = $ldao->BuscarTodosPorForncedor($descricao);
                                                            } elseif ($dtinicio != null || $dtfim != null) {
                                                                $resultado = $ldao->BuscarTodosPorPeriodo($dtinicio, $dtfim);
                                                            }

                                                            foreach ($resultado as $dados) {
                                                                $materiaprima = $mdao->BuscaPeloId($dados->getMateriaPrimaId());
                                                                $status = $sdao->BuscarNomeStatus($dados->getStatusId());
                                                                $forn = $fdao->BuscarNome($dados->getFornecedor());
                                                                $id_funcionario = $historicoDao->BuscarTodosHistoricoFuncionario($dados->getId());
                                                                $nm_funcionario = $usuariodao->BuscarNomeFuncionario($id_funcionario->getFuncionarioId());
                                                                ?>
                                                                <td><?= $dados->getId() ?></td>
                                                                <td><?= $forn->getNome() ?></td>
                                                                <td><?= $materiaprima->getNome() ?></td>
                                                                <td><?= date("d/m/Y", strtotime($dados->getDataInspecao())) ?></td>
                                                                <td>
                                                                    <?php
                                                                    if ($dados->getTipoinspecao1() == '1') {
                                                                        echo '100%';
                                                                    } else {
                                                                        echo 'AMOSTRAL';
                                                                    }
                                                                    ?>
                                                                </td>
                                                                <td>
                                                                    <?= $status->getDescricao() ?>
                                                                </td>
                                                                <td><?= $nm_funcionario->getNome() ?></td>
                                                                <td><a href="../inspecao/editar.php?id=<?= $dados->getId() ?>"><button class="btn btn-sm btn-primary" style=" float:left; margin: 0 4px 0 0;"><i class="glyphicon glyphicon-edit"></i> </button></a>
                                                                    <a href="relatorio.php?id=<?=$dados->getId()?>" target="_blank"><button class="btn btn-sm btn-info  "><i class="glyphicon glyphicon-print"></i></button></a>
                                                                    <button class="btn btn-sm btn-info" data-toggle="modal" data-target="#historico<?= $dados->getId() ?>"><i class="fa fa-eye" aria-hidden="true"></i></button> 
                                                                    <?php
                                                                    if ($id_permissao == 1 || $id_permissao == 6 || $id_permissao == 4 ||  $id_permissao == 2) {?>
                                                                        
                                                                    <button class="btn btn-sm btn-danger" data-toggle="modal" data-target="#deletar<?= $dados->getId() ?>"><i class="glyphicon glyphicon-trash"></i></button> </td>
                                                                 <?php   } else {
//                                                                        header('Location: ../pri/principal.php?msg=12');
                                                                    }
                                                                    ?>
                                                            </tr>

                                                            <!-- Modal-->
                                                        <div class="modal fade" id="historico<?= $dados->getId() ?>" role="dialog">
                                                            <div class="modal-dialog">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                                        <center><h4 class="modal-title">Histórico</h4></center>
                                                                    </div>
                                                                    <ul class="list-group">
                                                                        <?php
                                                                        $usuariodao = new UsuarioDAO();
                                                                        $historicoDao = new HistoricoLaudoInspecaoDAO();
                                                                        $sdao = new StatusDAO();
                                                                        foreach ($historicoDao->BuscarTodosHistorico($dados->getId()) as $h) {
                                                                            $nome_status = $sdao->BuscarNomeStatus($h->getStatusId());
                                                                            $nome_funcionario = $usuariodao->BuscarNomeFuncionario($h->getFuncionarioId());
                                                                            $nome_funcionario->getNome();
                                                                            if ($nome_status->getDescricao() == 'ALTERAÇÃO') {
                                                                                ?>
                                                                                <li class="list-group-item"><span class="badge badge-warning"><?= $nome_status->getDescricao() ?></span><b><?= strtoupper($nome_funcionario->getNome()) ?></b> - <?= date('d/m/Y H:i:s', strtotime($h->getData())) ?></li>

                                                                            <?php }if ($nome_status->getDescricao() == 'CADASTRADO') {
                                                                                ?>
                                                                                <li class="list-group-item"><span class="badge badge-success"><?= $nome_status->getDescricao() ?></span><b><?= strtoupper($nome_funcionario->getNome()) ?></b> - <?= date('d/m/Y H:i:s', strtotime($h->getData())) ?></li>
                                                                                <?php
                                                                            }if ($nome_status->getDescricao() == 'EXCLUIDO') {
                                                                                ?>
                                                                                <li class="list-group-item"><span class="badge badge-danger"><?= $nome_status->getDescricao() ?></span><b><?= strtoupper($nome_funcionario->getNome()) ?></b> - <?= date('d/m/Y H:i:s', strtotime($h->getData())) ?></li>
                                                                                <?php
                                                                            }
                                                                        }
                                                                        ?>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!-- Modal-->
                                                        <div class="modal fade" id="deletar<?= $dados->getId() ?>" role="dialog">
                                                            <div class="modal-dialog">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                                        <center><h4 class="modal-title">Mensagem de Confirmação</h4></center>
                                                                    </div>
                                                                    <center>
                                                                        <strong>DESEJA REALMENTE EXCLUIR?</strong><br><br>
                                                                        <a href="../../Controller/LaudoInspecaoControll.php?deletar=<?= $dados->getId() ?>"<button class="btn btn-success">SIM</button></a>
                                                                        <button class="btn btn-danger" class="close" data-dismiss="modal">NÃO</button>
                                                                    </center>
                                                                    <br>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        </tbody>
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
                            "<label>Nome</label>" +
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
                if (x === "4" || x === "5" || x === "3") {
                    document.getElementById("demo").innerHTML = "";
                }
            }
        </script>   
    </body>
</html>
