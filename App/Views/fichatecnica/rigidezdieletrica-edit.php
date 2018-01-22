<?php
include_once '../../AutoLoad/AutoLoad.php';

$pdao = new ProdutoDAO();
$fdao = new FichaTecnicaDAO();
$irdao = new ItemRigidezDAO();
$funcionariodao = new FuncionarioDAO();

$rdao = new RigidezDAO();

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
                            <h3 class="panel-title"><a href="javascript:void(0);" class="toggle-sidebar"><span class="fa fa-angle-double-left" data-toggle="offcanvas" title="Esconder Menu"></span></a> Ficha Técnica/ Rigidez Dielétrica</h3>
                        </div>
                        <div class="panel-body">
                            <form method="POST" action="../../Controller/FichaTecnicaControll.php">
                                <div class="content-row">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <h2 class="content-row-title">Ficha Técnica - Rigidez Dielétrica</h2>
                                            <input type="hidden" name="idficha" value="<?= $dados->getId() ?>" readonly="">
                                            <input type="hidden" name="idfuncionario" value="<?= $id_funcionario ?>"/>
                                            <?php
                                            $id_f = 0;
                                            foreach ($rdao->BuscarTodosdaFicha($dados->getId()) as $idmodo) {
                                                $id_f = $idmodo->getFichaTecnica_id();
                                                $nm_rigidez = $irdao->BuscarDescricaoRigidez($idmodo->getItemRigidezDieletricaId());
                                                if ($id_f != null) {
                                                    ?>
                                                    <div class="row">
                                                        <div class="col-md-9">
                                                            <label><br></label>
                                                            <input class="form-control" readonly="" type="text" value="<?= $nm_rigidez->getDescricao() ?>">
                                                            <input type="hidden" name="iditem[]" value="<?= $idmodo->getItemRigidezDieletricaId() ?>">
                                                        </div>
                                                        <div class="col-md-3">
                                                            <label>Data da Montagem</label>
                                                            <input type="date" name="data[]" class="form-control" required="" value="<?= $idmodo->getData() ?>">
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-2">
                                                            <label>Resultado</label>
                                                            <select class="form-control" name="resultado[]">
                                                                <?php if ($idmodo->getResultado() == "") { ?>
                                                                    <option value=" "></option>
                                                                    <option value="C">C</option>
                                                                    <option value="NC">NC</option>
                                                                <?php } ?>
                                                                <?php if ($idmodo->getResultado() == "C") { ?>
                                                                    <option value="C">C</option>
                                                                    <option value="NC">NC</option>
                                                                    <option value=" "></option>
                                                                <?php } ?>
                                                                <?php if ($idmodo->getResultado() == "NC") { ?>
                                                                    <option value="NC">NC</option>
                                                                    <option value="C">C</option>
                                                                    <option value=" "></option>
                                                                <?php } ?>

                                                            </select>
                                                        </div>
                                                        <div class="col-md-2">
                                                            <label>Corrente mA</label>
                                                            <input type="text" id="sonumero" name="corrente[]" class="form-control somente-numero" value="<?= $idmodo->getCorrenteMa() ?>">
                                                        </div>
                                                        <div class="col-md-5">
                                                            <label>Responsável</label>
                                                            <select class="js-example-basic-single form-control" name="responsavel[]" 
                                                                    >
                                                                <option value="<?= $idmodo->getReponsavel() ?>"><?= $idmodo->getReponsavel() ?></option>
                                                                <?php
                                                                foreach ($funcionariodao->BuscarTodosFuncionarioAtivo() as $pro) {
                                                                    ?>
                                                                    <option value="<?= $pro->getNome() ?>"><?= $pro->getNome() ?></option>
                                                                <?php } ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <hr>
                                                    <?php
                                                }
//                                                    echo $id_f;
                                            }if ($id_f == null) {

                                                foreach ($irdao->BuscarTodosDoProduto($dados->getProdutoId()) as $idmodo) {
                                                    ?>
                                                    <div class="row">
                                                        <div class="col-md-9">
                                                            <label><br></label>
                                                            <input class="form-control" title="ITEM DO QUESTIONÁRIO" readonly="" type="text" value="<?= $idmodo->getDescricao() ?>">
                                                            <input type="hidden" name="iditem[]" value="<?= $idmodo->getId() ?>">
                                                        </div>
                                                        <div class="col-md-3">
                                                            <label>Data da Montagem</label>
                                                            <input type="date" name="data[]" class="form-control" required="" value="<?= $data_banco ?>">
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-2">
                                                            <label>Resultado</label>
                                                            <select class="form-control" name="resultado[]">
                                                                <option value=" "></option>
                                                                <option value="C">C</option>
                                                                <option value="NC">NC</option>
                                                            </select>
                                                        </div>
                                                        <div class="col-md-2">
                                                            <label>Corrente mA</label>
                                                            <input type="text" id="sonumero" name="corrente[]" class="form-control somente-numero">
                                                        </div>
                                                        <div class="col-md-5">
                                                            <label>Responsável</label>
                                                            <select class="js-example-basic-single form-control" name="responsavel[]" 
                                                                    >
                                                                <option value="  ">Selecione...</option>
                                                                <?php
                                                                foreach ($funcionariodao->BuscarTodosFuncionarioAtivo() as $pro) {
                                                                    ?>
                                                                    <option value="<?= $pro->getNome() ?>"><?= $pro->getNome() ?></option>
                                                                <?php } ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <hr>
                                                    <?php
                                                }
                                            }
                                            ?>
                                            <div class="btn-group dropup">
                                                <button class="btn btn-primary" type="submit" name="regidezz-edit">Corrente de Fuga</button>

                                            </div>  
                                            <div class="btn-group dropup">
                                                <button class="btn btn-warning" type="submit" name="regidez-edit-sair">Editar e Sair</button>
                                            </div> 

                                        </div>

                                    </div>
                                </div>
                        </div>
                    </div>
                    </form>
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
