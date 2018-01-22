<?php
include_once '../../../Config/ConexaoPDO.php';
include_once '../../DAO/DocumentoDAO.php';
include_once '../../Model/Documento.php';
include_once '../../DAO/TipoDocumentoDAO.php';
include_once '../../Model/TipoDocumento.php';
include_once '../../DAO/ArquivoDAO.php';
include_once '../../Model/Arquivo.php';

$id = filter_input(INPUT_GET, 'id');

$ddao = new DocumentoDAO();
$adao = new ArquivoDAO();
$a = new Arquivo();
$tdao = new TipoDocumentoDAO();

$dados = $ddao->BuscarEdit($id);
$arquivo = $adao->BuscarNome($dados->getId());
$tipo = $tdao->BuscarNome($dados->getTipoDocumentoId());
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
                                                    <input type="text" class="form-control" value="<?= $dados->getId() ?>" readonly="">
                                                    <input type="hidden" name="id" value="<?= $dados->getId() ?>">
                                                    <input type="hidden" name="idfuncionario" value="<?= $id_funcionario ?>">
                                                </div>
                                                <div class="col-md-3">
                                                    <label>Data da Revisão</label>
                                                    <input type="date" class="form-control" id="in" name="data"  required="" value="<?= $dados->getDataRevisao() ?>" onblur="validadata()">
                                                </div>
                                                <div class="col-md-3">
                                                    <label>Data de Validade</label>
                                                    <input type="date" class="form-control" id="fi" name="validade" required="" value="<?= $dados->getDataValidade() ?>" onblur="validadata()">
                                                </div>
                                                <?php if ($dados->getDataAprovacao() != null) { ?>
                                                    <div class="col-md-3" style="background-color: #bbb">
                                                        <label>Data de Aprovação</label>
                                                        <input type="date" class="form-control" readonly="" value="<?= $dados->getDataAprovacao() ?>">
                                                    </div>
                                                <?php } ?>
                                            </div>
                                            <br>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <label>Tipo de Documento</label>
                                                    <select class="form-control" name="tipo" required="">
                                                        <option id="selecionado" style="" value="<?= $dados->getTipoDocumentoId() ?>"><?= $tipo->getDescricao() ?></option>
                                                        <?php foreach ($tdao->BuscarTodosMenos($dados->getTipoDocumentoId()) as $tipo) { ?>
                                                            <option  value="<?= $tipo->getId() ?>" style="text-transform: uppercase"><?= $tipo->getDescricao() ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                                <div class="col-md-6">
                                                    <label>Autor</label>
                                                    <input type="text" class="form-control" name="autor" required="" value="<?= $dados->getAutor() ?>">
                                                </div>
                                            </div>
                                            <br>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <label>Descrição</label>
                                                    <textarea rows="3" name="descricao" class="form-control"><?= strip_tags($dados->getDescricao()) ?></textarea>
                                                </div>                                       
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <label>Documento(s)</label><br>
                                                    <div class="table-responsive">
                                                        <table class="table">
                                                            <tr>
                                                                <th>Data</th>
                                                                <th>Versão</th>
                                                                <th></th>
                                                            </tr>
                                                            <tr>
                                                                <?php foreach ($adao->BuscarTodos2($dados->getId()) as $doc) { ?>
                                                                    <td><?= date("d/m/Y", strtotime($doc->getData())) ?></td>
                                                                    <td><?= $doc->getVersao() ?></td>
                                                                    <td><a  target="_blank" href="../../../App/Documentos/<?= $doc->getCaminho() ?>">
                                                                            <button class="btn btn-sm btn-default"  type="button" name="arquivo"><i class="fa fa-eye" aria-hidden="true"></i></button></a>
                                                                        <a href="../../../App/Documentos/<?= $doc->getCaminho() ?>" download="Versao<?= $doc->getVersao() ?>"><button class="btn btn-sm btn-primary"  type="button" name="arquivo"><i class="fa fa-download" aria-hidden="true"></i></button></a>
                                                                        <a href="../../Controller/DocumentoControll.php?id=<?= $dados->getId() ?>&remove=<?= $doc->getCaminho() ?>&func=<?= $id_funcionario ?>"><button class="btn btn-sm btn-danger"  type="button" name="arquivo"><i class="fa fa-trash" aria-hidden="true"></i></button></a>
                                                                    </td>
                                                                </tr>
                                                            <?php } ?>
                                                        </table>
                                                    </div>                     
                                                    <input type="hidden" name="documento" value="<?= $arquivo->getCaminho() ?>">                                                   
                                                </div>   
                                                <div class="col-md-6" >
                                                    <label >Novo Documento</label>
                                                    <input style="" type="file" name="arquivo">

                                                </div>                                       
                                            </div>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <label>Situação</label>
                                                    <select class="form-control" name="situacao" >
                                                        <option  value="2">PENDENTE</option>
                                                        <option  value="4">APROVADO</option>
                                                        <option  value="5">REPROVADO</option>
                                                    </select>
                                                </div>                              
                                            </div>
                                            <a><button  type="submit" name="editar" class="btn btn-success"><span class="glyphicon glyphicon-list-alt"></span> Gravar</button></a>
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
            function validadata() {
                var inicio = document.getElementById('in').value;
                var fim = document.getElementById('fi').value;

                if (inicio > fim) {
                    alert("Data Informada é Inválida");
                    document.getElementById('fi').value = "<?= $dados->getDataValidade()?>";
                    document.getElementById('in').value = "<?= $dados->getDataRevisao()?>";

                }
            }
        </script>
    </body>
</html>
