<?php
include_once '../../AutoLoad/AutoLoad.php';


$ddo = new DocumentoDAO();
$tdao = new TipoDocumentoDAO();
$sdao = new StatusDAO();

$tipoconsulta = filter_input(INPUT_POST, 'tipoconsulta');
$descricao = filter_input(INPUT_POST, 'descricao');
$dtinicio = filter_input(INPUT_POST, 'dtinicio');
$dtfim = filter_input(INPUT_POST, 'dtfim');

$dt = date("Y-m-d");

$mss = $ddo->VerificaValidade($dt);

?>
<!DOCTYPE html>
<html>
    <head>
        <title>Documentos</title>
        <?php include '../estrutura/head.php'; ?>
    </head>
    <body>
        <?php include '../estrutura/menu.php'; ?>
        <?php
        if ($id_permissao == 1 || $id_permissao == 6 || $id_permissao == 2 || $id_permissao == 4 || $id_permissao == 8|| $id_permissao == 3|| $id_permissao == 5|| $id_permissao == 7) {
            
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
                    <?php include '../estrutura/mensagens.php' ?>
                    <?php if ($mss->getId() != null) {?>
                         <div class="alert alert-warning alert-dismissable">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                            <strong>ATENÇÃO! </strong>  Você possui Documentos Vencidos!.
                        </div>
                   <?php }?>
                    <div class="panel panel-default">
                        <div class="panel-heading" id="documento">
                            <h3 class="panel-title"><a href="javascript:void(0);" class="toggle-sidebar"><span class="fa fa-angle-double-left" data-toggle="offcanvas" title="Esconder Menu"></span></a> Documentos</h3>
                        </div>
                        <div class="panel-body">
                            <div class="content-row">
                                <div class="row">
                                    <div class="col-md-12">
                                        <h2 class="content-row-title">Documentos Cadastrados</h2>
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
                                                    <select class="form-control" name="tipoconsulta" id="mySelect" onchange="myFunction()">
                                                        <option value="2">Pendente</option>
                                                        <option value="4">Aprovado</option>
                                                        <option value="5">Reprovado</option>
                                                        <option id="Periodo" value="Periodo">Período</option>
                                                        <option id="Setor" value="Setor">Tipo de Documento</option>
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
                                                            <th>Tp. Documento</th>
                                                            <!--<th>Descrição</th>-->
                                                            <th>Autor</th>
                                                            <th>Dt. Revisão</th>
                                                            <th>Dt. Validade</th>
                                                            <th>Status</th>
                                                            <th></th>

                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        $resultado = $ddo->BuscarTodos();
                                                        if ($tipoconsulta === '2' || $tipoconsulta === '4' || $tipoconsulta === '5') {
                                                            $resultado = $ddo->BuscarTodosStatus($tipoconsulta);
                                                        } elseif ($descricao != null) {
                                                            $resultado = $ddo->BuscarTodosTipoDocumento($descricao);
                                                        } elseif ($dtinicio != null || $dtfim != null) {
                                                            $resultado = $ddo->BuscarTodosPeriodo($dtinicio, $dtfim);
                                                        }

                                                        foreach ($resultado as $dados) {
                                                            $arquivo = new ArquivoDAO();
                                                            $arq = $arquivo->BuscaroUltimoParaImprimir($dados->getId());
                                                            
                                                            $nm_tipo = $tdao->BuscarNome($dados->getTipoDocumentoId());
                                                            $nm_status = $sdao->BuscarNomeStatus($dados->getStatusId());
                                                            ?>
                                                            <?php if ($dados->getDataValidade() <= $data_banco) { 
                                                                $mss = 1?>
                                                        <tr style="background-color: #f2838f">
                                                                <?php } else { ?>
                                                                <tr>
                                                                <?php } ?>
                                                                <td><?= $dados->getId() ?></td>
                                                                <td><?= $nm_tipo->getDescricao() ?></td>
                                                                <!--<td><?php // $dados->getDescricao()         ?></td>-->
                                                                <td><?= $dados->getAutor() ?></td>
                                                                <td><?= date("d/m/Y", strtotime($dados->getDataRevisao())) ?></td>
                                                                <td><?= date("d/m/Y", strtotime($dados->getDataValidade())) ?></td>
                                                                <td><?= $nm_status->getDescricao() ?></td>
                                                                <td><a href="../documentos/editar.php?id=<?= $dados->getId() ?>"><button class="btn btn-sm btn-primary"><i class="glyphicon glyphicon-edit"></i> </button></a>
                                                                    <a href="../<?=$arq->getCaminho()?>" target="_blank"><button class="btn btn-sm btn-info  "><i class="glyphicon glyphicon-print"></i></button></a>
                                                                    <button class="btn btn-sm btn-info" data-toggle="modal" data-target="#historico<?= $dados->getId() ?>"><i class="fa fa-eye" aria-hidden="true"></i></button> 
                                                                    <?php if ($id_permissao == 1 || $id_permissao == 6 || $id_permissao == 2 || $id_permissao == 4 || $id_permissao == 7) { ?>

                                                                    <button class="btn  btn-sm btn-danger" data-toggle="modal" data-target="#deletar<?= $dados->getId() ?>"><i class="glyphicon glyphicon-trash"></i></button> </td>
                                                                        <?php
                                                                    } else {
                                                                        
                                                                    }
                                                                    ?>  
                                                            </tr>
                                                        </tbody>
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
                                                                        $historicoDao = new HistoricoDocumentosDAO();
                                                                        $status = new StatusDAO();
                                                                        foreach ($historicoDao->BuscarTodosHistorico($dados->getId()) as $his) {
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
                                                                                <?php
                                                                            }if ($nome_status->getDescricao() == 'EXCLUSÃO DE DOCUMENTO') {
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
                                                        <div class="modal fade" id="deletar<?= $dados->getId() ?>" role="dialog">
                                                            <div class="modal-dialog">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                                        <center><h4 class="modal-title">Mensagem de Confirmação</h4></center>
                                                                    </div>
                                                                    <center>
                                                                        <strong>DESEJA REALMENTE EXCLUIR?</strong><br><br>
                                                                        <a href="../../Controller/DocumentoControll.php?deletar=<?= $dados->getId() ?>"<button class="btn btn-success">SIM</button></a>
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
