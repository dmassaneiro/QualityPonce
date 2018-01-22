<?php

include_once '../../Config/ConexaoPDO.php';
include_once '../Model/Produto.php';
include_once '../DAO/ProdutoDAO.php';

$produto = new Produto();
$produtoDao = new ProdutoDAO();

$nome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_STRING);
$descricao = filter_input(INPUT_POST, 'descricao', FILTER_SANITIZE_STRING);
$categoriaDao = filter_input(INPUT_POST, 'categoria', FILTER_SANITIZE_NUMBER_INT);
$situacao = filter_input(INPUT_POST, 'situacao', FILTER_SANITIZE_STRING);

$deletar = filter_input(INPUT_GET, 'deletar', FILTER_SANITIZE_NUMBER_INT);

if (isset($_POST['gravar'])) {

    if (empty($nome) || empty($descricao) || empty($categoriaDao) || empty($situacao)) {
        header("Location: ../../App/Views/cadastros/produto.php");
    } else {

        $produto->setNome(strtoupper($nome));
        $produto->setDescricao(strtoupper($descricao));
        $produto->setCategoriaId($categoriaDao);
        $produto->setSituacao(strtoupper($situacao));

        echo '<pre>';
        echo var_dump($produto);
        echo '</pre>';

        $produtoDao->Inserir($produto);

        header("Location: ../../App/Views/cadastros/produto.php");
    }
}
if (isset($_POST['editar'])) {

    if (empty($nome) || empty($descricao) || empty($categoriaDao) || empty($situacao)) {
        header("Location: ../../App/Views/cadastros/produto.php");
    } else {
        $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);

        $produto->setNome(strtoupper($nome));
        $produto->setDescricao(strtoupper($descricao));
        $produto->setCategoriaId($categoriaDao);
        $produto->setSituacao(strtoupper($situacao));
        $produto->setId($id);

        echo '<pre>';
        echo var_dump($produto);
        echo '</pre>';

        $produtoDao->Editar($produto);

        header("Location: ../../App/Views/cadastros/produto.php");
    }
}
if ($deletar != null) {
    $val = $produtoDao->VerificaParaDeletar($deletar);
    $val2 = $produtoDao->VerificaParaDeletar2($deletar);
    $val3 = $produtoDao->VerificaParaDeletar3($deletar);
    $val4 = $produtoDao->VerificaParaDeletar4($deletar);

    echo $val->getId() . '<br>';
    if ($val->getId() == null && $val2->getId() == null && $val3->getId() == null && $val4->getId() == null ) {
        echo 'erro';
        $produtoDao->Deletar($deletar);
        header("Location: ../../App/Views/cadastros/produto.php");
    } else {
        echo 'ebaum';
        header("Location: ../../App/Views/cadastros/produto.php?msg=2");
    }
}

