<?php
include_once '../../AutoLoad/AutoLoad.php';

$adao = new AvaliacaoDAO();
$acdao = new AvaliacaoCriterioDAO();
$fdao = new FornecedorDAO();
$sdao = new StatusDAO();
$cfdao = new CriterioFornecedorDAO();

$tipoconsulta = filter_input(INPUT_POST, 'tipoconsulta');
$descricao = filter_input(INPUT_POST, 'descricao');
$dtinicio = filter_input(INPUT_POST, 'dtinicio');
$dtfim = filter_input(INPUT_POST, 'dtfim');
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Avaliação de Fornecedor</title>
        <?php include '../estrutura/head.php'; ?>
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.16/datatables.min.css"/>

        <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.16/datatables.min.js"></script>

    </head>
    <body>
        <?php include '../estrutura/menu.php'; ?>
          <?php
        if ($id_permissao == 1 || $id_permissao == 6 || $id_permissao == 4 || $id_permissao == 5 || $id_permissao == 2 || $id_permissao == 8 || $id_permissao == 7 ) {
            
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
                            <h3 class="panel-title"><a href="javascript:void(0);" class="toggle-sidebar"><span class="fa fa-angle-double-left" data-toggle="offcanvas" title="Esconder Menu"></span></a> Fornecedor</h3>
                        </div>
                        <div class="panel-body">
                            <div class="content-row">
                                <div class="row">
                                    <div class="col-md-12">
                                        <h2 class="content-row-title">Avaliações Cadastradas</h2>
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
                                                        <option value="1">CONCLUIDO</option>
                                                        <option value="2">PENDENTE</option>
                                                        <option value="3">CANCELADO</option>
                                                        <option id="Periodo" value="Periodo">PERÍODO</option>
                                                        <option id="Setor" value="descricao">DESCRIÇÃO</option>
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
                                                        <th>Data</th>
                                                        <th>Pontuação Total</th>
                                                        <th>Pontuação Adquirida</th>
                                                        <th>Status</th>

                                                        <th></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <?php
                                                        $result = $adao->BuscarTodos();
                                                        foreach ($result as $d) {
                                                            $nm_fornecedor = $fdao->BuscarNome($d->getFornecedorId());
                                                            $nm_status = $sdao->BuscarNomeStatus($d->getStatusId());
                                                            $peso = $cfdao->BuscarNotaPesoTtal($d->getId())
                                                            ?>
                                                            <td><?= $d->getId() ?></td>
                                                            <td><?= $nm_fornecedor->getNome() ?></td>
                                                            <td><?= date("d/m/Y", strtotime($d->getData())) ?></td>
                                                            <td><?= $peso->getNotaPeso() ?></td>
                                                            <td><?= round($d->getMedia()) ?></td>
                                                            <td><?= $nm_status->getDescricao() ?></td>

                                                            <td><a href="../fornecedor/editar.php?id=<?= $d->getId() ?>"><button class="btn btn-sm btn-primary" style=" float:left; margin: 0 4px 0 0;"><i class="glyphicon glyphicon-edit"></i> </button></a>
                                                                <a href="relatorio.php?id=<?= $d->getId() ?>"><button class="btn btn-sm btn-info  "><i class="glyphicon glyphicon-print"></i></button></a>
                                                                <?php if ($id_permissao == 1 || $id_permissao == 6 || $id_permissao == 2 || $id_permissao == 7) { ?>

                                                                <button class="btn btn-sm btn-danger" data-toggle="modal" data-target="#deletar<?= $d->getId() ?>"><i class="glyphicon glyphicon-trash"></i></button> </td>
                                                                        <?php
                                                                    } else {
                                                                        
                                                                    }
                                                                    ?>  
                                                        </tr>
                                                    </tbody>
                                                    <div class="modal fade" id="deletar<?= $d->getId() ?>" role="dialog">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                                    <center><h4 class="modal-title">Mensagem de Confirmação</h4></center>
                                                                </div>
                                                                <center>
                                                                    <strong>DESEJA REALMENTE EXCLUIR?</strong><br><br>
                                                                    <a href="../../Controller/AvaliacaoControll.php?deletar=<?= $d->getId() ?>"<button class="btn btn-success">SIM</button></a>
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
    </body>
    <script>
        $(document).ready(function () {
            $('#example').DataTable();
        });
        function myFunction() {
            var x = document.getElementById("mySelect").value;
            if (x === "descricao") {
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
</html>
