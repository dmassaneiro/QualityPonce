<?php

include_once '../../Config/ConexaoPDO.php';
include_once '../Model/Setor.php';
include_once '../DAO/SetorDAO.php';

$setor = new Setor();
$setorDao = new SetorDAO();


$descricao = filter_input(INPUT_POST, 'descricao', FILTER_SANITIZE_STRING);

$deletar = filter_input(INPUT_GET, 'del', FILTER_SANITIZE_NUMBER_INT);

if (isset($_POST['gravar'])) {

    if (empty($descricao)) {
        header("Location: ../../App/Views/cadastros/tiponc.php?msg=1");
    } else {

        $setor->setDescricao(strtoupper($descricao));

        echo '<pre>';
        echo var_dump($setor);
        echo '</pre>';

        $setorDao->Inserir($setor);

        header("Location: ../../App/Views/cadastros/setor.php");
    }
}
if (isset($_POST['editar'])) {

    if (empty($descricao)) {
        header("Location: ../../App/Views/cadastros/tiponc.php?msg=1");
    } else {
        $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);

        $setor->setDescricao(strtoupper($descricao));

        $setor->setId($id);

        echo '<pre>';
        echo var_dump($setor);
        echo '</pre>';

        $setorDao->Editar($setor);

        header("Location: ../../App/Views/cadastros/setor.php");
    }
}
if ($deletar != null) {
    $teste = $setorDao->VerificaParaDeletar($deletar);
    if ($teste->getId() == '0') {
        $teste = $setorDao->Deletar($deletar);
        header("Location: ../../App/Views/cadastros/setor.php");
    } else {
        header("Location: ../../App/Views/cadastros/setor.php?msg=2");
    }
}

