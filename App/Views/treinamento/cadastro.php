<?php
include_once '../../AutoLoad/AutoLoad.php';

$tdao = new TreinamentoDAO();
$fdao = new FuncionarioDAO();

$ultimo_id = $tdao->BuscarUltimoRegistro();
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Treinamentos</title>
        <?php include '../estrutura/head.php'; ?>

        <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
        <script src="//code.jquery.com/jquery-1.10.2.js"></script>
        <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
    </head>
    <body>
        <?php include '../estrutura/menu.php'; ?>
        <?php
        if ($id_permissao == 1 || $id_permissao == 6 || $id_permissao == 2 || $id_permissao == 4 || $id_permissao == 7) {
            
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
                            <h3 class="panel-title"><a href="javascript:void(0);" class="toggle-sidebar"><span class="fa fa-angle-double-left" data-toggle="offcanvas" title="Esconder Menu"></span></a> Treinamentos</h3>
                        </div>
                        <div class="panel-body">
                            <form name="add_name" id="add_name" action="../../Controller/TreinamentoControll.php" method="POST">  
                                <div class="content-row">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <h2 class="content-row-title">Treinamentos - Cadastro</h2>
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <label>Treinamento N°</label>
                                                    <input type="text" class="form-control" readonly="" value="<?= $ultimo_id->getId() + 1 ?>">
                                                    <input type="hidden" name="idfuncionario" value="<?= $id_funcionario ?>">
                                                </div>
                                                <div class="col-md-3">
                                                    <label>Data Início</label>
                                                    <input type="date" id="in" name="incio" class="form-control" value="<?= $data_banco ?>" onblur="validadata()">
                                                </div>
                                                <div class="col-md-3">
                                                    <label>Data Fim</label>
                                                    <input type="date" id="fi" name="fim" class="form-control" value="<?= $data_banco ?>" onblur="validadata()">
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label>Descrição/ Nome Treinamento</label>
                                                    <input type="text" id="item" name="nome"  required="" class="form-control">
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label>Nome do Aplicador</label>
                                                    <input type="text" id="item" name="aplicador" class="form-control">
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label>Local</label>
                                                    <input type="text"name="local" class="form-control">
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12   ">
                                                    <label>Conteúdo Programático</label>
                                                    <textarea type="text" name="conteudo" rows="3" class="form-control" ></textarea>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-10">
                                                    <h4>Participantes</h4>
                                                    <div class="table-responsive">  
                                                        <table class="table" id="dynamic_field"> 
                                                            <tr>
                                                            </tr>
                                                        </table>
                                                        <table class="table" >
                                                            <tr>  
                                                                <td id="treinamento"><button type="button" name="add" id="add" class="btn btn-success"><i class="fa fa-lg fa-plus"></i>   Adicionar Participantes</button></td>  
                                                            </tr>  
                                                        </table>  
                                                        <!--<input type="button" name="submit" id="submit" class="btn btn-info" value="Submit" />-->  
                                                    </div>  
                                                </div>
                                            </div>  
                                            <hr>

                                            <div class="row">
                                                <div class="col-md-6">
                                                    <h4>Medição de Eficácia do Treinamento</h4>
                                                    <label>Descrição do Método</label>
                                                    <input class="form-control" name="metodo" type="text"/>
                                                </div>
                                                <div class="col-md-3">
                                                    <h4><br></h4>
                                                    <label>Prazo</label>
                                                    <input class="form-control" name="prazo" type="date" value="<?= $data_banco ?>"/>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <label>Evidências</label>
                                                    <textarea rows="3" class="form-control" name="evidencias"/></textarea>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label>Responsavel pela Verificação</label>
                                                    <input class="form-control" id="item" name="responsavel" type="text"/>
                                                </div>
                                                <div class="col-md-3">
                                                    <label>Data da Verificação</label>
                                                    <input class="form-control" name="verificacao" type="date" value="<?= $data_banco ?>"/>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <label>Eficaz?</label>
                                                    <select class="form-control" name="eficaz">
                                                        <option value="S">SIM</option>
                                                        <option value="N">NÃO</option>
                                                    </select>
                                                </div>

                                                <div class="col-md-4">
                                                    <label>Situacao do Treinamento</label>
                                                    <select class="form-control" name="situacao">
                                                        <option value="2">PENDENTE</option>
                                                        <option value="1">CONCLUIDO</option>
                                                        <option value="3">CANCELADO</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>  
                                    </div>                                
                                    <a><button type="submit" name="gravar" class="btn btn-success">Gravar</button></a>
                                    <br>
                                </div>
                                <br>
                                <datalist id="browsers">
                                    <?php foreach ($fdao->BuscarTodosFuncionario() as $func) { ?>
                                        <option data-value="<?= $func->getId() ?>" value="<?= $func->getNome() ?>">                              
                                        <?php } ?>
                                </datalist>
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
                    document.getElementById('fi').value = "<?= $data_banco ?>";
                    document.getElementById('in').value = "<?= $data_banco ?>";

                }
            }
        </script>
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
                    $('#dynamic_field').append('<tr id="row' + i + '"><td id="treinamento"><input  type="text" list="browsers" name="func[]" id="item" placeholder="Nome do Funcionário" class="form-control name_list" /></td><td id="treinamento"><button type="button" name="remove" id="' + i + '" class="btn btn-danger btn_remove"><i class="fa fa-lg fa-remove"></i>   Remover</button></td></tr>');

                });
                $(document).on('click', '.btn_remove', function () {
                    var button_id = $(this).attr("id");
                    $('#row' + button_id + '').remove();
                });
            });
        </script>

    </body>
</html>
