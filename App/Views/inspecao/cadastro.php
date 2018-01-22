<?php
include_once '../../AutoLoad/AutoLoad.php';

$ldao = new LaudoInspecaoDAO();
$id_laudo = $ldao->BuscarUltimoRegistro();
$fdao = new FornecedorDAO();
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
                                                    <input type="text" class="form-control"readonly="" value="<?= $id_laudo->getId() + 1 ?>">
                                                    <input type="hidden" name="cod" value="<?= $id_laudo->getId() + 1 ?>">
                                                    <input type="hidden" name="idfuncionario" value="<?= $id_funcionario ?>">
                                                </div>
                                                <div class="col-md-3">
                                                    <label>Data</label>
                                                    <input type="date" class="form-control" required="" name="data" value="<?= $data_banco ?>">
                                                </div>
                                                <div class="col-md-3">
                                                    <label>Numero/Série NF-e</label>
                                                    <input type="text" class="form-control" required="" name="numeroserie">
                                                </div>
                                                <div class="col-md-3">
                                                    <label>Data Recebimento</label>
                                                    <input type="date" class="form-control" required="" name="datarecebimento" value="<?= $data_banco ?>">
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label>Fornecedor</label>
                                                    <select class="js-example-basic-single form-control" name="idfornecedor" required=""                                                            >
                                                        <option value="">SELECIONE...</option>
                                                        <?php
                                                        foreach ($fdao->BuscarTodosAtivo() as $pro) {
                                                            ?>
                                                            <option value="<?= $pro->getId() ?>"><?= $pro->getNome() ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>

                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label>Item</label>
                                                    <select class="js-example-basic-single form-control" name="item" required=""                                                            >
                                                        <option value="">SELECIONE...</option>
                                                        <?php
                                                        $mdao = new MateriaPrimaDAO();
                                                        foreach ($mdao->BuscarTodosAtiva() as $ma) {
                                                            ?>
                                                            <option value="<?= $ma->getId() ?>"><?= $ma->getNome() ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                                <div class="col-md-2">
                                                    <label>Qtd.no Lote</label>
                                                    <input type="text" class="form-control" id="n1" required="" name="qtdlote" onblur="verifica()">
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <label>Tipo de Inspeção</label>
                                                    <select class="form-control" name="tipo1" id="mySelect" required="" onchange="myFunction()">
                                                        <option value="">Selecione...</option>
                                                        <option id="100" value="100">100%</option>
                                                        <option id="AMOSTRAL" value="AMOSTRAL">AMOSTRAL</option>
                                                    </select>
                                                </div>
                                                <div id="demo"> </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <label>Critérios para Aprovação</label>
                                                    <textarea rows="3" class="form-control" required="" name="criterios"></textarea>
                                                </div>
                                            </div>  
                                            <hr>
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <h4>Resultados</h4>
                                                    <label>Qtd. Conforme</label>
                                                    <input class="form-control" required="" id="n2" type="text" name="qtdconforme" onblur="verificavalor(); calcular();"/>
                                                </div>
                                                <div class="col-md-3">
                                                    <h4><br></h4>
                                                    <label>Qtd. não Conforme</label>
                                                    <input class="form-control" readonly="" required="" id="nc" type="text" name="qtdnc"/>
                                                </div>
                                                <div class="col-md-3">
                                                    <h4><br></h4>
                                                    <label>Nr. do Lote</label>
                                                    <input class="form-control"  type="text" name="numerolote" />
                                                </div>

                                                <div class="col-md-3">
                                                    <h4><br></h4>
                                                    <label>Situação</label>
                                                    <select class="form-control" name="status" id="mySelect" onchange="myFunction()">
                                                        <option value="4">APROVADO</option>
                                                        <option value="5">REPROVADO</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <label>Observação</label>
                                                    <textarea class="form-control" name="obs" rows="3"></textarea>
                                                </div>
                                            </div>
                                        </div>  
                                    </div>                                
                                <button type="submit" name="gravar" class="btn btn-success"><span class=""></span> Gravar</button>
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
            // In your Javascript (external .js resource or <script> tag)
            $(document).ready(function () {
                $('.js-example-basic-single').select2();
            });
        </script>
        <script>

            function myFunction() {
                var x = document.getElementById("mySelect").value;
                if (x === "100") {
                    document.getElementById("demo").innerHTML = "<div class='col-md-3'>" +
                            "<label>Selecione</label            >" +
                            "<select class='form-control' name='tipo2'>" +
                            "<option value='N'>NORMAL</option>" +
                            "<option id='100' value='S'>SEVERA</option>" +
                            "<option id='amostral' value='A'>ATENUADA</option>" +
                            "</select>" +
                            "</div>";
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
                    alert('A Quantidade Conforme não dever ser maior que a quantidade no lote!');
                }
                if (n2 < 0) {
                    document.getElementById('n2').value = '0';
                    document.getElementById('n2').focus();
                    alert('Digite Apenas Números inteiros!');
                }

            }
        </script>

    </body>
</html>
