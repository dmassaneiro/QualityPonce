<?php

include_once '../../Config/ConexaoPDO.php';
include_once '../DAO/DocumentoDAO.php';
include_once '../Model/Documento.php';
include_once '../DAO/ArquivoDAO.php';
include_once '../Model/Arquivo.php';
include_once '../DAO/HistoricoDocumentosDAO.php';
include_once '../Model/HistorioDocumentos.php';

$ddao = new DocumentoDAO();
$adao = new ArquivoDAO();
$hdao = new HistoricoDocumentosDAO();
$doc = new Documento();
$a = new Arquivo();
$historico = new HistorioDocumentos();


$data = date('Y-m-d');
$datatime = date('Y-m-d H:i:s');
$d = filter_input_array(INPUT_POST);
$deletar = filter_input(INPUT_GET, 'deletar');

$id = filter_input(INPUT_GET, 'id');
$remove = filter_input(INPUT_GET, 'remove');

if (isset($_POST['gravar'])) {

 echo $inicio = $d['data'];
    echo $fim = $d['validade'];
    if (empty($d['data']) || empty($d['validade']) || empty($d['tipo']) || empty($d['autor']) || empty($d['descricao'])) {
        header("Location: ../../App/Views/documentos/inicio.php?msg=1");
    }
    if (empty($_FILES['arquivo']['tmp_name'])) {
        header("Location: ../../App/Views/documentos/inicio.php?msg=1");
    }
    if ($d['data'] < $d['validade']) {
        echo 'deu ruim';
        header("Location: ../../App/Views/documentos/inicio.php?msg=9");
    }


    $doc->setDataValidade($d['validade']);
    $doc->setDataRevisao($d['data']);
    $doc->setAutor(strtoupper($d['autor']));
    $doc->setDescricao(nl2br(strtoupper($d['descricao'])));
    $doc->setTipoDocumentoId($d['tipo']);
    $doc->setStatusId(2);

    echo '<pre>';
    echo var_dump($doc);
    echo '</pre>';



    $ddao->Inserir($doc);
    $uploaddir = '../Documentos/' . md5(date('YmdHis'));
    $uploadfile = $uploaddir . $_FILES['arquivo']['name'];

    if (move_uploaded_file($_FILES['arquivo']['tmp_name'], $uploadfile)) {
        $id_doc = $ddao->BuscarUltimoRegistro();

        $a->setCaminho($uploadfile);
        $a->setDocumentoId($id_doc->getId());
        $a->setData($data);
        $a->setVersao(1);

        echo '<pre>';
        echo var_dump($a);
        echo '</pre>';

        $adao->Inserir($a);

        $ultimo_id = $ddao->BuscarUltimoRegistro();

        $historico->setData($datatime);
        $historico->setFuncionarioId($d['idfuncionario']);
        $historico->setDocumentoId($ultimo_id->getId());
        $historico->setStatusId(7);

        echo '<pre>';
        echo var_dump($historico);
        echo '</pre>';

        $hdao->Inserir($historico);
        header("Location: ../../App/Views/documentos/inicio.php");
    } else {
        $del = $ddao->BuscarUltimoRegistro();
        $ddao->Deletar($del->getId());
        header("Location: ../../App/Views/documentos/inicio.php?msg=6");
    }
}
//////EDITARR
if (isset($_POST['editar'])) {

    if (empty($d['data']) || empty($d['validade']) || empty($d['tipo']) || empty($d['autor']) || empty($d['descricao'])) {
        header("Location: ../../App/Views/documentos/inicio.php?msg=1");
    }
    echo $inicio = $d['data'];
    echo $fim = $d['validade'];
    if ($inicio < $fim) {
        header("Location: ../../App/Views/fichatecnica/inicio.php?msg=9");
    }
    $doc->setDataValidade($d['validade']);
    $doc->setDataRevisao($d['data']);
    $doc->setAutor(strtoupper($d['autor']));
    $doc->setDescricao(nl2br(strtoupper($d['descricao'])));
    $doc->setTipoDocumentoId($d['tipo']);
    $doc->setStatusId($d['situacao']);

    if ($d['situacao'] == '4') {
        $doc->setDataAprovacao($data);
    }

    $doc->setId($d['id']);

    echo '<pre>';
    echo var_dump($doc);
    echo '</pre>';

    $ddao->Editar($doc);

    $documento = $d['documento'];

    if ($_FILES['arquivo']['tmp_name'] != null) {
//        if (!unlink($documento)) {
//            header("Location: ../../App/Views/documentos/inicio.php?msg=7");
//        } else {
        $uploaddir = '../Documentos/' . md5(date('YmdHis'));
        $uploadfile = $uploaddir . $_FILES['arquivo']['name'];

        if (move_uploaded_file($_FILES['arquivo']['tmp_name'], $uploadfile)) {
            $id_doc = $ddao->BuscarUltimoRegistro();

            $versao = $adao->BuscarVersao($id_doc->getId());
            $nm_ver = $versao->getVersao() + 1;

            $a->setCaminho($uploadfile);
            $a->setDocumentoId($id_doc->getId());
            $a->setData($datatime);
            $a->setVersao($nm_ver);

            echo '<pre>';
            echo var_dump($a);
            echo '</pre>';

            $adao->Inserir($a);

            $historico->setData($datatime);
            $historico->setFuncionarioId($d['idfuncionario']);
            $historico->setDocumentoId($id_doc->getId());
            if ($d['situacao'] == '4') {
                $historico->setStatusId(4);
            } else if ($d['situacao'] == '5') {
                $historico->setStatusId(5);
            } else if ($d['situacao'] != '4' || $d['situacao'] != '5') {
                $historico->setStatusId(6);
            }
            echo '<pre>';
            echo var_dump($historico);
            echo '</pre>';

            $hdao->Inserir($historico);

            header("Location: ../../App/Views/documentos/inicio.php");
        } else {
            header("Location: ../../App/Views/documentos/inicio.php?msg=6");
        }
//        }
    } else {
        $id_doc = $ddao->BuscarUltimoRegistro();
        $historico->setData($datatime);
        $historico->setFuncionarioId($d['idfuncionario']);
        $historico->setDocumentoId($id_doc->getId());
        if ($d['situacao'] == '4') {
            $historico->setStatusId(4);
        } else if ($d['situacao'] == '5') {
            $historico->setStatusId(5);
        } else if ($d['situacao'] != '4' || $d['situacao'] != '5') {
            $historico->setStatusId(6);
        }
        echo '<pre>';
        echo var_dump($historico);
        echo '</pre>';

        $hdao->Inserir($historico);
        header("Location: ../../App/Views/documentos/inicio.php");
    }
}
if ($deletar != null) {

    $del = $adao->BuscarNome($deletar);

    foreach ($adao->BuscarTodos2($deletar) as $de) {
        unlink($de->getCaminho());
    }
    $adao->Deletar($deletar);
    $hdao->Deletar($deletar);
    $ddao->Deletar($deletar);

    header("Location: ../../App/Views/documentos/inicio.php");
}

if ($id != null && $remove != null) {
    $adao->Deletar2($remove);
    unlink($remove);

    $func = filter_input(INPUT_GET, 'func');

    $historico->setData($datatime);
    $historico->setFuncionarioId($func);
    $historico->setDocumentoId($id);
    $historico->setStatusId(11);

    echo '<pre>';
    echo var_dump($historico);
    echo '</pre>';

    $hdao->Inserir($historico);

    header("Location: ../../App/Views/documentos/editar.php?id=$id");
}