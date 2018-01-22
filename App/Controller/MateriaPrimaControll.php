<?php

include_once '../../Config/ConexaoPDO.php';
include_once '../Model/MateriaPrima.php';
include_once '../DAO/MateriaPrimaDAO.php';
include_once '../Model/Fornecedor.php';
include_once '../DAO/FornecedorDAO.php';

$materiaprima = new MateriaPrima();
$materiaprimaDao = new MateriaPrimaDAO();
$f = new Fornecedor();
$fdao = new FornecedorDAO();

$dados = filter_input_array(INPUT_POST);

$deletar = filter_input(INPUT_GET, 'deletar', FILTER_SANITIZE_NUMBER_INT);

if (isset($_POST['gravar'])) {
    if (empty($dados['nome']) || empty($dados['descricao']) || empty($dados['situacao']) || empty($dados['data'])) {
        header("Location: ../../App/Views/cadastros/materiaprima.php");
    }else {
        $materiaprima->setNome(strtoupper($dados['nome']));
        $materiaprima->setDescricao(nl2br(strtoupper($dados['descricao'])));
        $materiaprima->setFornecedorId($dados['idfornecedor']);
        $materiaprima->setDataCadastro($dados['data']);
        $materiaprima->setSituacao(strtoupper($dados['situacao']));
//        echo '<pre>';
//        echo var_dump($materiaprima);
//        echo '</pre>';
        $materiaprimaDao->Inserir($materiaprima);
        header("Location: ../../App/Views/cadastros/materiaprima.php");
    }
}
if (isset($_POST['editar'])) {

    if (empty($dados['nome']) || empty($dados['descricao']) || empty($dados['idfornecedor']) || empty($dados['situacao'])) {
        header("Location: ../../App/Views/cadastros/materiaprima.php?msg=1");
    }else {

        $materiaprima->setNome(strtoupper($dados['nome']));
        $materiaprima->setDescricao(nl2br(strtoupper($dados['descricao'])));
        $materiaprima->setFornecedorId($dados['idfornecedor']);
        $materiaprima->setDataCadastro($dados['data']);
        $materiaprima->setSituacao(strtoupper($dados['situacao']));

        $materiaprima->setId(($dados['id']));

        echo '<pre>';
        echo var_dump($materiaprima);
        echo '</pre>';

        $materiaprimaDao->Editar($materiaprima);

        header("Location: ../../App/Views/cadastros/materiaprima.php");
    }
}
if ($deletar != null) {
     $teste = $materiaprimaDao->VerificaParaDeletar2($deletar);
    if ($teste->getId() == '0') {
       $materiaprimaDao->Deletar($deletar);
        header("Location: ../../App/Views/cadastros/materiaprima.php");
        echo 'deu Bom';
    } else {
        echo 'deu ruim';
        header("Location: ../../App/Views/cadastros/materiaprima.php?msg=2");
    }
    
    
    
//    header("Location: ../../App/Views/cadastros/.php");
}

