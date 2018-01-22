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

$d = filter_input_array(INPUT_POST);
$deletar = filter_input(INPUT_GET, 'del');

$c = new Categoria();
$cdao = new CategoriaDAO();

if (isset($_POST['gravar'])) {

    if ( empty($d['descricao'])) {
        header('Location: ../../App/Views/cadastros/categoria.php?msg=1');
    }

    $c->setDescricao(strtoupper($d['descricao']));

    echo '<pre>';
    echo var_dump($c);
    echo '</pre>';

    $cdao->Inserir($c);
    header('Location: ../../App/Views/cadastros/categoria.php');
}
if (isset($_POST['editar'])) {

    if (empty($d['descricao'])) {
        header('Location: ../../App/Views/cadastros/categoria.php?msg=1');
    }

    $c->setDescricao(strtoupper($d['descricao']));
    $c->setId($d['id']);

    echo '<pre>';
    echo var_dump($c);
    echo '</pre>';

    $cdao->Editar($c);
    header('Location: ../../App/Views/cadastros/categoria.php');
}
if ($deletar != null) {
    $teste = $cdao->VerificaParaDeletar($deletar);
    if ($teste->getId() == '0') {
        $cdao->Deletar($deletar);
        header("Location: ../../App/Views/cadastros/categoria.php");
        echo 'deu Bom';
    } else {
        echo 'deu ruim';
        header("Location: ../../App/Views/cadastros/categoria.php?msg=2");
    }
}



