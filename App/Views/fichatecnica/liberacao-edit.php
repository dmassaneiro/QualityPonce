<?php
include_once '../../AutoLoad/AutoLoad.php';

$pdao = new ProdutoDAO();
$fdao = new FichaTecnicaDAO();
$ldao = new ItemLiberacaoDAO();
$funcionariodao = new FuncionarioDAO();

$id = filter_input(INPUT_GET, 'id');

$dados = $fdao->BuscarRegistroParaEditar($id);

$id_ficha = $fdao->BuscarUltimoRegistro();
$val = new MontagemDAO();
$valida = $val->ValidaMontagem($dados->getProdutoId());
if (empty($valida->getId())) {
    header("Location: ../fichatecnica/inicio.php?msg=11");
}
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Ficha Técncia</title>
        <?php include '../estrutura/head.php'; ?>

        <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
        <script src="//code.jquery.com/jquery-1.10.2.js"></script>
        <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>

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
                            <h3 class="panel-title"><a href="javascript:void(0);" class="toggle-sidebar"><span class="fa fa-angle-double-left" data-toggle="offcanvas" title="Esconder Menu"></span></a> Ficha Técnica/ Liberação</h3>
                        </div>
                        <div class="panel-body">
                            <form method="POST" action="../../Controller/FichaTecnicaControll.php">
                                <div class="content-row">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <h2 class="content-row-title">LIBERAÇÃO DO PRODUTO PARA DISTRIBUIÇÃO</h2>
                                            <input type="hidden" name="idficha" value="<?= $dados->getId() ?>" readonly="">
                                            <input type="hidden" name="idfuncionario" value="<?= $id_funcionario ?>"/>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="table-responsive">
                                                        <table class="table  table-striped table-highlight">
                                                            <thead>
                                                            <th>Item</th>
                                                            <th>Conferido?</th>
                                                            </thead>
                                                            <tbody>
                                                                <?php
                                                                $libb = new LiberacaoDAO();
                                                                $count = 0;
                                                                foreach ($libb->BuscarTodosdaFicha($dados->getId()) as $lib) {
                                                                    $nm_item = $ldao->BuscarNomePeloId($lib->getItemLiberacaoId());
                                                                    $count = $lib->getItemLiberacaoId();
                                                                    if ($count != null) {
                                                                        ?>
                                                                        <tr>
                                                                            <td>
                                                                                <p style="text-transform: uppercase"><?= $nm_item->getDescricao() ?></p>
                                                                                <input type="hidden" name="idliberacao[]" value="<?= $lib->getItemLiberacaoId() ?>">
                                                                            </td>
                                                                            <td>
                                                                                <select class="form-control" name="conferido[]">
                                                                                    <?php if ($lib->getConferido() == "") { ?>
                                                                                        <option value=""></option>
                                                                                        <option value="S">SIM</option>
                                                                                        <option value="N">NÃO</option>
                                                                                    <?php } ?>
                                                                                    <?php if ($lib->getConferido() == "S") { ?>
                                                                                        <option value="S">SIM</option>
                                                                                        <option value="N">NÃO</option>
                                                                                    <?php } ?>
                                                                                    <?php if ($lib->getConferido() == "N") { ?>
                                                                                        <option value="N">NÃO</option>
                                                                                        <option value="S">SIM</option>
                                                                                    <?php } ?>

                                                                                </select>
                                                                            </td>                      
                                                                        </tr>
                                                                        <?php
                                                                    }
                                                                }
                                                                if ($count == null) {
                                                                    ?>
                                                                    <?php
                                                                    foreach ($ldao->BuscarTodosDoProduto($dados->getProdutoId()) as $lib) {
                                                                        ?>
                                                                        <tr>
                                                                            <td>
                                                                                <p style="text-transform: uppercase"><?= $lib->getDescricao() ?></p>
                                                                                <input type="hidden" name="idliberacao[]" value="<?= $lib->getId() ?>">
                                                                            </td>
                                                                            <td>
                                                                                <select class="form-control" name="conferido[]">
                                                                                    <option value=""></option>
                                                                                    <option value="S">SIM</option>
                                                                                    <option value="N">NÃO</option>
                                                                                </select>
                                                                            </td>                      
                                                                        </tr>
                                                                    <?php } ?>
                                                                <?php } ?>
                                                            </tbody>
                                                        </table>
                                                    </div>

                                                </div>
                                            </div>
                                            <div class = "row">
                                                <div class = "col-md-3">
                                                    <br>
                                                    <button class = "btn btn-success" type = "submit" name = "concluir-edit">Concluir Ficha Técnica</button>
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
    </body>
</html>
