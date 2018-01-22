<?php

include_once '../../Config/ConexaoPDO.php';
include_once '../Model/TipoNaoConformidade.php';
include_once '../DAO/TipoNaoConformidadeDAO.php';

$nc = new TipoNaoConformidade();
$ncDao = new TipoNaoConformidadeDAO();


$descricao = filter_input(INPUT_POST, 'descricao', FILTER_SANITIZE_STRING);

$deletar = filter_input(INPUT_GET, 'del', FILTER_SANITIZE_NUMBER_INT);

if (isset($_POST['gravar'])) {

    if (empty($descricao)) {
        header("Location: ../../App/Views/cadastros/tiponc.php?msg=1");
    } else {


        $nc->setDescricao(strtoupper($descricao));

        echo '<pre>';
        echo var_dump($nc);
        echo '</pre>';

        $ncDao->Inserir($nc);

        header("Location: ../../App/Views/cadastros/tiponc.php");
    }
}
if (isset($_POST['editar'])) {

    if (empty($descricao)) {
        header("Location: ../../App/Views/cadastros/tiponc.php?msg=1");
    } else {
        $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);

        $nc->setDescricao(strtoupper($descricao));

        $nc->setId($id);

        echo '<pre>';
        echo var_dump($nc);
        echo '</pre>';

        $ncDao->Editar($nc);

        header("Location: ../../App/Views/cadastros/tiponc.php");
    }
}
if ($deletar != null) {
    $teste = $ncDao->VerificaParaDeletar($deletar);
    if ($teste->getId() == '0') {
        $teste = $ncDao->Deletar($deletar);
        header("Location: ../../App/Views/cadastros/tiponc.php");
    } else {
       header("Location: ../../App/Views/cadastros/tiponc.php?msg=2"); 
    }
}

