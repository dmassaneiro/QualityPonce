<?php

include_once '../../Config/ConexaoPDO.php';
include_once '../DAO/NcProcessoDAO.php';
include_once '../Model/NaoConformidade.php';
include_once '../DAO/HistoricoNcProcessoDAO.php';
include_once '../Model/HistoricoNaoConformidade.php';

$dadosnc = filter_input_array(INPUT_POST);
$deletar = filter_input(INPUT_GET, 'deletar');

date_default_timezone_set('America/Sao_Paulo');
$data = date('Y-m-d H:i:s');

$nc = new NaoConformidade();
$ncDao = new NcProcessoDAO();
$historico = new HistoricoNaoConformidade();
$historicoDao = new HistoricoNcProcessoDAO();

if (isset($_POST['gravar'])) {

    if (empty($dadosnc['areadeteccao']) || empty($dadosnc['origem']) || empty($dadosnc['descricaonc']) || empty($dadosnc['acaoexecutada']) || empty($dadosnc['justificativa'])) {
        header("Location: ../../App/Views/naoconformidade/cadastroprocesso.php?msg=1");
    }

    $nc->setDataEmisao($dadosnc['data']);
    $nc->setSetorId($dadosnc['areadeteccao']);
    $nc->setTipoNaoConformidadeId($dadosnc['origem']);
    $nc->setDescricao(strtoupper(nl2br($dadosnc['descricaonc'])));
    $nc->setAcaoExecutada(strtoupper(nl2br($dadosnc['acaoexecutada'])));
    $nc->setJustifiva(strtoupper(nl2br($dadosnc['justificativa'])));
    $nc->setNotificado(strtoupper(nl2br($dadosnc['notificados'])));
    $nc->setAcaoCorretiva(strtoupper($dadosnc['acaocorretiva']));
    $nc->setGravidade(strtoupper($dadosnc['gravidade']));
    $nc->setStatusId($dadosnc['situacao']);

    $historico->setData($data);
    $historico->setFuncionarioId($dadosnc['idfuncionario']);
    $historico->setNaoConformidadeId($dadosnc['id']);
    $historico->setStatusId(7);

    echo '<pre>';
    echo var_dump($nc);
    echo '</pre>';
    echo '<pre>';
    echo var_dump($historico);
    echo '</pre>';

    $ncDao->Inserir($nc);
    $historicoDao->Inserir($historico);
    header("Location: ../../App/Views/naoconformidade/inicioprocesso.php");
}
if (isset($_POST['edit'])) {

    
    if (empty($dadosnc['areadeteccao']) || empty($dadosnc['origem']) || empty($dadosnc['descricaonc']) || empty($dadosnc['acaoexecutada']) || empty($dadosnc['justificativa'])) {
        header("Location: ../../App/Views/naoconformidade/inicioprocesso.php?msg=1");
    }
    
    $nc->setId($dadosnc['id']);
    $nc->setDataEmisao($dadosnc['data']);
    $nc->setSetorId($dadosnc['areadeteccao']);
    $nc->setTipoNaoConformidadeId($dadosnc['origem']);
    $nc->setDescricao(strtoupper(nl2br($dadosnc['descricaonc'])));
    $nc->setAcaoExecutada(strtoupper(nl2br($dadosnc['acaoexecutada'])));
    $nc->setJustifiva(strtoupper(nl2br($dadosnc['justificativa'])));
    $nc->setNotificado(strtoupper(nl2br($dadosnc['notificados'])));
    $nc->setAcaoCorretiva(strtoupper($dadosnc['acaocorretiva']));
    $nc->setGravidade(strtoupper($dadosnc['gravidade']));
    $nc->setStatusId($dadosnc['situacao']);

    $historico->setData($data);
    $historico->setFuncionarioId($dadosnc['idfuncionario']);
    $historico->setNaoConformidadeId($dadosnc['id']);
    $historico->setStatusId(6);

    echo '<pre>';
    echo var_dump($nc);
    echo '</pre>';
    echo '<pre>';
    echo var_dump($historico);
    echo '</pre>';

    $ncDao->Editar($nc);
    $historicoDao->Inserir($historico);
    header("Location: ../../App/Views/naoconformidade/inicioprocesso.php");
}
if ($deletar != null) {

    $historicoDao->Deletar($deletar);
    $ncDao->Deletar($deletar);
    header("Location: ../../App/Views/naoconformidade/inicioprocesso.php");
}