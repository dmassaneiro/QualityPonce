<?php
include_once '../../../Config/ConexaoPDO.php';
include_once '../../DAO/CategoriaDAO.php';
include_once '../../Model/Categoria.php';

$setorDao = new CategoriaDAO();
$pesquisa = filter_input(INPUT_POST, 'pesquisa');
?>


<!DOCTYPE html>
<html>
    <head>
        <title>Categoria</title>
        <?php include '../estrutura/head.php'; ?>
    </head>
    <body>
        <?php include '../estrutura/menu.php'; ?>
         <?php
        if ($id_permissao == 1 || $id_permissao == 6 || $id_permissao == 2 || $id_permissao == 4) {
            
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
                            <h3 class="panel-title"><a href="javascript:void(0);" class="toggle-sidebar"><span class="fa fa-angle-double-left" data-toggle="offcanvas" title="Esconder Menu"></span></a> Categoria</h3>
                        </div>
                        <div class="panel-body">
                            <div class="content-row">
                                <div class="row">
                                    <div class="col-md-12">
                                        <h2 class="content-row-title">Categorias de Produtos Cadastradas</h2>
                                        <div class="row">
                                            <div class="col-md-2">
                                                <button type="button" class="btn btn-info " data-toggle="modal" data-target="#add"><i class="glyphicon glyphicon-plus"></i> Cadastrar</button>
                                            </div>
                                        </div>
                                        <br>
                                        <div class="modal fade" id="add" role="dialog">
                                            <div class="modal-dialog" >
                                                <!-- Modal content-->
                                                <form name="forme" action="../../Controller/CategoriaControll.php" method="POST">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                            <center><h4 class="modal-title">Cadastro de Categoria de Produto</h4></center>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="col-md-7">
                                                                <label>Descrição</label>
                                                                <input type="text" class="form-control" name="descricao" required="">
                                                            </div>
                                                            <div class="col-md-8">
                                                                <br>
                                                                <br>
                                                                <button type="submit" name="gravar" class="btn btn-success">Gravar</button>
                                                            </div>
                                                            <div class="row"></div>
                                                            <br>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                        <form method="POST">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <label>Descrição</label>
                                                    <input type="text" class="form-control" name="pesquisa">
                                                </div>
                                                <div class="col-md-1">
                                                    <br>
                                                    <button type="submit" class="btn btn-warning"><span class="glyphicon glyphicon-search"></span> Pesquisar</button>
                                                </div>
                                            </div>
                                        </form>
                                        <br>
                                        <div class="row">
                                            <table class="table">
                                                <thead>
                                                    <tr>
                                                        <th>Cod.</th>
                                                        <th>Descrição</th>
                                                        <th></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $resultado = $setorDao->BuscarTodosCategoria();
                                                    if ($pesquisa != '') {
                                                        $resultado = $setorDao->BuscarTodosNome($pesquisa);
                                                    }
                                                    foreach ( $resultado as $nc) {
                                                        ?>
                                                        <tr>
                                                            <td><?= $nc->getId() ?></td>
                                                            <td><?= $nc->getDescricao() ?></td>
                                                            <td><button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#edit<?= $nc->getId() ?>" style=" float:left; margin: 0 4px 0 0;"><i class="glyphicon glyphicon-edit"></i> </button>
                                                                <a href="../../Controller/CategoriaControll.php?del=<?= $nc->getId() ?>">
                                                                    <button class="btn btn-sm btn-danger"><i class="glyphicon glyphicon-trash"></i></button></a> </td> 
                                                        </tr>
                                                    <div class="modal fade" id="edit<?= $nc->getId() ?>" role="dialog">
                                                        <div class="modal-dialog">
                                                            <!-- Modal content-->
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                                    <center><h4 class="modal-title">Editar Setor</h4></center>
                                                                </div>
                                                                <form action="../../Controller/CategoriaControll.php" method="POST">
                                                                    <div class="modal-body">

                                                                        <input type="hidden"  name="id" value="<?= $nc->getId() ?>">

                                                                        <div class="col-md-7">
                                                                            <label>Descrição</label>
                                                                            <input type="text" class="form-control" name="descricao" value="<?= $nc->getDescricao() ?>">
                                                                        </div>

                                                                        <div class="col-md-8">
                                                                            <br>
                                                                            <br>

                                                                            <button type="submit" name="editar" class="btn btn-warning ">Editar</button>
                                                                        </div>
                                                                        <div class="row"></div>
                                                                        <br>
                                                                    </div>
                                                            </div>
                                                            </form>
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
    </body>
</html>
