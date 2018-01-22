<?php
include_once '../../AutoLoad/AutoLoad.php';

$setordao = new SetorDAO;
$usuariodao = new UsuarioDAO;
$funcionariodao = new FuncionarioDAO();
$pdao = new ProdutoDAO();

$pesquisa = filter_input(INPUT_POST, 'pesquisa');
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Modo</title>
        <?php include '../estrutura/head.php'; ?>
    </head>
    <body>
        <?php include '../estrutura/menu.php'; ?>
         <?php
        if ($id_permissao == 1 || $id_permissao == 6 || $id_permissao == 2) {
            
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
                            <h3 class="panel-title"><a href="javascript:void(0);" class="toggle-sidebar"><span class="fa fa-angle-double-left" data-toggle="offcanvas" title="Esconder Menu"></span></a> Modo</h3>
                        </div>
                        <div class="panel-body">
                            <div class="content-row">
                                <div class="row">
                                    <div class="col-md-12">
                                        <h2 class="content-row-title">Modos Cadastrados</h2>
                                        <div class="row">
                                            <div class="col-md-2">
                                                <button type="button" class="btn btn-info " data-toggle="modal" data-target="#add"><i class="glyphicon glyphicon-plus"></i> Cadastrar</button>
                                            </div>
                                        </div>
                                        <br>
                                        <div class="modal fade" id="add" role="dialog">
                                            <div class="modal-dialog" >
                                                <!-- Modal content-->
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                        <center><h4 class="modal-title">Cadastro de Modo</h4></center>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="../../Controller/ModoControll.php" method="POST">
                                                            <div class="col-md-12">
                                                                <label>Descricao</label>
                                                                <input type="text" class="form-control" name="descricao" required="">
                                                            </div>

                                                            <div class="col-md-5">
                                                                <label>Situação</label>
                                                                <select class="form-control" name="situacao">
                                                                    <option value="A">ATIVO</option>
                                                                    <option value="I">INATIVO</option>
                                                                </select>
                                                            </div>
                                                            <div class="col-md-12">
                                                                <br>
                                                                <button name="gravar" type="submit" class="btn btn-success ">Gravar</button>
                                                            </div>
                                                            <div class="row"></div>
                                                            <br>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <form action="" method="POST">
                                                <div class="col-md-4">
                                                    <label>Nome</label>
                                                    <input type="text" name="pesquisa" class="form-control">
                                                </div>
                                                <div class="col-md-1">
                                                    <br>
                                                    <button type="submit" class="btn btn-warning"><span class="glyphicon glyphicon-search"></span> Pesquisar</button>
                                                </div>
                                            </form>
                                        </div>
                                        <br>
                                        <div class="row">
                                            <div class="table-responsive">
                                                <table class="table">
                                                    <thead>
                                                        <tr>
                                                            <th>Cod.</th>
                                                            <th>Descrição</th>
                                                            <th>Situação</th>
                                                            <th></th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <?php
                                                            $idao = new ModoDAO();
                                                            $resultado = $idao->BuscarTodos2();
//                                                        echo $pesquisa;
                                                            if ($pesquisa != null) {
                                                                $resultado = $idao->BuscarTodosporDescricao($pesquisa);
                                                            }

                                                            foreach ($resultado as $d) {
//                                                                $nm_produto = $pdao->BuscaNomedoProduto($d->getProdutoId());
                                                                ?>
                                                                <td><?= $d->getId() ?></td>
                                                                <td><?= strtoupper($d->getDescricao()) ?></td>
                                                                
                                                                <td>
                                                                    <?php
                                                                    if ($d->getSituacao() == 'A') {
                                                                        echo 'ATIVO';
                                                                    } if ($d->getSituacao() == 'I') {
                                                                        echo 'INATIVO';
                                                                    }
                                                                    ?>
                                                                </td>
                                                                <td><button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#edit<?= $d->getId() ?>" ><i class="glyphicon glyphicon-edit"></i> </button>
                                                                    <button class="btn btn-sm btn-danger" data-toggle="modal" data-target="#deletar<?= $d->getId() ?>"><i class="glyphicon glyphicon-trash"></i></button> </td>   
                                                            </tr>
                                                        <div class="modal fade" id="edit<?= $d->getId() ?>" role="dialog">
                                                            <div class="modal-dialog">

                                                                <!-- Modal content-->
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                                        <center><h4 class="modal-title">Editar Modo</h4></center>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <form action="../../Controller/ModoControll.php" method="POST">
                                                                            <div class="col-md-12">
                                                                                <label>Descrição</label>
                                                                                <input type="text" class="form-control" name="descricao" required="" value="<?= $d->getDescricao(); ?>">
                                                                                <input type="hidden"  name="cod" value="<?= $d->getId() ?>">
                                                                            </div>
                                                                                                                 <div class="col-md-5">
                                                                                <label>Situação</label>
                                                                                <select class="form-control" name="situacao">
                                                                                    <?php if ($d->getSituacao() == 'A') { ?>
                                                                                        <option value="A">ATIVO</option>
                                                                                        <option value="I">INATIVO</option>
                                                                                    <?php } if ($d->getSituacao() == 'I') { ?>
                                                                                        <option value="I">INATIVO</option>
                                                                                        <option value="A">ATIVO</option>
                                                                                    <?php } ?>

                                                                                </select>
                                                                            </div>
                                                                            <div class="col-md-12">
                                                                                <br>
                                                                                <button name="editar" type="submit" class="btn btn-success ">Gravar</button>
                                                                            </div>
                                                                            <div class="row"></div>
                                                                            <br>
                                                                        </form>
                                                                    </div>
                                                                </div>

                                                            </div>
                                                        </div>
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
                                                                        <a href="../../Controller/ModoControll.php?deletar=<?= $d->getId() ?>"<button class="btn btn-success">SIM</button></a>
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
    </div>
</body>
</html>
