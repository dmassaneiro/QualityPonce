<?php
include_once '../../AutoLoad/AutoLoad.php';

$ldao = new LaudoInspecaoDAO();
$fdao = new FornecedorDAO();
$mdao = new MateriaPrimaDAO();

$id = filter_input(INPUT_GET, 'id');
if (empty($id)) {
    header("Location: ../inspecao/inicio.php");
}

$d = $ldao->BuscarRegistroParaEditar($id);
$m = $mdao->BuscaPeloId($d->getMateriaPrimaId());
$f = $fdao->BuscarNome($d->getFornecedor());
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Inspeção de Matéria-Prima</title>
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
                            <h3 class="panel-title"><a href="javascript:void(0);" class="toggle-sidebar"><span class="fa fa-angle-double-left" data-toggle="offcanvas" title="Esconder Menu"></span></a> Inspeção</h3>
                        </div>
                        <form action="../../Controller/LaudoInspecaoControll.php" method="POST">
                            <div class="panel-body">
                                <div class="content-row">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <h2 class="content-row-title">Inspeção de Matéria-Prima - Cadastro</h2>
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <label>N° da inspeção</label>
                                                    <input type="text" class="form-control"readonly="" value="<?= $d->getId() ?>">
                                                    <input type="hidden" name="id" value="<?= $d->getId() ?>">
                                                    <input type="hidden" name="cod" value="<?= $d->getId() ?>">
                                                    <input type="hidden" name="idfuncionario" value="<?= $id_funcionario ?>">
                                                </div>
                                                <div class="col-md-3">
                                                    <label>Data</label>
                                                    <input type="date" class="form-control" required="" name="data" value="<?= $d->getDataInspecao() ?>">
                                                </div>
                                                <div class="col-md-3">
                                                    <label>Numero/Série NF-e</label>
                                                    <input type="text" class="form-control" required="" name="numeroserie" value="<?= $d->getNumeroNota() ?>">
                                                </div>
                                                <div class="col-md-3">
                                                    <label>Data Recebimento</label>
                                                    <input type="date" class="form-control" required="" name="datarecebimento" value="<?= $d->getDataRecebimento() ?>">
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label>Fornecedor</label>
                                                    <?php
                                                    $nm_for = $fdao->BuscarNome($d->getFornecedor());
                                                    ?>
                                                    <select class="js-example-basic-single form-control" name="idfornecedor" required=""                                                            >
                                                        <option value="<?= $d->getFornecedor() ?>"><?= $nm_for->getNome() ?></option>
                                                        <?php
                                                                                                            echo $d->getFornecedor();
                                                        foreach ($fdao->BuscarTodosAtivoMenos($d->getFornecedor()) as $pro) {
                                                            ?>
                                                            <option value="<?= $pro->getId() ?>"><?= $pro->getNome() ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>

                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label>Item</label>
                                                    <?php
                                                    $mdao = new MateriaPrimaDAO();
                                                    $nm_mat = $mdao->BuscaNome($d->getMateriaPrimaId() );
                                                    ?>
                                                    <select class="js-example-basic-single form-control" name="item" required=""                                                            >
                                                        <option value="<?= $d->getMateriaPrimaId() ?>"><?=$nm_mat->getNome()?></option>
                                                        <?php
                                                        foreach ($mdao->BuscarTodosAtivaMenos($d->getMateriaPrimaId()) as $ma) {
                                                            ?>
                                                            <option value="<?= $ma->getId() ?>"><?= $ma->getNome() ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                                <div class="col-md-2">
                                                    <label>Qtd.no Lote</label>
                                                    <input type="text" class="form-control" id="n1" required="" value="<?= $d->getQuantidadeLote() ?>" name="qtdlote" onblur="verifica()">
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <label>Tipo de Inspeção</label>
                                                    <select class="form-control" name="tipo1" id="mySelect" required="" onchange="myFunction()">
                                                        <?php if ($d->getTipoinspecao1() == '1') { ?>
                                                            <option id="100" value="100">100%</option>
                                                            <option id="AMOSTRAL" value="AMOSTRAL">AMOSTRAL</option>
                                                        </select>
                                                    </div>
                                                    <div class='col-md-3' id='some1'>
                                                        <label>Selecione</label>
                                                        <select class='form-control'  name='tipo2'>
                                                            <?php if ($d->getTipoinspecao2() == 'N') { ?>
                                                                <option value='NORMAL'>NORMAL</option>
                                                                <option id='100' value='SEVERA'>SEVERA</option>
                                                                <option id='amostral' value='ATENUADA'>ATENUADA</option>
                                                            <?php }if ($d->getTipoinspecao2() == 'S') { ?>
                                                                <option id='100' value='SEVERA'>SEVERA</option>
                                                                <option value='NORMAL'>NORMAL</option>
                                                                <option id='amostral' value='ATENUADA'>ATENUADA</option>
                                                            <?php } if ($d->getTipoinspecao2() == 'A') { ?>
                                                                <option id='amostral' value='ATENUADA'>ATENUADA</option>
                                                                <option value='NORMAL'>NORMAL</option>
                                                                <option id='100' value='SEVERA'>SEVERA</option>
                                                            <?php } ?>
                                                        </select>
                                                    </div>
                                                <?php } else { ?>
                                                    <option id="AMOSTRAL" value="AMOSTRAL">AMOSTRAL</option>
                                                    <option id="100" value="100">100%</option>
                                                    </select>
                                                </div>
                                                <div class='col-md-3' id='some2'>
                                                    <label>Selecione</label>
                                                    <select class='form-control'name='tipo3' >
                                                        <?php if ($d->getTipoinspecao2() == '1') { ?>
                                                            <option value='1'>I</option>
                                                            <option value='2'>II</option>
                                                            <option value='3'>III</option>
                                                            <option value='4'>NÃO APLICAVEL</option>
                                                        <?php }if ($d->getTipoinspecao2() == '2') { ?>
                                                            <option value='2'>II</option>
                                                            <option value='1'>I</option>
                                                            <option value='3'>III</option>
                                                            <option value='4'>NÃO APLICAVEL</option>
                                                        <?php } if ($d->getTipoinspecao2() == '3') { ?>
                                                            <option value='3'>III</option>
                                                            <option value='1'>I</option>
                                                            <option value='2'>II</option>
                                                            <option value='4'>NÃO APLICAVEL</option>
                                                        <?php } if ($d->getTipoinspecao2() == '4') { ?>
                                                            <option value='4'>NÃO APLICAVEL</option>
                                                            <option value='1'>I</option>
                                                            <option value='2'>II</option>
                                                            <option value='3'>III</option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            <?php } ?>

                                            <div id="demo"> </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <label>Critérios para Aprovação</label>
                                                <textarea rows="3" class="form-control" required="" name="criterios"><?= strip_tags($d->getCriterios()) ?></textarea>
                                            </div>
                                        </div>  
                                        <hr>
                                        <div class="row">
                                            <div class="col-md-3">
                                                <h4>Resultados</h4>
                                                <label>Qtd. Conforme</label>
                                                <input class="form-control" required="" id="n2" type="text" name="qtdconforme" value="<?= $d->getQuantidadeConforme() ?>" onblur="verificavalor();calcular();"/>
                                            </div>
                                            <div class="col-md-3">
                                                <h4><br></h4>
                                                <label>Qtd. não Conforme</label>
                                                <input class="form-control" required readonly="" id="nc" type="text" name="qtdnc" value="<?= $d->getQuantidadeDefeito() ?>"/>
                                            </div>
                                            <div class="col-md-3">
                                                <h4><br></h4>
                                                <label>Nr. do Lote</label>
                                                <input class="form-control" type="text" name="numerolote" value="<?= $d->getNumeroLote() ?>" />
                                            </div>

                                            <div class="col-md-3">
                                                <h4><br></h4>
                                                <label>Situação</label>
                                                <select class="form-control" name="status" id="mySelect" onchange="myFunction()">
                                                    <?php if ($d->getStatusId() == '4') { ?>
                                                        <option value="4">APROVADO</option>
                                                        <option value="5">REPROVADO</option>
                                                    <?php } else { ?>
                                                        <option value="5">REPROVADO</option>
                                                        <option value="4">APROVADO</option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <label>Observação</label>
                                                <textarea class="form-control" name="obs" rows="3"><?= strip_tags($d->getObservacao()) ?></textarea>
                                            </div>
                                        </div>
                            <a><button type="submit" name="editar" class="btn btn-success"><span class="glyphicon glyphicon-list-alt"></span> Gravar</button></a>
                                    </div>  
                                </div>                                
                            </div>
                            <br>
                            <br>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        function myFunction() {
            var x = document.getElementById("mySelect").value;
            if (x === "100") {
                document.getElementById("demo").innerHTML = "<div class='col-md-3'>" +
                        "<label>Selecione</label>" +
                        "<select class='form-control' name='tipo2'>" +
                        "<option value='NORMAL'>NORMAL</option>" +
                        "<option id='100' value='SEVERA'>SEVERA</option>" +
                        "<option id='amostral' value='ATENUADA'>ATENUADA</option>" +
                        "</select>" +
                        "</div>";
                console.log(document.getElementById("some2"));
//                document.getElementById("some1").style.display = 'none';;
                document.getElementById("some2").style.display = "none";
            }
            if (x === "AMOSTRAL") {
                document.getElementById("demo").innerHTML = "<div class='col-md-3'>" +
                        "<label>Selecione</label>" +
                        "<select class='form-control'name='tipo3' >" +
                        "<option value='1'>I</option>" +
                        "<option value='2'>II</option>" +
                        "<option value='3'>III</option>" +
                        "<option value='4'>NÃO APLICAVEL</option>" +
                        "</select>" +
                        "</div>";
                document.getElementById("some1").style.display = "none";
            }
            if (x === "1" || x === "2" || x === "3") {
                document.getElementById("demo").innerHTML = "";
            }
        }
    </script>
    <script>
        function calcular() {
            var n1 = 0;
            var n2 = 0;
            n1 = parseInt(document.getElementById('n1').value, 10);
            n2 = parseInt(document.getElementById('n2').value, 10);
            document.getElementById('nc').value = n1 - n2;
        }
        function verifica() {
            var n1 = document.getElementById('n1').value;
            if (n1 === '') {
                document.getElementById('n1').value = '0';
                document.getElementById('n1').focus();
                alert('Campo Obrigatório!');
            } else if (isNaN(n1)) {
                document.getElementById('n1').value = '0';
                document.getElementById('n1').focus();
                alert('Digite Apenas Números !');
            } else if (n1 < 0) {
                document.getElementById('n1').value = '0';
                document.getElementById('n1').focus();
                alert('Digite Apenas Números inteiros!');
            }

        }
        function verificavalor() {
            var n1 = parseInt(document.getElementById('n1').value);
            var n2 = parseInt(document.getElementById('n2').value);
            if (n1 === '') {
                document.getElementById('n1').value = '0';
                document.getElementById('n1').focus();
                alert('Preencha a Quantidade no Lote!');
            }
            if (isNaN(n2)) {
                document.getElementById('n2').value = '0';
                document.getElementById('n2').focus();
                alert('Digite Apenas Números !');
            }
            if (n2 > n1) {
                document.getElementById('n2').value = '0';
                document.getElementById('n2').focus();
                console.log('N2 ' + n2);
                console.log('N1 ' + n1);
                alert('A Quantidade Conforme não dever ser maior que a quantidade no lote!');
            }
            if (n2 < 0) {
                document.getElementById('n2').value = '0';
                document.getElementById('n2').focus();
                alert('Digite Apenas Números inteiros!');
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
