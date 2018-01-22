<?php
include_once '../../AutoLoad/AutoLoad.php';

$fdao = new FuncionarioDAO();
$pdao = new TipoPermissaoDAO();
$udao = new UsuarioDAO();
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Usuários</title>
        <?php include '../estrutura/head.php'; ?>
        <link href="../select2/select2.min.css" rel="stylesheet" />
        <script src="../select2/select2.min.js"></script>

    </head>
    <body>
        <?php include '../estrutura/menu.php'; ?>
         <?php
        if ($id_permissao == 1) {
            
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
                            <h3 class="panel-title"><a href="javascript:void(0);" class="toggle-sidebar"><span class="fa fa-angle-double-left" data-toggle="offcanvas" title="Esconder Menu"></span></a> Usuários</h3>
                        </div>
                        <div class="panel-body">
                            <div class="content-row">
                                <div class="row">
                                    <div class="col-md-12">
                                        <h2 class="content-row-title">Usuários Cadastrados</h2>
                                        <div class="row">
                                            <div class="col-md-2">
                                                <button type="button" class="btn btn-info " data-toggle="modal" data-target="#add"><i class="glyphicon glyphicon-plus"></i> Cadastrar</button>
                                            </div>
                                        </div>
                                        <br>
                                        <div class="modal fade" id="add" role="dialog">
                                            <form action="../../Controller/UsuarioControll.php" method="POST">
                                                <div class="modal-dialog" >
                                                    <!-- Modal content-->
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                            <center><h4 class="modal-title">Cadastro de Usuário</h4></center>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="col-md-8">
                                                                <label>Funcionário</label>
                                                                <select class="form-control" name="func" required="">
                                                                    <option value="">Selecione...</option>
                                                                    <?php
                                                                    foreach ($fdao->BuscarTodosFuncionarioAtivo() as $pro) {
                                                                        ?>
                                                                        <option value="<?= $pro->getId() ?>"><?= $pro->getNome() ?></option>
                                                                    <?php } ?>
                                                                </select>

                                                            </div>

                                                            <div class="col-md-5">
                                                                <label>Login</label>
                                                                <input type="text" class="form-control" name="login" required="">
                                                            </div>
                                                            <div class="col-md-5">
                                                                <label>Senha</label>
                                                                <input type="password" class="form-control" name="senha" required="">
                                                            </div>
                                                            <div class="col-md-6">
                                                                <label>Tipo de Permisão</label>
                                                                <select class="form-control" name="permissao" required="">
                                                                    <option value="">Selecione...</option>
                                                                    <?php
                                                                    foreach ($pdao->BuscarTodos() as $p) {
                                                                        ?>
                                                                        <option value="<?= $p->getId() ?>"><?= $p->getDescricao() ?></option>
                                                                    <?php } ?>
                                                                </select>
                                                            </div>
                                                            <div class="col-md-12">
                                                                <br>

                                                                <button class="btn btn-success" name="gravar">Gravar</button>
                                                            </div>
                                                            <div class="row">

                                                            </div>
                                                            <br>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <label>Funcionário</label>
                                                <input type="text" class="form-control">
                                            </div>
                                            <div class="col-md-1">
                                                <br>
                                                <button type="button" class="btn btn-warning"><span class="glyphicon glyphicon-search"></span> Pesquisar</button>
                                            </div>
                                        </div>
                                        <br>
                                        <div class="row">
                                            <table class="table">
                                                <thead>
                                                    <tr>
                                                        <th>Cod.</th>
                                                        <th>Nome</th>
                                                        <th>Tp. Acesso</th>
                                                        <th></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $resultado = $udao->BuscarTodos();
                                                    foreach ($resultado as $user) {
                                                        $nm_permissao = $udao->BuscaNomedoPermissao($user->getPermissaoGrupoId());
                                                        $nm_func = $fdao->BuscarNomeFuncionario($user->getFuncionarioId());
                                                        ?>
                                                        <tr>
                                                            <td><?= $user->getId() ?></td>
                                                            <td><?= $nm_func->getNome() ?></td>
                                                            <td><?= $nm_permissao->getDescricao() ?></td>
                                                            <td><button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#edit<?= $user->getId() ?>"><i class="glyphicon glyphicon-edit"></i> </button>
                                                                <button class="btn btn-sm btn-danger" data-toggle="modal" data-target="#deletar<?= $user->getId() ?>"><i class="glyphicon glyphicon-trash"></i></button> </td></td>   
                                                        </tr>
                                                    <div class="modal fade" id="edit<?= $user->getId() ?>" role="dialog">
                                                        <div class="modal-dialog">
                                                            <form action="../../Controller/UsuarioControll.php" method="POST">
                                                                <!-- Modal content-->
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                                        <center>  <h4 class="modal-title">Editar Usuário</h4></center>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <div class="col-md-8">
                                                                            <label>Funcionário</label>
                                                                            <input type="text" class="form-control" readonly="" required="" value="<?= $nm_func->getNome() ?>">
                                                                            <input type="hidden" name="func" required="" value="<?= $user->getFuncionarioId() ?>">                                                                         
                                                                        </div>
                                                                        <div class="col-md-5">
                                                                            <label>Login</label>
                                                                            <input type="text" class="form-control" name="login" required="" value="<?= $user->getLogin() ?>">
                                                                            <input type="hidden" name="iduser" value="<?= $user->getId() ?>">
                                                                        </div>
                                                                        <div class="col-md-5">
                                                                            <label>Senha</label>
                                                                            <input type="password" class="form-control" name="senha" required="" value="<?= $user->getSenha() ?>">
                                                                        </div>
                                                                        <div class="col-md-6">
                                                                            <label>Tipo de Permisão</label>
                                                                            <select class="form-control" name="permissao" required="">
                                                                                <option style="background-color: #bbb" value="<?= $user->getPermissaoGrupoId() ?>"><?= $nm_permissao->getDescricao() ?></option>
                                                                                <?php
                                                                                foreach ($pdao->BuscarTodosMenos($user->getPermissaoGrupoId()) as $p) {
                                                                                    ?>
                                                                                    <option value="<?= $p->getId() ?>"><?= $p->getDescricao() ?></option>
                                                                                <?php } ?>
                                                                            </select>
                                                                        </div>
                                                                        <div class="col-md-8">
                                                                            <br>                                                                       
                                                                            <button class="btn btn-warning" name="editar">Editar</button>
                                                                        </div>
                                                                        <div class="row"></div>
                                                                        <br>
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                <!-- Modal-->
                                                        <div class="modal fade" id="deletar<?= $user->getId() ?>" role="dialog">
                                                            <div class="modal-dialog">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                                        <center><h4 class="modal-title">Mensagem de Confirmação</h4></center>
                                                                    </div>
                                                                    <center>
                                                                        <strong>DESEJA REALMENTE EXCLUIR?</strong><br><br>
                                                                        <a href="../../Controller/UsuarioControll.php?deletar=<?= $user->getId() ?>"<button class="btn btn-success">SIM</button></a>
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
    </body>
</html>
