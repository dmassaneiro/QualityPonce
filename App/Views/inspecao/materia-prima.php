<?php
include_once '../../AutoLoad/AutoLoad.php';
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Matéria-Prima</title>
        <?php include '../estrutura/head.php'; ?>
        <link href="../select2/select2.min.css" rel="stylesheet" />
        <script src="../select2/select2.min.js"></script>

    </head>
    <body>
        <?php include '../estrutura/menu.php'; ?>
         <?php
        if ($id_permissao == 1 || $id_permissao == 6 || $id_permissao == 4 || $id_permissao == 5 || $id_permissao == 2) {
            
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
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title"><a href="javascript:void(0);" class="toggle-sidebar"><span class="fa fa-angle-double-left" data-toggle="offcanvas" title="Esconder Menu"></span></a> Matéria-Prima</h3>
                        </div>
                        <div class="panel-body">
                            <div class="content-row">
                                <form method="POST" action="../../Controller/MateriaPrimaControll.php">
                                    <div class="form-group">
                                        <div class="col-md-10">
                                            <label>Nome</label>
                                            <input type="text" class="form-control" name="nome"
                                                   required="">
                                        </div>
                                        <div class="col-md-12">
                                            <label>Descrição</label>
                                            <textarea class="form-control"
                                                      name="descricao" rows="3"></textarea>
                                        </div>
                                        <div class="col-md-5">

                                            <label>Fornecedor</label>
                                            <select class="js-example-basic-single form-control" name="idfornecedor" required=""                                                            >
                                                <option value="">SELECIONE...</option>
                                                <?php
                                                $fdao = new FornecedorDAO();
                                                foreach ($fdao->BuscarTodosAtivo() as $pro) {
                                                    ?>
                                                    <option value="<?= $pro->getId() ?>"><?= $pro->getNome() ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                        <div class="col-md-3">
                                            <label>Situação</label>
                                            <select class="form-control" name="situacao"
                                                    required="">
                                                <option value="A">ATIVO</option>
                                                <option value="I">INATIVO</option>
                                            </select>
                                        </div>
                                        <div class="col-md-3">
                                            <label>Data Cadastro</label>
                                            <input type="date" class="form-control" readonly
                                                   name="data" value="<?= $data_banco ?>"/>
                                        </div>

                                        <div class="row">

                                        </div>
                                        <br>
                                        <div class="col-md-3">
                                            <a><button type="submit" name="gravar" class="btn btn-success"><span class="glyphicon glyphicon-list-alt"></span> Gravar</button></a>
                                            <br>
                                            <br>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        // In your Javascript (external .js resource or <script> tag)
        $(document).ready(function () {
            $('.js-example-basic-single').select2();
        });
    </script>
</body>
</html>
