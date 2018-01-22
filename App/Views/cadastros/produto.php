<?php
include_once '../../../Config/ConexaoPDO.php';
include_once '../../DAO/CategoriaDAO.php';
include_once '../../DAO/ProdutoDAO.php';
include_once '../../Model/Categoria.php';
include_once '../../Model/Produto.php';

$categoriaDao = new CategoriaDAO();
$produtoDao = new ProdutoDAO();
?>


<!DOCTYPE html>
<html>
    <head>
        <title>Produtos</title>
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
                            <h3 class="panel-title"><a href="javascript:void(0);" class="toggle-sidebar"><span class="fa fa-angle-double-left" data-toggle="offcanvas" title="Esconder Menu"></span></a> Produtos</h3>
                        </div>
                        <div class="panel-body">
                            <div class="content-row">
                                <div class="row">
                                    <div class="col-md-12">
                                        <h2 class="content-row-title">Produtos Cadastrados</h2>
                                        <div class="row">
                                            <div class="col-md-2">
                                                <button type="button" class="btn btn-info " data-toggle="modal" data-target="#add"><i class="glyphicon glyphicon-plus"></i> Cadastrar</button>
                                            </div>
                                        </div>
                                        <br>
                                        <div class="modal fade" id="add" role="dialog">
                                            <div class="modal-dialog" >
                                                <!-- Modal content-->
                                                <form name="forme" action="../../Controller/ProdutoControll.php" method="POST">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                            <center><h4 class="modal-title">Cadastro de Produto</h4></center>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="col-md-8">
                                                                <label>Nome</label>
                                                                <input type="text" class="form-control" name="nome" required="">
                                                            </div>

                                                            <div class="col-md-7">
                                                                <label>Descrição</label>
                                                                <input type="text" class="form-control" name="descricao" required="">
                                                            </div>
                                                            <div class="col-md-5">
                                                                <label>Categoria</label>
                                                                <select class="form-control" name="categoria" required="">
                                                                    <option>Selecione...</option>
                                                                    <?php
                                                                    foreach ($categoriaDao->BuscarTodosCategoria() as $categoriaDao) {
                                                                        ?>
                                                                        <option value="<?= $categoriaDao->getId() ?>"><?= $categoriaDao->getDescricao() ?></option>
                                                                    <?php } ?>
                                                                </select>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <label>Situação</label>
                                                                <select class="form-control" name="situacao" required="">
                                                                    <option value="A">ATIVO</option>
                                                                    <option value="I">INATIVO</option>
                                                                </select>
                                                            </div>
                                                            <div class="row">
                                                                <br>
                                                            </div>
                                                            <div class="col-md-8">
                                                               
                                                                <button type="submit" name="gravar" class="btn btn-success ">Gravar</button>
                                                            </div>
                                                            <div class="row">
                                                                <br>
                                                            </div>
                                                            <br>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <label>Produto</label>
                                                <input type="text" class="form-control">
                                            </div>
                                            <div class="col-md-1">
                                                <br>
                                                <button type="button" class="btn btn-warning"><span class="glyphicon glyphicon-search"></span> Pesquisar</button>
                                            </div>
                                        </div>
                                        <br>
                                        <div class="row">
                                            <div class="table-responsive">
                                                <table class="table">
                                                    <thead>
                                                        <tr>
                                                            <th>Cod.</th>
                                                            <th>Nome</th>
                                                            <th>Categoria</th>
                                                            <th></th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        foreach ($produtoDao->BuscarTodosProdutos() as $produtoDao) {
                                                            $categoria = new CategoriaDAO();
                                                            $nm_categoria = $categoria->BuscarNomeCategoria($produtoDao->getCategoriaId())
                                                            ?>
                                                            <tr>
                                                                <td><?= $produtoDao->getId() ?></td>
                                                                <td><?= $produtoDao->getNome() ?></td>
                                                                <td><?= $nm_categoria->getDescricao() ?></td>
                                                                <td><button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#edit<?= $produtoDao->getId() ?>"><i class="glyphicon glyphicon-edit"></i> </button>
                                                                    <button class="btn btn-sm btn-danger" data-toggle="modal" data-target="#deletar<?= $produtoDao->getId() ?>"><i class="glyphicon glyphicon-trash"></i></button>  </td> 
                                                            </tr>

                                                        <div class="modal fade" id="edit<?= $produtoDao->getId() ?>" role="dialog">
                                                            <div class="modal-dialog">
                                                                <!-- Modal content-->
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                                        <center><h4 class="modal-title">Editar Produto</h4></center>
                                                                    </div>
                                                                    <form action="../../Controller/ProdutoControll.php" method="POST">
                                                                        <div class="modal-body">
                                                                            <div class="col-md-8">
                                                                                <label>Nome</label>
                                                                                <input type="text" class="form-control" name="nome" value="<?= $produtoDao->getNome() ?>">
                                                                                <input type="hidden"  name="id" value="<?= $produtoDao->getId() ?>">
                                                                            </div>

                                                                            <div class="col-md-7">
                                                                                <label>Descrição</label>
                                                                                <input type="text" class="form-control" name="descricao" value="<?= $produtoDao->getDescricao() ?>">
                                                                            </div>
                                                                            <div class="col-md-5">
                                                                                <label>Categoria</label>
                                                                                <select class="form-control" name="categoria" required="">

                                                                                    <option value="<?= $produtoDao->getCategoriaId() ?>"><?= $nm_categoria->getDescricao() ?></option>
                                                                                    <option value=""></option>
                                                                                    <?php
                                                                                    $cat = new CategoriaDAO();
                                                                                    foreach ($cat->BuscarTodosCategoria() as $categoriaDao) {
                                                                                        ?>
                                                                                        <option value="<?= $categoriaDao->getId() ?>"><?= $categoriaDao->getDescricao() ?></option>
                                                                                    <?php } ?>
                                                                                </select>
                                                                            </div>
                                                                            <div class="col-md-4">
                                                                                <label>Situação</label>
                                                                                <select class="form-control" name="situacao">
                                                                                    <?php
                                                                                    $sit = $produtoDao->getSituacao();
                                                                                    if ($sit == 'A') {
                                                                                        ?>
                                                                                        <option value="A">ATIVO</option>
                                                                                        <option value="I">INATIVO</option>
                                                                                    <?php } elseif ($sit == 'I') { ?>
                                                                                        <option value="I">INATIVO</option>
                                                                                        <option value="A">ATIVO</option>
                                                                                    <?php } ?>
                                                                                </select>
                                                                            </div>
                                                                            <div class="row"></div>
                                                                            <div class="col-md-8">
                                                                                <button type="submit" name="editar" class="btn btn-warning ">Editar</button>
                                                                            </div>
                                                                            <div class="row"></div>
                                                                            <br>
                                                                        </div>
                                                                </div>
                                                                </form>
                                                            </div>

                                                        </div>
                                                        </tbody>
                                                        <div class="modal fade" id="deletar<?= $produtoDao->getId() ?>" role="dialog">
                                                            <div class="modal-dialog">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                                        <center><h4 class="modal-title">Mensagem de Confirmação</h4></center>
                                                                    </div>
                                                                    <center>
                                                                        <strong>DESEJA REALMENTE EXCLUIR?</strong><br><br>
                                                                        <a href="../../Controller/ProdutoControll.php?deletar=<?= $produtoDao->getId() ?>"<button class="btn btn-success">SIM</button></a>
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
</html>
