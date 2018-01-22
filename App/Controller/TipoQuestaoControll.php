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

$nc = new TipoQuestao();
$ncDao = new TipoQuestionarioDAO();


$descricao = filter_input(INPUT_POST, 'descricao', FILTER_SANITIZE_STRING);
$sigla = filter_input(INPUT_POST, 'sigla', FILTER_SANITIZE_STRING);

$deletar = filter_input(INPUT_GET, 'del', FILTER_SANITIZE_NUMBER_INT);

if (isset($_POST['gravar'])) {

    if (empty($descricao)) {
        header("Location: ../../App/Views/cadastros/tipoQuestaoAuditoria.php?msg=1");
    } else {


        $nc->setDescricao(strtoupper($descricao));
//        $nc->setSigla(strtoupper($sigla));

        echo '<pre>';
        echo var_dump($nc);
        echo '</pre>';

        $ncDao->Inserir($nc);

        header("Location: ../../App/Views/cadastros/tipoQuestaoAuditoria.php");
    }
}
if (isset($_POST['editar'])) {

    if (empty($descricao)) {
        header("Location: ../../App/Views/cadastros/tipoQuestaoAuditoria.php?msg=1");
    } else {
        $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);

        $nc->setDescricao(strtoupper($descricao));
//         $nc->setSigla(strtoupper($sigla));

        $nc->setId($id);

        echo '<pre>';
        echo var_dump($nc);
        echo '</pre>';

        $ncDao->Editar($nc);

        header("Location: ../../App/Views/cadastros/tipoQuestaoAuditoria.php");
    }
}
if ($deletar != null) {
    $teste = $ncDao->VerificaParaDeletar($deletar);
    if ($teste->getId() == '0') {
        $ncDao->Deletar($deletar);
        header("Location: ../../App/Views/cadastros/tipoQuestaoAuditoria.php");
    } else {
        header("Location: ../../App/Views/cadastros/tipoQuestaoAuditoria.php?msg=2");
    }
}
