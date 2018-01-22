<?php
include_once '../../../Config/ConexaoPDO.php';
include_once '../../DAO/FornecedorDAO.php';
include_once '../../DAO/MateriaPrimaDAO.php';
include_once '../../Model/Fornecedor.php';
include_once '../../Model/MateriaPrima.php';

$fornecedorDao = new FornecedorDAO();
$materiaprimaDao = new MateriaPrimaDAO();

$pesquisar = filter_input(INPUT_POST, 'pesquisa');
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Matéria-Prima</title>
        <?php include '../estrutura/head.php'; ?>
    </head>
    <body>
    <head>
        <?php include '../estrutura/menu.php'; ?>
        <?php
        if ($id_permissao == 1 || $id_permissao == 6 || $id_permissao == 2 || $id_permissao == 4) {
            
        } else {
            header('Location: ../pri/principal.php?msg=12');
        }
        ?>
    </head>
    <!--header-->
    <div class="container-fluid">
        <!--documents-->
        <div class="row row-offcanvas row-offcanvas-left">
            <?php include '../estrutura/menulateral.php'; ?>
            <div class="col-xs-12 col-sm-9 content">
                <?php include '../estrutura/mensagens.php'; ?>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title"><a href="javascript:void(0);" class="toggle-sidebar"><span
                                    class="fa fa-angle-double-left" data-toggle="offcanvas"
                                    title="Esconder Menu"></span></a> Matéria-Prima</h3>
                    </div>
                    <div class="panel-body">
                        <div class="content-row">
                            <div class="row">
                                <div class="col-md-12">
                                    <h2 class="content-row-title">Matéria-Prima Cadastradas</h2>
                                    <div class="row">
                                        <div class="col-md-2">
                                            <a href="../inspecao/materia-prima.php"><button type="button" class="btn btn-info " ><i class="glyphicon glyphicon-plus"></i>
                                                    Cadastrar
                                                </button></a>
                                        </div>
                                    </div>
                                    <hr>
                                    <form method="POST">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <label>Nome</label>
                                                <input type="text" name="pesquisa" class="form-control">

                                            </div>
                                            <div class="col-md-1">
                                                <br>
                                                <button type="submit" class="btn btn-warning"><span
                                                        class="glyphicon glyphicon-search"></span> Pesquisar
                                                </button>
                                            </div>
                                        </div>
                                    </form>

                                    <br>
                                    <div class="row">
                                        <div class="table-responsive">
                                            <table class="table">
                                                <thead>
                                                    <tr>
                                                        <th>Cod.</th>
                                                        <th>Nome</th>
                                                        <th>Fornecedor</th>
                                                        <th>Situação</th>
                                                        <th></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $result = $materiaprimaDao->BuscarTodos();
                                                    if ($pesquisar != null) {
                                                        $result = $materiaprimaDao->BuscarTodosDescricao($pesquisar);
                                                    }
                                                    foreach ($result as $mDao) {
                                                        $nm_fornecedor = $fornecedorDao->BuscarNome($mDao->getFornecedorId());
                                                        ?>
                                                        <tr>
                                                            <td><?= $mDao->getId() ?></td>
                                                            <td><?= $mDao->getNome() ?></td>
                                                            <td><?= $nm_fornecedor->getNome() ?></td>
                                                            <td><?php
                                                                if ($mDao->getSituacao() == 'A') {
                                                                    echo 'ATIVO';
                                                                } else {
                                                                    echo 'INATIVO';
                                                                }
                                                                ?>
                                                            </td>
                                                            <td>
                                                                <a href="../inspecao/materia-prima-edit.php?id=<?= $mDao->getId() ?>">
                                                                    <button class="btn btn-sm btn-primary">
                                                                        <i class="glyphicon glyphicon-edit"></i>
                                                                    </button></a>
                                                                <button class="btn btn-sm btn-danger"
                                                                        data-toggle="modal"
                                                                        data-target="#deletar<?= $mDao->getId() ?>"><i
                                                                        class="glyphicon glyphicon-trash"></i>
                                                                </button>
                                                            </td>
                                                        </tr>
                                                    <div class="modal fade" id="deletar<?= $mDao->getId() ?>"
                                                         role="dialog">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <button type="button" class="close"
                                                                            data-dismiss="modal">&times;
                                                                    </button>
                                                                    <center><h4 class="modal-title">Mensagem de
                                                                            Confirmação</h4></center>
                                                                </div>
                                                                <center>
                                                                    <strong>DESEJA REALMENTE
                                                                        EXCLUIR?</strong><br><br>
                                                                    <a href="../../Controller/MateriaPrimaControll.php?deletar=<?= $mDao->getId() ?>"
                                                                       <button class="btn btn-success">SIM</button>
                                                                    </a>
                                                                    <button class="btn btn-danger" class="close"
                                                                            data-dismiss="modal">NÃO
                                                                    </button>
                                                                </center>
                                                                <br>
                                                            </div>
                                                        </div>
                                                    </div>

                                                <?php } ?>
                                                </tbody>
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
</html>
