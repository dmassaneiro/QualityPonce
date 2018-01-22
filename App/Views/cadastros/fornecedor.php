<?php
include_once '../../AutoLoad/AutoLoad.php';

$setordao = new SetorDAO;
$usuariodao = new UsuarioDAO;
$fdao = new FornecedorDAO();

$pesquisa = filter_input(INPUT_POST, 'pesquisa');
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Fornecedores</title>
        <?php include '../estrutura/head.php'; ?>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.0/jquery.min.js"></script>
        
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
                        <h3 class="panel-title"><a href="javascript:void(0);" class="toggle-sidebar"><span class="fa fa-angle-double-left" data-toggle="offcanvas" title="Esconder Menu"></span></a> Fornecedor </h3>
                    </div>
                    <div class="panel-body">
                        <div class="content-row">
                            <div class="row">
                                <div class="col-md-12">
                                    <h2 class="content-row-title">Fornecedores Cadastrados</h2>
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
                                                    <center><h4 class="modal-title">Cadastro de Fornecedor</h4></center>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="../../Controller/FornecedorControll.php" method="POST">
                                                        <div class="col-md-6">
                                                            <label>CNPJ</label>
                                                            <input type="text"  class="form-control" name="cnpj" required="" value=""
                                                                  id="user_cpf" maxlength="18" onkeypress='mascaraMutuario(this,cpfCnpj)' onblur='clearTimeout()' data-error="Informe seu CPF">
                                                        </div>
                                                        <div class="col-md-12">
                                                            <label>Nome</label>
                                                            <input type="text" class="form-control" name="nome" required="" value="">
                                                        </div>
                                                        <div class="col-md-12">
                                                            <label>Nome Fantasia</label>
                                                            <input type="text" class="form-control" name="fantasia" required="" value="">
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
                                                    <th>CNPJ</th>
                                                    <th>Nome</th>
                                                    <th>Situação</th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <?php
                                                    $resultado = $fdao->BuscarTodos();
//                                                        echo $pesquisa;
                                                    if ($pesquisa != null) {
                                                        $resultado = $fdao->BuscarTodosDescricao($pesquisa);
                                                    }
                                                    foreach ($resultado as $f) {
//                                                            echo $func->getId();
//                                                            $nm_setor = $setordao->BuscarNomeSetor($func->getSetorId());
                                                        ?>
                                                        <td><?= $f->getId() ?></td>
                                                        <td><?= $f->getCnpj() ?></td>
                                                        <td><?= strtoupper($f->getNome()) ?></td>
                                                        <td>
                                                            <?php
                                                            if ($f->getSituacao() == 'A') {
                                                                echo 'ATIVO';
                                                            } else {
                                                                echo 'INATIVO';
                                                            }
                                                            ?>
                                                        </td>
                                                        <td><button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#edit<?= $f->getId() ?>" style=" float:left; margin: 0 4px 0 0;"><i class="glyphicon glyphicon-edit"></i> </button>
                                                            <button class="btn btn-sm btn-danger" data-toggle="modal" data-target="#deletar<?= $f->getId() ?>"><i class="glyphicon glyphicon-trash"></i></button> </td>   
                                                    </tr>
                                                <div class="modal fade" id="edit<?= $f->getId() ?>" role="dialog">
                                                    <div class="modal-dialog">

                                                        <!-- Modal content-->
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                                <center><h4 class="modal-title">Editar Fornecedor</h4></center>
                                                            </div>
                                                            <div class="modal-body">
                                                                <form action="../../Controller/FornecedorControll.php" method="POST">
                                                                    <div class="col-md-6">
                                                                        <label>CNPJ</label>
                                                                        <input type="text" class="form-control" name="cnpj" required="" value="<?= $f->getCnpj(); ?>"
                                                                                id="user_cpf" maxlength="18" onkeypress='mascaraMutuario(this,cpfCnpj)' onblur='clearTimeout()' data-error="Informe seu CPF">
                                                                        <input type="hidden"  name="cod" value="<?= $f->getId() ?>">
                                                                    </div>
                                                                    <div class="col-md-12">
                                                                        <label>Nome</label>
                                                                        <input type="text" class="form-control" name="nome" required="" value="<?= $f->getNome(); ?>">
                                                                    </div>
                                                                    <div class="col-md-12">
                                                                        <label>Nome Fantasia</label>
                                                                        <input type="text" class="form-control" name="fantasia" required="" value="<?= $f->getNome(); ?>">
                                                                    </div>
                                                                    <div class="col-md-5">
                                                                        <label>Situação</label>
                                                                        <select class="form-control" name="situacao">
                                                                            <?php if ($f->getSituacao() == 'A') { ?>
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
                                                <div class="modal fade" id="deletar<?= $f->getId() ?>" role="dialog">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                                <center><h4 class="modal-title">Mensagem de Confirmação</h4></center>
                                                            </div>
                                                            <center>
                                                                <strong>DESEJA REALMENTE EXCLUIR?</strong><br><br>
                                                                <a href="../../Controller/FornecedorControll.php?deletar=<?= $f->getId() ?>"<button class="btn btn-success">SIM</button></a>
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
    <script>
        function mascaraMutuario(o, f) {
            v_obj = o
            v_fun = f
            setTimeout('execmascara()', 1)
        }

        function execmascara() {
            v_obj.value = v_fun(v_obj.value)
        }

        function cpfCnpj(v) {

            //Remove tudo o que não é dígito
            v = v.replace(/\D/g, "")

            if (v.length <= 14) { //CPF

                //Coloca um ponto entre o terceiro e o quarto dígitos
                v = v.replace(/(\d{3})(\d)/, "$1.$2")

                //Coloca um ponto entre o terceiro e o quarto dígitos
                //de novo (para o segundo bloco de números)
                v = v.replace(/(\d{3})(\d)/, "$1.$2")

                //Coloca um hífen entre o terceiro e o quarto dígitos
                v = v.replace(/(\d{3})(\d{1,2})$/, "$1-$2")

            } else { //CNPJ

                //Coloca ponto entre o segundo e o terceiro dígitos
                v = v.replace(/^(\d{2})(\d)/, "$1.$2")

                //Coloca ponto entre o quinto e o sexto dígitos
                v = v.replace(/^(\d{2})\.(\d{3})(\d)/, "$1.$2.$3")

                //Coloca uma barra entre o oitavo e o nono dígitos
                v = v.replace(/\.(\d{3})(\d)/, ".$1/$2")

                //Coloca um hífen depois do bloco de quatro dígitos
                v = v.replace(/(\d{4})(\d)/, "$1-$2")

            }

            return v
        }
    </script>
</body>
</html>
