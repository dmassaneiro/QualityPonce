<?php
include_once '../../AutoLoad/AutoLoad.php';

$pdao = new ProdutoDAO();
$fdao = new FichaTecnicaDAO();
$idao = new ItemTesteDAO();
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
                            <h3 class="panel-title"><a href="javascript:void(0);" class="toggle-sidebar"><span class="fa fa-angle-double-left" data-toggle="offcanvas" title="Esconder Menu"></span></a> Ficha Técnica/ Instrumentos</h3>
                        </div>
                        <div class="panel-body">
                            <form method="POST" action="../../Controller/FichaTecnicaControll.php">
                                <div class="content-row">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <h2 class="content-row-title">Ficha Técnica - Instrumentos</h2>
                                            <input type="hidden" name="idficha" value="<?= $dados->getId() ?>" readonly="">
                                            <input type="hidden" name="idfuncionario" value="<?= $id_funcionario ?>"/>
                                            <div class="row">
                                                <div class="col-md-10">
                                                    <h4>Instrumentos</h4>
                                                    <div class="table-responsive">  
                                                        <table class="table" id="dynamic_field"> 
                                                            <?php
                                                            $i = 0;
                                                            $inss = new FichaTecnicaInstrumentoDAO();
                                                            $instrumento = new InstrumentoDAO();
                                                            foreach ($inss->BuscarTodosdaFicha($dados->getId()) as $tf) {
                                                                $nm_instrumento = $instrumento->BuscaroNomePeloId($tf->getInstrumentoId());
                                                                $i ++;
                                                                ?>
                                                                <tr id="row<?= $i ?>">
                                                                    <td id="treinamento"><input  type="text" list="browsers" name="func[]" id="item" placeholder="Nome do Funcionário" value="<?= $nm_instrumento->getDescricao() ?>" class="form-control name_list" /></td>
                                                                    <td id="treinamento"><button type="button" name="remove" id="<?= $i ?>" class="btn btn-danger btn_remove"><i class="fa fa-lg fa-remove"></i>   Remover</button></td>
                                                                </tr>

                                                            <?php } ?>  
                                                            <tr>
                                                            </tr>
                                                        </table>
                                                        <table class="table" >
                                                            <tr>  
                                                                <td id="treinamento"><button type="button" name="add" id="add" class="btn btn-success"><i class="fa fa-lg fa-plus"></i>   Adicionar Instrumentos</button></td>  
                                                            </tr>  
                                                        </table>   
                                                    </div>  
                                                </div>
                                            </div>  
                                            <datalist id="browsers">
                                                <?PHP
                                                $ins = new InstrumentoDAO();
                                                foreach ($ins->BuscarTodos() as $i) {
                                                    ?>
                                                    <option data-value="<?= $i->getDescricao() ?>" value="<?= $i->getDescricao() ?>"><?= $i->getIdentificacao() ?></option>                          
                                                <?php } ?>
                                            </datalist>
                                            <div class="btn-group dropup">
                                                <button class="btn btn-primary" type="submit" name="instrumentos-edit">Liberação</button>
                                            </div>  
                                            <div class="btn-group dropup">
                                                <button class="btn btn-warning" type="submit" name="instrumentos-edit-sair">Editar e Sair</button>
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
                $(document).ready(function () {
                    $('button').click(function () {
                        var value = $('input').val();
                        console.log($('#browsers [value="' + value + '"]').data('value'));
                    });
                });

                $(function () {
                    $("#item").autocomplete({
                        source: 'item.php'
                    });
                });</script>   
            <script>
                $(document).ready(function () {
                    var i = 1;
                    $('#add').click(function () {
                        i++;
                        $('#dynamic_field').append('<tr id="row' + i + '"><td id="treinamento"><input  type="text" list="browsers" name="func[]" id="item" placeholder="Nome do Instrumento" class="form-control name_list" /></td><td id="treinamento"><button type="button" name="remove" id="' + i + '" class="btn btn-danger btn_remove"><i class="fa fa-lg fa-remove"></i>   Remover</button></td></tr>');

                    });
                    $(document).on('click', '.btn_remove', function () {
                        var button_id = $(this).attr("id");
                        $('#row' + button_id + '').remove();
                    });
                });

            </script>
    </body>
</html>
