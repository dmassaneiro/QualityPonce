<?php

include_once '../../Config/ConexaoPDO.php';
include_once '../DAO/NcProdutoDAO.php';
include_once '../Model/NaoConformidadeProduto.php';
include_once '../DAO/HistoricoNcProdutoDAO.php';
include_once '../Model/HistoricoConformidadeProduto.php';


$nc = new NaoConformidadeProduto();
$ncDao = new NcProdutoDAO();
$historico = new HistoricoConformidadeProduto();
$historicoDao = new HistoricoNcProdutoDAO();

date_default_timezone_set('America/Sao_Paulo');
$data = date('Y-m-d H:i:s');
$deletar = filter_input(INPUT_GET, 'deletar');
$dados = filter_input_array(INPUT_POST);

if (isset($_POST['gravar'])) {

    if (empty($dados['data']) || empty($dados['descricao']) || empty($dados['acaoexecutada']) || empty($dados['destinacao']) ||
            empty($dados['responsavel1']) || empty($dados['responsavel2']) || empty($dados['responsavel3']) || empty($dados['investigar']) || empty($dados['pessoasnotificadas']) || empty($dados['tiponc'])) {
        header("Location: ../../App/Views/naoconformidade/cadastroproduto.php?msg=1");
    }

    $nc->setDataEmissao($dados['data']);
    $nc->setControle($dados['controle']);
    $nc->setDescricao(nl2br(strtoupper($dados['descricao'])));
    $nc->setAcaoExecutada(nl2br(strtoupper($dados['acaoexecutada'])));
    $nc->setDestino(nl2br(strtoupper($dados['destinacao'])));
    $nc->setResponsavel1(strtoupper($dados['responsavel1']));
    $nc->setResponsavel2(strtoupper($dados['responsavel2']));
    $nc->setResponsavel3(strtoupper($dados['responsavel3']));
    $nc->setInvestigar(strtoupper($dados['investigar']));
    $nc->setNotificados(nl2br(strtoupper($dados['pessoasnotificadas'])));
    $nc->setStatusId(2);
    $nc->setTipoNaoConformidadeProdutoId($dados['tiponc']);

    $historico->setData($data);
    $historico->setFuncionarioId($dados['idfuncionario']);
    $historico->setNaoConformidadeProdutoId($dados['id']);
    $historico->setStatusId(7);


    echo '<pre>';
    echo var_dump($nc);
    echo '</pre>';
    echo '<pre>';
    echo var_dump($historico);
    echo '</pre>';

    $ncDao->Inserir($nc);
    $historicoDao->Inserir($historico);

    header("Location: ../../App/Views/naoconformidade/inicioproduto.php");
}


if (isset($_POST['edit'])) {

    if (empty($dados['data']) || empty($dados['descricao']) || empty($dados['acaoexecutada']) || empty($dados['destinacao']) ||
            empty($dados['responsavel1']) || empty($dados['responsavel2']) || empty($dados['responsavel3']) || empty($dados['investigar']) || empty($dados['pessoasnotificadas']) || empty($dados['tiponc'])) {
        header("Location: ../../App/Views/naoconformidade/inicioproduto.php?msg=1");
    }

    $nc->setDataEmissao($dados['data']);
    $nc->setControle($dados['controle']);
    $nc->setDescricao(nl2br(strtoupper($dados['descricao'])));
    $nc->setAcaoExecutada(nl2br(strtoupper($dados['acaoexecutada'])));
    $nc->setDestino(nl2br(strtoupper($dados['destinacao'])));
    $nc->setResponsavel1(strtoupper($dados['responsavel1']));
    $nc->setResponsavel2(strtoupper($dados['responsavel2']));
    $nc->setResponsavel3(strtoupper($dados['responsavel3']));
    $nc->setInvestigar(strtoupper($dados['investigar']));
    $nc->setNotificados(nl2br(strtoupper($dados['pessoasnotificadas'])));
    $nc->setStatusId(2);
    $nc->setTipoNaoConformidadeProdutoId($dados['tiponc']);
    
    $nc->setId($dados['id']);

    $historico->setData($data);
    $historico->setFuncionarioId($dados['idfuncionario']);
    $historico->setNaoConformidadeProdutoId($dados['id']);
    $historico->setStatusId(6);


    echo '<pre>';
    echo var_dump($nc);
    echo '</pre>';
    echo '<pre>';
    echo var_dump($historico);
    echo '</pre>';

    $ncDao->Editar($nc);
    $historicoDao->Inserir($historico);
//
    header("Location: ../../App/Views/naoconformidade/inicioproduto.php");
}


if ($deletar != null) {

    $historicoDao->Deletar($deletar);
    $ncDao->Deletar($deletar);
    header("Location: ../../App/Views/naoconformidade/inicioproduto.php");
}