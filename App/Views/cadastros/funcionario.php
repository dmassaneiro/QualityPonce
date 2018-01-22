<?php
include_once '../../AutoLoad/AutoLoad.php';

$setordao = new SetorDAO;
$usuariodao = new UsuarioDAO;
$funcionariodao = new FuncionarioDAO();

$pesquisa = filter_input(INPUT_POST, 'pesquisa');
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Funcionários</title>
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
                            <h3 class="panel-title"><a href="javascript:void(0);" class="toggle-sidebar"><span class="fa fa-angle-double-left" data-toggle="offcanvas" title="Esconder Menu"></span></a> Funcionário</h3>
                        </div>
                        <div class="panel-body">
                            <div class="content-row">
                                <div class="row">
                                    <div class="col-md-12">
                                        <h2 class="content-row-title">Funcionários Cadastrados</h2>
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
                                                        <center><h4 class="modal-title">Cadastro de Funcionário</h4></center>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="../../Controller/FuncionarioControll.php" method="POST">
                                                            <div class="col-md-12">
                                                                <label>Nome</label>
                                                                <input type="text" class="form-control" name="nome" required="">
                                                            </div>
                                                            <div class="col-md-5">
                                                                <label>Sexo</label>
                                                                <select class="form-control" name="sexo" required="">
                                                                    <option value="">Selecione...</option>
                                                                    <option value="F">FEMININO</option>
                                                                    <option value="M">MASCULINO</option>
                                                                </select>
                                                            </div>

                                                            <div class="col-md-5">
                                                                <label>Setor</label>
                                                                <select class="form-control" name="setor" required="">
                                                                    <option value="">Selecione...</option>
                                                                    <?php
                                                                    foreach ($setordao->BuscarTodosSetores() as $setor) {
                                                                        ?>
                                                                        <option value="<?= $setor->getId() ?>"><?= $setor->getDescricao() ?></option>
                                                                    <?php } ?>
                                                                </select>
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
                                            <table class="table">
                                                <thead>
                                                    <tr>
                                                        <th>Cod.</th>
                                                        <th>Nome</th>
                                                        <th>Setor</th>
                                                        <th>Situação</th>
                                                        <th></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <?php
                                                        $resultado = $funcionariodao->BuscarTodosFuncionario();
//                                                        echo $pesquisa;
                                                        if ($pesquisa != null) {
                                                            $resultado = $funcionariodao->BuscarTodosFuncionarioNome($pesquisa);
                                                        }
                                                        foreach ($resultado as $func) {
//                                                            echo $func->getId();
                                                            $nm_setor = $setordao->BuscarNomeSetor($func->getSetorId());
                                                            ?>
                                                            <td><?= $func->getId() ?></td>
                                                            <td><?= strtoupper($func->getNome())?></td>
                                                            <td><?= $nm_setor->getDescricao() ?></td>
                                                            <td>
                                                                <?php
                                                                if ($func->getSituacao() == 'A') {
                                                                    echo 'ATIVO';
                                                                } else {
                                                                    echo 'INATIVO';
                                                                }
                                                                ?>
                                                            </td>
                                                            <td><button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#edit<?= $func->getId() ?>" style=" float:left; margin: 0 4px 0 0;"><i class="glyphicon glyphicon-edit"></i> </button>
                                                                <button class="btn btn-sm btn-danger" data-toggle="modal" data-target="#deletar<?= $func->getId() ?>"><i class="glyphicon glyphicon-trash"></i></button> </td>   
                                                        </tr>
                                                    <div class="modal fade" id="edit<?= $func->getId() ?>" role="dialog">
                                                        <div class="modal-dialog">

                                                            <!-- Modal content-->
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                                    <center><h4 class="modal-title">Editar Funcionário</h4></center>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <form action="../../Controller/FuncionarioControll.php" method="POST">
                                                                        <div class="col-md-12">
                                                                            <label>Nome</label>
                                                                            <input type="text" class="form-control" name="nome" required="" value="<?= $func->getNome(); ?>">
                                                                            <input type="hidden"  name="cod" value="<?= $func->getId() ?>">
                                                                        </div>

                                                                        <div class="col-md-5">
                                                                            <label>Sexo</label>
                                                                            <select class="form-control" name="sexo" required="">
                                                                                <?php if ($func->getSexo() == 'F') { ?>
                                                                                    <option value="F">FEMININO</option>
                                                                                    <option value="M">MASCULINO</option>
                                                                                <?php } else { ?>
                                                                                    <option value="M">MASCULINO</option>
                                                                                    <option value="F">FEMININO</option>
                                                                                <?php } ?>

                                                                            </select>
                                                                        </div>

                                                                        <div class="col-md-5">
                                                                            <label>Setor</label>
                                                                            <select class="form-control" name="setor" required="">
                                                                                <option value="<?= $func->getSetorId() ?>"><?= $nm_setor->getDescricao() ?></option>
                                                                                <?php
                                                                                foreach ($setordao->BuscarTodosSetoresMenos($func->getSetorId()) as $setor) {
                                                                                    ?>
                                                                                    <option value="<?= $setor->getId() ?>"><?= $setor->getDescricao() ?></option>
                                                                                <?php } ?>
                                                                            </select>
                                                                        </div>
                                                                        <div class="col-md-5">
                                                                            <label>Situação</label>
                                                                            <select class="form-control" name="situacao">
                                                                                <?php if ($func->getSituacao() == 'A') { ?>
                                                                                    <option value="A">ATIVO</option>
                                                                                    <option value="I">INATIVO</option>
                                                                                <?php } else { ?>
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
                                                    <div class="modal fade" id="deletar<?= $func->getId() ?>" role="dialog">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                                    <center><h4 class="modal-title">Mensagem de Confirmação</h4></center>
                                                                </div>
                                                                <center>
                                                                    <strong>DESEJA REALMENTE EXCLUIR?</strong><br><br>
                                                                    <a href="../../Controller/FuncionarioControll.php?deletar=<?= $func->getId() ?>"<button class="btn btn-success">SIM</button></a>
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
