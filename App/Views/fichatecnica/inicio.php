<?php
include_once '../../AutoLoad/AutoLoad.php';
$ver = filter_input(INPUT_GET, 'ver');
$fichadao = new FichaTecnicaDAO();
$produtodao = new ProdutoDAO();

$tipoconsulta = filter_input(INPUT_POST, 'tipoconsulta');
$descricao = filter_input(INPUT_POST, 'descricao');
$dtinicio = filter_input(INPUT_POST, 'dtinicio');
$dtfim = filter_input(INPUT_POST, 'dtfim');

$dt = date("Y-m-d");
$i = 0;
foreach ($fichadao->VerificaData($dt) as $ix) {
    $i++;
}

//$dt = date("Y-m-d");
$fdao = new FichaTecnicaDAO();
$f = new FichaTecnica();
foreach ($fdao->VerificaData2($dt) as $ficha) {
    $f->setId($ficha->getId());
    $f->setStatusId(3);

    $fdao->Cancela($f);
}
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Ficha Técnica</title>
        <?php include '../estrutura/head.php'; ?>
    </head>
    <body>
        <?php include '../estrutura/menu.php'; ?>
        <?php
        if ($id_permissao == 1 || $id_permissao == 6 || $id_permissao == 2 || $id_permissao == 3) {
            
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
                    <?php if ($i != null) { ?>
                        <div class="alert alert-warning alert-dismissable">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                            <strong>ATENÇÃO! </strong>  Você possui Fichas Técnica Pendentes à Vencer!.
                        </div>
                        <?php
                    } else {
                        
                    }
                    ?>
                    <div class="panel panel-default">
                        <div class="panel-heading" id="producao">
                            <h3 class="panel-title"><a href="javascript:void(0);" class="toggle-sidebar"><span class="fa fa-angle-double-left" data-toggle="offcanvas" title="Esconder Menu"></span></a> Ficha Técnica</h3>
                        </div>
                        <div class="panel-body">
                            <div class="content-row">
                                <div class="row">
                                    <div class="col-md-12">
                                        <h2 class="content-row-title">Fichas Técnicas Cadastradas</h2>
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
                                                        <option value="">TODOS</option>
                                                        <option value="1">CONCLUIDO</option>
                                                        <option value="2">PENDENTE</option>
                                                        <option value="3">CANCELADO</option>
                                                        <option id="Periodo" value="Periodo">PERÍODO</option>
                                                        <option id="Setor" value="descricao">PRODUTO</option>
                                                        <option id="Setor" value="nrserie">NR. SÉRIE</option>
                                                        <option id="Setor" value="nrordem">NR. ORDEM</option>
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
                                                            <th>Produto</th>
                                                            <th>Dt. Ínicio</th>
                                                            <th>Dt. Fim</th>
                                                            <th>Status</th>
                                                            <th>Usuário</th>
                                                            <th></th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        $resultado = $fichadao->BuscarTodos();
                                                        $historicoDao = new HistoricoFichaTecnicaDAO();
                                                        $s = new StatusDAO();
                                                        $usuariodao = new UsuarioDAO();
                                                        if ($tipoconsulta === '1' || $tipoconsulta === '2' || $tipoconsulta === '3') {
                                                            $resultado = $fichadao->BuscarTodosPorStatus($tipoconsulta);
                                                        } elseif ($tipoconsulta === 'descricao') {
                                                            $resultado = $fichadao->BuscarTodosPeloProduto($descricao);
                                                        } elseif ($dtinicio != null || $dtfim != null) {
                                                            $resultado = $fichadao->BuscarTodosPorPeriodo($dtinicio, $dtfim);
                                                        } elseif ($tipoconsulta === 'nrserie') {
                                                            $resultado = $fichadao->BuscarTodosPelaSerie($descricao);
                                                        } elseif ($tipoconsulta === 'nrordem') {
                                                            $resultado = $fichadao->BuscarTodosPelaOrdem($descricao);
                                                        } elseif ($ver != null) {
                                                            $resultado = $fichadao->BuscarTodosPorStatus(2);
                                                        }
                                                        foreach ($resultado as $d) {
                                                            $nm_produto = $produtodao->VerificaSeProdutoExiste($d->getProdutoId());
                                                            $nm_status = $s->BuscarNomeStatus($d->getStatusId());
                                                            $id_funcionario = $historicoDao->BuscarTodosHistoricoFuncionario($d->getId());
                                                            $nm_funcionario = $usuariodao->BuscarNomeFuncionario($id_funcionario->getFuncionarioId());
                                                            ?>
                                                            <?php if ($d->getDataFim() <= $data_banco && $d->getStatusId() == '2') {
                                                                ?>
                                                                <tr style="background-color: #F5D76E">
                                                                <?php } elseif ($d->getStatusId() == '3') { ?>
                                                                <tr style="background-color: #f2838f">
                                                                <?php } else { ?>
                                                                <tr>
                                                                    <?php ?>
                                                                <?php } ?>
                                                                <td><?= $d->getId() ?></td>
                                                                <td><?= $nm_produto->getNome() ?></td>
                                                                <td><?= date("d/m/Y", strtotime($d->getDataInicio())) ?></td>
                                                                <td><?= date("d/m/Y", strtotime($d->getDataFim())) ?></td>
                                                                <td><?= $nm_status->getDescricao() ?></td>
                                                                <td><?= $nm_funcionario->getNome() ?></td>
                                                                <td><a href="cadastro-edit.php?id=<?= $d->getId() ?>"><button class="btn btn-sm btn-primary"><i class="glyphicon glyphicon-edit"></i> </button></a>
                                                                    <a href="relatorio.php?id=<?=$d->getId()?>" target="_blank"><button class="btn btn-sm btn-info  "><i class="glyphicon glyphicon-print"></i></button></a>
                                                                    <button class="btn btn-sm btn-info" data-toggle="modal" data-target="#historico<?= $d->getId() ?>"><i class="fa fa-eye" aria-hidden="true"></i></button> 
                                                                    <?php if ($id_permissao == 1 || $id_permissao == 6 || $id_permissao == 2 ) { ?>
                                                                    <button class="btn btn-sm btn-danger" data-toggle="modal" data-target="#deletar<?= $d->getId() ?>"><i class="glyphicon glyphicon-trash"></i></button> </td>
                                                                        <?php
                                                                    } else {
                                                                        
                                                                    }
                                                                    ?>                                                                    

                                                            </tr>
                                                        </tbody>
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
                                                                        $historicoDao = new HistoricoFichaTecnicaDAO();
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
                                                                            }if ($nome_status->getDescricao() == 'CONCLUIDO') {
                                                                                ?>
                                                                                <li class="list-group-item"><span class="badge badge-success"><?= $nome_status->getDescricao() ?></span><b><?= strtoupper($nome_funcionario->getNome()) ?></b> - <?= date('d/m/Y H:i:s', strtotime($his->getData())) ?></li>
                                                                                <?php
                                                                            }if ($nome_status->getDescricao() == 'CANCELADO') {
                                                                                ?>
                                                                                <li class="list-group-item"><span class="badge badge-danger"><?= $nome_status->getDescricao() ?></span><b><?= strtoupper($nome_funcionario->getNome()) ?></b> - <?= date('d/m/Y H:i:s', strtotime($his->getData())) ?></li>
                                                                            <?php } if ($nome_status->getDescricao() == '') {
                                                                                ?>
                                                                                <li class="list-group-item"><span class="badge badge-warning"><?= $nome_status->getDescricao() ?></span><b><?= strtoupper($nome_funcionario->getNome()) ?></b> - <?= date('d/m/Y H:i:s', strtotime($his->getData())) ?></li>
                                                                                <?php
                                                                            } if ($nome_status->getDescricao() == 'ALTERAÇÃO - RIGIDEZ DIELÉTRICA') {
                                                                                ?>
                                                                                <li class="list-group-item"><span class="badge badge-warning"><?= $nome_status->getDescricao() ?></span><b><?= strtoupper($nome_funcionario->getNome()) ?></b> - <?= date('d/m/Y H:i:s', strtotime($his->getData())) ?></li>
                                                                                <?php
                                                                            } if ($nome_status->getDescricao() == 'ALTERAÇÃO - MONTAGEM') {
                                                                                ?>
                                                                                <li class="list-group-item"><span class="badge badge-warning"><?= $nome_status->getDescricao() ?></span><b><?= strtoupper($nome_funcionario->getNome()) ?></b> - <?= date('d/m/Y H:i:s', strtotime($his->getData())) ?></li>
                                                                                <?php
                                                                            } if ($nome_status->getDescricao() == 'ALTERAÇÃO - CORRENTE DE FUGA') {
                                                                                ?>
                                                                                <li class="list-group-item"><span class="badge badge-warning"><?= $nome_status->getDescricao() ?></span><b><?= strtoupper($nome_funcionario->getNome()) ?></b> - <?= date('d/m/Y H:i:s', strtotime($his->getData())) ?></li>
                                                                                <?php
                                                                            } if ($nome_status->getDescricao() == 'ALTERAÇÃO - TESTE FUNCIONAL') {
                                                                                ?>
                                                                                <li class="list-group-item"><span class="badge badge-warning"><?= $nome_status->getDescricao() ?></span><b><?= strtoupper($nome_funcionario->getNome()) ?></b> - <?= date('d/m/Y H:i:s', strtotime($his->getData())) ?></li>
                                                                                <?php
                                                                            } if ($nome_status->getDescricao() == 'ALTERAÇÃO - INSTRUMENTOS') {
                                                                                ?>
                                                                                <li class="list-group-item"><span class="badge badge-warning"><?= $nome_status->getDescricao() ?></span><b><?= strtoupper($nome_funcionario->getNome()) ?></b> - <?= date('d/m/Y H:i:s', strtotime($his->getData())) ?></li>
                                                                                <?php
                                                                            } if ($nome_status->getDescricao() == 'CADASTRO - MONTAGEM') {
                                                                                ?>
                                                                                <li class="list-group-item"><span class="badge badge-success"><?= $nome_status->getDescricao() ?></span><b><?= strtoupper($nome_funcionario->getNome()) ?></b> - <?= date('d/m/Y H:i:s', strtotime($his->getData())) ?></li>
                                                                                <?php
                                                                            } if ($nome_status->getDescricao() == 'CADASTRO - RIGIDEZ DIELÉTRICA') {
                                                                                ?>
                                                                                <li class="list-group-item"><span class="badge badge-success"><?= $nome_status->getDescricao() ?></span><b><?= strtoupper($nome_funcionario->getNome()) ?></b> - <?= date('d/m/Y H:i:s', strtotime($his->getData())) ?></li>
                                                                                <?php
                                                                            } if ($nome_status->getDescricao() == 'CADASTRO - CORRENTE DE FUGA') {
                                                                                ?>
                                                                                <li class="list-group-item"><span class="badge badge-success"><?= $nome_status->getDescricao() ?></span><b><?= strtoupper($nome_funcionario->getNome()) ?></b> - <?= date('d/m/Y H:i:s', strtotime($his->getData())) ?></li>
                                                                                <?php
                                                                            } if ($nome_status->getDescricao() == 'CADASTRO - TESTE FUNCIONAL') {
                                                                                ?>
                                                                                <li class="list-group-item"><span class="badge badge-success"><?= $nome_status->getDescricao() ?></span><b><?= strtoupper($nome_funcionario->getNome()) ?></b> - <?= date('d/m/Y H:i:s', strtotime($his->getData())) ?></li>
                                                                                <?php
                                                                            } if ($nome_status->getDescricao() == 'CADASTRO - INSTRUMENTOS') {
                                                                                ?>
                                                                                <li class="list-group-item"><span class="badge badge-success"><?= $nome_status->getDescricao() ?></span><b><?= strtoupper($nome_funcionario->getNome()) ?></b> - <?= date('d/m/Y H:i:s', strtotime($his->getData())) ?></li>
                                                                                <?php
                                                                            } if ($nome_status->getDescricao() == 'CADASTRO - LIBERAÇÃO') {
                                                                                ?>
                                                                                <li class="list-group-item"><span class="badge badge-success"><?= $nome_status->getDescricao() ?></span><b><?= strtoupper($nome_funcionario->getNome()) ?></b> - <?= date('d/m/Y H:i:s', strtotime($his->getData())) ?></li>
                                                                                <?php
                                                                            }
                                                                        }
                                                                        ?>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </div>
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
                                                                        <a href="../../Controller/FichaTecnicaControll.php?deletar=<?= $d->getId() ?>"<button class="btn btn-success">SIM</button></a>
                                                                        <button class="btn btn-danger" class="close" data-dismiss="modal">NÃO</button>
                                                                    </center>
                                                                    <br>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <?php
                                                    }
                                                    ?>
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
                if (x === "descricao" || x === "nrserie" || x === "nrordem") {
                    document.getElementById("demo").innerHTML = " <div class='col-md-4'>" +
                            "<label></label>" +
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
                if (x === "1" || x === "2" || x === "3") {
                    document.getElementById("demo").innerHTML = "";
                }
            }
        </script>   
    </body>
</html>
<!--                                                <select class="form-control">
                                                    <option value="">Pendente</option>
                                                    <option value="">Concluido</option>
                                                    <option value="">Cancelada</option>
                                                    <option value="">Produto</option>
                                                    <option value="">Nr. da Ordem</option>
                                                    <option value="">Nr. de Série</option>
                                                    <option value="">Periodo</option>
                                                </select>-->