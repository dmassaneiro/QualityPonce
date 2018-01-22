<?php
include_once '../../AutoLoad/AutoLoad.php';

$setordao = new SetorDAO;
$usuariodao = new UsuarioDAO;
$funcionariodao = new FuncionarioDAO();
$pdao = new ProdutoDAO();
$idao = new InstrumentoDAO();

$pesquisa = filter_input(INPUT_POST, 'pesquisa');

$data = date('Y-m-d');

$teste = $idao->VerificaValidade($data);

//echo $teste->getDataValidade();
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Instrumentos</title>
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
                    <?php if ($teste->getId() != null) { ?>
                        <div class="alert alert-warning alert-dismissable">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                            <strong>ATENÇÃO! </strong>  Você possui Instrumentos Ativos Vencidos!.
                        </div>
                    <?php } ?>
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title"><a href="javascript:void(0);" class="toggle-sidebar"><span class="fa fa-angle-double-left" data-toggle="offcanvas" title="Esconder Menu"></span></a> Instrumentos</h3>
                        </div>
                        <div class="panel-body">
                            <div class="content-row">
                                <div class="row">
                                    <div class="col-md-12">
                                        <h2 class="content-row-title">Instrumentos Cadastrados</h2>
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
                                                        <center><h4 class="modal-title">Cadastro de Instrumentos</h4></center>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="../../Controller/InstrumentoControll.php" method="POST">
                                                            <div class="col-md-12">
                                                                <label>Descricao</label>
                                                                <input type="text" class="form-control" name="descricao" required="">
                                                            </div>
                                                            <div class="col-md-6">
                                                                <label>Identificação</label>
                                                                <input type="text" class="form-control" name="identificacao" required="">
                                                            </div>
                                                            <div class="col-md-6">
                                                                <label>Data de Validade</label>
                                                                <input type="date" class="form-control" name="validade" required="" value="<?= $data_banco ?>">
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
                                                            <th>Identificação</th>
                                                            <th>Validade</th>
                                                            <th>Situação</th>
                                                            <th></th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        $resultado = $idao->BuscarTodos2();
//                                                        echo $pesquisa;
                                                        if ($pesquisa != null) {
                                                            $resultado = $idao->BuscarTodosporDescricao($pesquisa);
                                                        }

                                                        foreach ($resultado as $d) {
                                                            if ($d->getDataValidade() <= $data_banco && $d->getSituacao() == "A") {
                                                                ?>
                                                                <tr style="background-color: #f2838f">
                                                                <?php } else {
                                                                    ?>
                                                                <tr >
                                                                <?php } ?>
                                                                <td><?= $d->getId() ?></td>
                                                                <td><?= strtoupper($d->getDescricao()) ?></td>
                                                                <td><?= $d->getIdentificacao() ?></td>
                                                                <td><?= date("d/m/Y", strtotime($d->getDataValidade())) ?></td>
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
                                                                        <center><h4 class="modal-title">Editar Instrumentos</h4></center>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <form action="../../Controller/InstrumentoControll.php" method="POST">
                                                                            <div class="col-md-12">
                                                                                <label>Descrição</label>
                                                                                <input type="text" class="form-control" name="descricao" required="" value="<?= $d->getDescricao(); ?>">
                                                                                <input type="hidden"  name="cod" value="<?= $d->getId() ?>">
                                                                            </div>
                                                                            <div class="col-md-6">
                                                                                <label>Identificação</label>
                                                                                <input type="text" class="form-control" name="identificacao" required="" value="<?= $d->getIdentificacao() ?>">
                                                                            </div>
                                                                            <div class="col-md-6">
                                                                                <label>Data de Validade</label>
                                                                                <input type="date" class="form-control" name="validade" required="" value="<?= $d->getDataValidade() ?>">
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
                                                                        <a href="../../Controller/InstrumentoControll.php?deletar=<?= $d->getId() ?>"<button class="btn btn-success">SIM</button></a>
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
