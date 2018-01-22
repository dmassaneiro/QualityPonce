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

$tdao = new TreinamentoDAO();
$t = new Treinamento();
$tfdao = new TreinamentoFuncionarioDAO();
$tf = new TreinamentoFuncionario();
$fdao = new FuncionarioDAO();

$deletar = filter_input(INPUT_GET, 'deletar');


$d = filter_input_array(INPUT_POST);
if (isset($_POST['gravar'])) {

    $t->setDataInicio($d['incio']);
    $t->setDescricao(strtoupper($d['nome']));
    $t->setDataFim($d['fim']);
    $t->setAplicador(strtoupper($d['aplicador']));
    $t->setLocalTreinamento(strtoupper($d['local']));
    $t->setConteudo(nl2br(strtoupper($d['conteudo'])));
    $t->setDescricaoMetodo(strtoupper($d['metodo']));
    $t->setDataPrazo($d['prazo']);
    $t->setResponsavel(strtoupper($d['responsavel']));
    $t->setEvidencias(nl2br(strtoupper($d['evidencias'])));
    $t->setDataVerificacao($d['verificacao']);
    $t->setEficaz($d['eficaz']);
    $t->setStatusId($d['situacao']);

    echo '<pre>';
    echo var_dump($d);
    echo '</pre>';

    $tdao->Inserir($t);

    foreach ($d['func'] as $func) {
        $ultimo_id = $tdao->BuscarUltimoRegistro();

        $id_func = $fdao->BuscarId($func);

        $count = 0;
        if (empty($id_func->getId())) {
            $count ++;
        }

        $tf->setTreinamentoId($ultimo_id->getId());
        $tf->setFuncionarioId($id_func->getId());
        $tf->setSituacao('C');

        echo '<pre>';
        echo var_dump($tf);
        echo '</pre>';

        echo $count;
        $tfdao->Inserir($tf);

        if ($count > 0) {
            header("Location: ../../App/Views/treinamento/inicio.php?msg=8");
        } else {
            header("Location: ../../App/Views/treinamento/inicio.php");
        }
    }
}
if (isset($_POST['editar'])) {

    $t->setDataInicio($d['incio']);
    $t->setDescricao(strtoupper($d['nome']));
    $t->setDataFim($d['fim']);
    $t->setAplicador(strtoupper($d['aplicador']));
    $t->setLocalTreinamento(strtoupper($d['local']));
    $t->setConteudo(nl2br(strtoupper($d['conteudo'])));
    $t->setDescricaoMetodo(strtoupper($d['metodo']));
    $t->setDataPrazo($d['prazo']);
    $t->setResponsavel(strtoupper($d['responsavel']));
    $t->setEvidencias(nl2br(strtoupper($d['evidencias'])));
    $t->setDataVerificacao($d['verificacao']);
    $t->setEficaz($d['eficaz']);
    $t->setStatusId($d['situacao']);

    $t->setId($d['idtreinamento']);

    echo '<pre>';
    echo var_dump($d);
    echo '</pre>';

    $tdao->Editar($t);
    $tfdao->Deletar($d['idtreinamento']);
    foreach ($d['func'] as $func) {
        $ultimo_id = $tdao->BuscarUltimoRegistro();

        $id_func = $fdao->BuscarId($func);

        $count = 0;
        if (empty($id_func->getId())) {
            $count ++;
        }

        $tf->setTreinamentoId($d['idtreinamento']);
        $tf->setFuncionarioId($id_func->getId());
        $tf->setSituacao('C');

        echo '<pre>';
        echo var_dump($tf);
        echo '</pre>';

        echo $count;

        $tfdao->Inserir($tf);

        if ($count > 0) {
            header("Location: ../../App/Views/treinamento/inicio.php?msg=8");
        } else {
            header("Location: ../../App/Views/treinamento/inicio.php");
        }
    }
}
if ($deletar != null) {

    $tfdao->Deletar($deletar);
    $tdao->Deletar($deletar);
    header("Location: ../../App/Views/treinamento/inicio.php");
}
