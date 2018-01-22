<?php
include_once '../../../Config/ConexaoPDO.php';
include_once '../../DAO/DocumentoDAO.php';
include_once '../../Model/Documento.php';
include_once '../../DAO/TipoDocumentoDAO.php';
include_once '../../Model/TipoDocumento.php';

$ddao = new DocumentoDAO();
$tdao = new TipoDocumentoDAO();
$id_doc = $ddao->BuscarUltimoRegistro();

$today     = new DateTime();
$next_year = $today->modify('+1 year');
$umanoamais = $next_year->format('Y-m-d');

?>
<!DOCTYPE html>
<html>
    <head>
        <title>Documentos</title>
        <?php include '../estrutura/head.php'; ?>
    </head>
    <body>
        <?php include '../estrutura/menu.php'; ?>
         <?php
        if ($id_permissao == 1 || $id_permissao == 6 || $id_permissao == 2 || $id_permissao == 4 || $id_permissao == 8|| $id_permissao == 3|| $id_permissao == 5|| $id_permissao == 7) {
            
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
                        <div class="panel-heading" id="documento">
                            <h3 class="panel-title"><a href="javascript:void(0);" class="toggle-sidebar"><span class="fa fa-angle-double-left" data-toggle="offcanvas" title="Esconder Menu"></span></a> Documentos</h3>
                        </div>
                        <div class="panel-body">
                            <div class="content-row">
                                <div class="row">
                                    <div class="col-md-12">
                                        <form action="../../Controller/DocumentoControll.php" method="POST" enctype="multipart/form-data">
                                            <h2 class="content-row-title">Documentos - Cadastro</h2>
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <label>Cod. do Documento</label>
                                                    <input type="text" class="form-control" value="<?= $id_doc->getId() + 1 ?>" readonly="">
                                                    <input type="hidden" name="idfuncionario" value="<?= $id_funcionario?>">
                                                </div>
                                                <div class="col-md-3">
                                                    <label>Data da Revisão</label>
                                                    <input type="date" id="inicio" class="form-control" name="data"  required="" value="<?= $data_banco ?>" onblur="validadata()">
                                                </div>
                                                <div class="col-md-3">
                                                    <label>Data de Validade</label>
                                                    <input type="date" id="fim" class="form-control" name="validade" required="" value="<?= $umanoamais ?>" onblur="validadata()">
                                                </div>
                                            </div>
                                            <br>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <label>Tipo de Documento</label>
                                                    <select class="form-control" name="tipo" required="">
                                                        <option value="">Selecione...</option>
                                                        <?php foreach ($tdao->BuscarTodos() as $tipo) { ?>
                                                        <option value="<?= $tipo->getId() ?>" style="text-transform: uppercase"><?= $tipo->getDescricao() ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                                <div class="col-md-6">
                                                    <label>Autor</label>
                                                    <input type="text" class="form-control" name="autor" required="">
                                                </div>
                                            </div>
                                            <br>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <label>Descrição</label>
                                                    <textarea rows="2" name="descricao" class="form-control"></textarea>
                                                </div>                                       
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <label>Documento</label>
                                                    <input type="file" name="arquivo">
                                                </div>                                       
                                            </div>
                                            <a><button  type="submit" name="gravar" class="btn btn-success"><span class="glyphicon glyphicon-list-alt"></span> Gravar</button></a>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <script>
    function validadata(){
        var inicio = document.getElementById('inicio').value;
        var fim = document.getElementById('fim').value;
        
        if (inicio > fim) {
            alert("Data Informada é Inválida");
            document.getElementById('fim').value = "<?=$umanoamais?>";
            document.getElementById('inicio').value = "<?=$data_banco?>";
    
}
    }
    </script>
</body>
</html>
