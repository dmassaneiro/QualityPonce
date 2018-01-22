<?php
include '../../AutoLoad/AutoLoad.php';

$cdao = new CriterioFornecedorDAO();
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Avaliação de Fornecedor</title>
        <?php include '../estrutura/head.php'; ?>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.0/jquery.min.js"></script>
    </head>
    <body>
        <?php include '../estrutura/menu.php'; ?>
        <?php
        if ($id_permissao == 1 || $id_permissao == 6 || $id_permissao == 4 || $id_permissao == 5 || $id_permissao == 2 || $id_permissao == 8 || $id_permissao == 7) {
            
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
                            <h3 class="panel-title"><a href="javascript:void(0);" class="toggle-sidebar"><span class="fa fa-angle-double-left" data-toggle="offcanvas" title="Esconder Menu"></span></a> Fornecedor</h3>
                        </div>
                        <div class="panel-body">
                            <form action="../../Controller/AvaliacaoControll.php" method="POST">
                                <div class="content-row">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <h2 class="content-row-title">Avaliação de Fornecedor - Cadastro</h2>
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <label>CNPJ do Fornecedor</label>
                                                    <input type="text" class="form-control" name="cnpj"
                                                           id="user_cpf" maxlength="18" onkeypress='mascaraMutuario(this, cpfCnpj)' onblur='clearTimeout()' data-error="Informe seu CNPJ">
                                                    <input type="hidden" name="idfornecedor">
                                                </div>
                                                <div class="col-md-3">
                                                    <label>Data</label>
                                                    <input type="date" class="form-control" name="data" value="<?= $data_banco ?>">
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label>Razão Social</label>
                                                    <input type="text" id="teste" readonly="" name="razao" class="form-control">
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-8">
                                                    <label>Produtos/Serviços</label>
                                                    <input type="text"  class="form-control" required="" name="produto">
                                                </div>                                       
                                            </div>
                                            <h4>Critérios para Avaliação</h4>
                                            <?php
                                            $count = 0;
                                            foreach ($cdao->BuscarTodos() as $cri) {
                                                $count ++;
                                                ?>
                                                <div clas="row">
                                                    <div class="col-md-9">
                                                        <input class="form-control" type="text" title="CRITÉRIO" readonly="" value="<?= $cri->getDescricao() ?>">
                                                        <input type="hidden" name="idcriterio[]"value="<?= $cri->getId() ?>">
                                                    </div>
                                                    <div class="col-md-1">
                                                        <input class="form-control teste" type="tel" id="peso<?= $cri->getId() ?>" name="peso<?= $cri->getId() ?>" title="NOTA PESO" readonly="" value="<?= $cri->getNotaPeso() ?>">
                                                    </div>
                                                    <div class="col-md-2">
                                                        <input class="form-control input-teste somente-numero" required="" type="tel" tabindex="<?=$count?>" id="nota<?= $cri->getId() ?>" name="nota[]" value="" placeholder="NOTA" onblur="calcular()" onchange="Verifica<?= $cri->getId() ?>(this)">
                                                    </div>
                                                </div>
                                            <?php } ?>
                                            <div class="row">
                                                <hr>
                                                <div class="col-md-2 pull-right">
                                                    <br>
                                                    <label>Pontuação Final</label>
                                                    <input type="text" name="media" id="media" readonly="" class="show-total form-control" >
                                                </div>
                                                <div class="col-md-12">
                                                    <br>
                                                    <label>Observação</label>
                                                    <textarea type="text" rows="3" name="obs" class="form-control"></textarea>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <label>Situação da Avaliação</label>
                                                    <select class="form-control" name="situacao">
                                                        <option value="2">PENDENTE</option>
                                                        <option value="1">CONCLUIDO</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <br>
                                            <a><button type="submit" name="gravar" class="btn btn-success"><span class="glyphicon glyphicon-list-alt"></span> Gravar</button></a>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script type='text/javascript'>
            var t = document.getElementsByClassName('teste');
            for (i = 0; i < t.length; i++) {
                console.log(t.value);
            }
        </script>
        <script type='text/javascript'>
            $(".input-teste").change(function () {
                var total = 0;
                $(".input-teste").each(function (index, element) {
                    if ($(element).val()) {
                        total += parseInt($(element).val());
                    }
                });
                $(".show-total").text(total);
                $("#media").val(total);
            });

            $(document).ready(function () {
                $("input[name='cnpj']").blur(function () {
                    var $nome_aluno = $("input[name='razao']");
                    var $rg = $("input[name='idfornecedor']");
                    $.getJSON('../../function/laudoInspecao.php', {
                        matricula: $(this).val()
                    }, function (json) {
                        $nome_aluno.val(json.nome_aluno);
                        if (json.nome_aluno === 'FORNECEDOR NÃO ENCONTRADO') {
                            document.getElementById('teste').style.border = '2px solid red';
                        } else {
                            document.getElementById('teste').style.border = '2px solid green';
                        }

                        $rg.val(json.rg);
                    });
                });
            });
        </script>

        <?php foreach ($cdao->BuscarTodos() as $cri) { ?>
            <script>
                function Verifica<?= $cri->getId() ?>(elemento) {
                    var peso = parseInt(document.getElementById('peso<?= $cri->getId() ?>').value);
                    var nota = parseInt(document.getElementById('nota<?= $cri->getId() ?>').value);


                    if (peso < nota) {

                        document.getElementById('nota<?= $cri->getId() ?>').value = "0";
                    }

                }


            </script>
            <script type="text/javascript">
                jQuery(function ($) {
                    $(document).on('keypress', 'input.somente-numero', function (e) {
                        var square = document.getElementById("nota<?= $cri->getId() ?>");
                        var key = (window.event) ? event.keyCode : e.which;
                        if ((key > 47 && key < 58)) {
                            //                        sonumero.style.backgroundColor = "#ffffff";
                            return true;

                        } else {
                            //                        sonumero.style.backgroundColor = "#ff0000";
                            return (key == 8 || key == 0) ? true : false;

                        }
                    });
                });
            </script>
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
        <?php } ?>
    </body>
</html>
