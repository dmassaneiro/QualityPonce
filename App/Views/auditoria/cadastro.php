<?php
include_once '../../AutoLoad/AutoLoad.php';

$adao = new AuditoriaDAO();
$sdao = new SetorDAO();

$id_auditoria = $adao->BuscarUltimoRegistro();
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Auditoria</title>
        <?php include '../estrutura/head.php'; ?>
    </head>
    <body>
        <?php include '../estrutura/menu.php'; ?>
        <?php
        if ($id_permissao == 1 || $id_permissao == 6) {
            
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
                            <h3 class="panel-title"><a href="javascript:void(0);" class="toggle-sidebar"><span class="fa fa-angle-double-left" data-toggle="offcanvas" title="Esconder Menu"></span></a> Auditorias</h3>
                        </div>
                        <div class="panel-body">
                            <form action="../../Controller/AuditoriaControll.php" method="POST">
                                <div class="content-row">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <h2 class="content-row-title">Auditoria - Cadastro</h2>
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <label>Nr. Auditoria</label>
                                                    <input type="text" class="form-control" readonly="" value="<?= $id_auditoria->getId() + 1 ?>">
                                                    <input type="hidden" name="idfuncionario" value="<?= $id_funcionario ?>">
                                                </div>
                                                <div class="col-md-3">
                                                    <label>Data Início</label>
                                                    <input type="date" id="in" class="form-control" name="inicio" value="<?= $data_banco ?>" required="" onblur="validadata()">
                                                </div>
                                                <div class="col-md-3">
                                                    <label>Data Término</label>
                                                    <input type="date" id="fi" class="form-control" name="termino" value="<?= $data_banco ?>" required="" onblur="validadata()">
                                                </div>
                                            </div>
                                            <br>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <label>Setor</label>
                                                    <select class="form-control" name="setor" required="">
                                                        <!--<option>SELECIONE...</option>-->
                                                        <?php foreach ($sdao->BuscarTodosSetores() as $set) { ?>
                                                            <option value="<?= $set->getId() ?>"><?= $set->getDescricao() ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                                <div class="col-md-6">
                                                    <label>Auditor</label>
                                                    <input type="text" name="auditor" class="form-control" required="" >
                                                </div>
                                            </div>
                                            <br>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <label>Objetivos</label>
                                                    <textarea rows="3" name="objetivos" class="form-control"></textarea>
                                                </div>                                       
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <label>Escopo</label>
                                                    <textarea rows="3" name="escopo" class="form-control"></textarea>
                                                </div>                                       
                                            </div>
                                            <button type="submit" name="gravar" class="btn btn-info">Questionários</button>

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
                    document.getElementById('fi').value = "<?= $data_banco ?>";
                    document.getElementById('in').value = "<?= $data_banco ?>";

                }
            }
        </script>
    </body>
</html>
