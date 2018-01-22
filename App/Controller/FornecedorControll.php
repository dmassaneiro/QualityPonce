<?php

function __autoload($classname) {
    include_once '../../Config/ConexaoPDO.php';
    if (file_exists($dao = "../DAO/" . $classname . ".php")) {
        include_once($dao);
    }
    if (file_exists($model = "../Model/" . $classname . ".php")) {
        include_once($model);
    }
}

$f = new Fornecedor();
$fdao = new FornecedorDAO();


$d = filter_input_array(INPUT_POST);

$deletar = filter_input(INPUT_GET, 'deletar', FILTER_SANITIZE_NUMBER_INT);

if (isset($_POST['gravar'])) {

    if (empty($d['cnpj']) || empty($d['nome']) || empty($d['fantasia'])) {
        header("Location: ../../App/Views/cadastros/fornecedor.php?msg=1");
    }
    $valida = $fdao->VerificaCnpj($d['cnpj']);
    echo $valida->getId();
    echo $d['cnpj'];
    if ($valida->getId() != null) {
        header("Location: ../../App/Views/cadastros/fornecedor.php?msg=15");
    } else {

        $f->setCnpj($d['cnpj']);
        $f->setNome(strtoupper($d['nome']));
        $f->setNomeFantasia(strtoupper($d['fantasia']));
        $f->setSituacao(strtoupper($d['situacao']));


        echo '<pre>';
        echo var_dump($f);
        echo '</pre>';

        $fdao->Inserir($f);

        header("Location: ../../App/Views/cadastros/fornecedor.php");
    }
}
if (isset($_POST['editar'])) {

    if (empty($d['cnpj']) || empty($d['nome']) || empty($d['fantasia'])) {
        header("Location: ../../App/Views/cadastros/fornecedor.php?msg=1");
    }
    $valida = $fdao->VerificaCnpj($d['cnpj']);
     if ($valida->getId() != null) {
        header("Location: ../../App/Views/cadastros/fornecedor.php?msg=15");
    } else {

        $f->setCnpj($d['cnpj']);
        $f->setNome(strtoupper($d['nome']));
        $f->setNomeFantasia(strtoupper($d['fantasia']));
        $f->setSituacao(strtoupper($d['situacao']));
        $f->setId($d['cod']);


        echo '<pre>';
        echo var_dump($f);
        echo '</pre>';

        $fdao->Editar($f);

        header("Location: ../../App/Views/cadastros/fornecedor.php");
    }
}
if ($deletar != null) {
    $teste = $fdao->VerificaParaDeletar($deletar);
    $teste2 = $fdao->VerificaParaDeletar2($deletar);
    if ($teste->getId() == '0' && $teste2->getId() == '0') {
        $fdao->Deletar($deletar);
        header("Location: ../../App/Views/cadastros/fornecedor.php");
    } else {
        header("Location: ../../App/Views/cadastros/fornecedor.php?msg=2");
    }
}

