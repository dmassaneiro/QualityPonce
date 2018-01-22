<?php
include_once '../../AutoLoad/AutoLoad.php';

$pdao = new ProdutoDAO();
$fdao = new FichaTecnicaDAO();

$id_ficha = $fdao->BuscarUltimoRegistro();
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Ficha Técncia</title>
        <?php include '../estrutura/head.php'; ?>
        <link href="../select2/select2.min.css" rel="stylesheet" />
        <script src="../select2/select2.min.js"></script>

    </head>
    <body>
        <?php include '../estrutura/menu.php'; ?>
         <?php
        if ($id_permissao == 1 || $id_permissao == 6 || $id_permissao == 2 || $id_permissao == 3) {
            
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
                        <div class="panel-heading" id="producao">
                            <h3 class="panel-title"><a href="javascript:void(0);" class="toggle-sidebar"><span class="fa fa-angle-double-left" data-toggle="offcanvas" title="Esconder Menu"></span></a> Ficha Técnica</h3>
                        </div>
                        <div class="panel-body">
                            <form method="POST" action="../../Controller/FichaTecnicaControll.php">
                                <div class="content-row">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <h2 class="content-row-title">Ficha Técnica - Cadastro</h2>
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <label>Cod. da Ficha</label>
                                                    <input type="text" class="form-control" value="<?= $id_ficha->getId() + 1 ?>" readonly="">
                                                    <input type="hidden" name="idfuncionario" value="<?= $id_funcionario ?>"/>
                                                </div>
                                                <div class="col-md-3">
                                                    <label>Data Início</label>
                                                    <input type="date" id="in" class="form-control" required="" name="inicio" value="<?= $data_banco ?>" onblur="validadata()"/>
                                                </div>
                                                <div class="col-md-3">
                                                    <label>Data Termíno</label>
                                                    <input type="date" id="fi" class="form-control" required="" name="fim" value="<?= $data_banco ?>" onblur="validadata()"/>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-5">
                                                    <label>Produto</label>
                                                    <select class="js-example-basic-single form-control" name="produto" required=""
                                                            >
                                                        <option value="">Selecione...</option>
                                                        <?php
                                                        foreach ($pdao->BuscarTodosProdutosAtivo() as $pro) {
                                                            ?>
                                                            <option value="<?= $pro->getId() ?>"><?= $pro->getNome() ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                                <div class="col-md-3">
                                                    <label>Nr. da Ordem</label>
                                                    <input type="text" id="sonumero" class="somente-numero form-control" name="nrordem">
                                                </div>
                                                <div class="col-md-3">
                                                    <label>Nr. de Série</label>
                                                    <input type="text"  class=" form-control " name="nrserie">
                                                </div>
                                            </div>
                                            <div class="row">

                                                <div class="col-md-3">
                                                    <br>
                                                    <button class="btn btn-primary" type="submit" name="gravar">Abrir Ficha Técnica</button>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script>
            function validadata() {
                var inicio = document.getElementById('in').value;
                var fim = document.getElementById('fi').value;

                if (inicio > fim) {
                    alert("Data Informada é Inválida");
                    document.getElementById('fi').value = "<?= $data_banco?>";
                    document.getElementById('in').value = "<?= $data_banco?>";

                }
            }
        </script>
        <script>
            // In your Javascript (external .js resource or <script> tag)
            $(document).ready(function () {
                $('.js-example-basic-single').select2();
            });
        </script>

    </body>
</html>
