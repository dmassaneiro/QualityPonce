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

$deletar = filter_input(INPUT_GET, 'deletar');

$datatime = date('Y-m-d H:i:s');
$adao = new AuditoriaDAO();
$a = new Auditoria();
$aqdao = new AuditoriaQuestaoDAO();
$aq = new AuditoriaQuestionario();

$hdao = new HistoricoAuditoriaDAO();
$h = new HistoricoAuditoria();

$d = filter_input_array(INPUT_POST);

if (isset($_POST['gravar'])) {

    if (empty($d['inicio']) || empty($d['termino']) || empty($d['setor']) || empty($d['auditor'])) {

        header("Location: ../../App/Views/auditoria/inicio.php?msg=1");
    }
//    while ($d['inicio'] > $d['termino']) {
//        header("Location: ../../App/Views/auditoria/inicio.php?msg=9");
//    }

    $a->setDataInicio($d['inicio']);
    $a->setDataFim($d['termino']);
    $a->setConclusao(nl2br(strtoupper($d[''])));
    $a->setEscopo(nl2br(strtoupper($d['escopo'])));
    $a->setObjetivos(nl2br(strtoupper($d['objetivos'])));
    $a->setSetorId($d['setor']);
    $a->setAuditor(strtoupper($d['auditor']));
    $a->setSituacao('A');

    $adao->Inserir($a);

    $i = $adao->BuscarUltimoRegistro();
    $id = $i->getId();

    echo '<pre>';
    echo var_dump($a);
    echo '</pre>';

    $h->setAuditoriaId($id);
    $h->setData($datatime);
    $h->setFuncionarioId($d['idfuncionario']);
    $h->setStatusId(7);

    echo '<pre>';
    echo var_dump($h);
    echo '</pre>';

    $hdao->Inserir($h);

    header("Location: ../../App/Views/auditoria/questionario.php?id=$id");
}
if (isset($_POST['questionario'])) {
    echo 'oi';

    if (empty($d['inicio']) || empty($d['idauditoria']) || empty($d['termino']) || empty($d['setor']) || empty($d['auditor'])) {

        header("Location: ../../App/Views/auditoria/inicio.php?msg=1");
    }

    $a->setDataInicio($d['inicio']);
    $a->setDataFim($d['termino']);
    $a->setSetorId($d['setor']);
    $a->setAuditor(strtoupper($d['auditor']));
    $a->setId($d['idauditoria']);
//
    $adao->EditarQuestionario($a);

    $i = $adao->BuscarUltimoRegistro();
    $id = $i->getId();

    echo '<pre>';
    echo var_dump($a);
    echo '</pre>';


    for ($i = 0; $i < count($d['situacao']); $i++) {

        $situacao = $d['situacao'];
        $evi = $d['evidencia'];
        $idquestao = $d['iditemquestao'];

        $aq->setAuditoriaId($d['idauditoria']);
        $aq->setEvidencias(nl2br(strtoupper($evi[$i])));
        $aq->setItemQuestionarioId($idquestao[$i]);
        $aq->setResposta($situacao[$i]);

        echo '<pre>';
        echo var_dump($aq);
        echo '</pre>';

        $aqdao->Inserir($aq);
    }
    header("Location: ../../App/Views/auditoria/resultado.php?id=$id");
}

if (isset($_POST['resultado'])) {

    if (empty($d['inicio']) || empty($d['idauditoria']) || empty($d['termino']) || empty($d['setor']) || empty($d['auditor'])) {

        header("Location: ../../App/Views/auditoria/inicio.php?msg=1");
    }
    echo 'oi';

    $a->setDataInicio($d['inicio']);
    $a->setDataFim($d['termino']);
    $a->setSetorId($d['setor']);
    $a->setAuditor(strtoupper($d['auditor']));
    $a->setSugestao(nl2br(strtoupper($d['sugestao'])));
    $a->setConclusao(nl2br(strtoupper($d['conclusao'])));
    $a->setId($d['idauditoria']);
    $a->setSituacao($d['situacao2']);
//
    $adao->EditarResultado($a);
    $i = $adao->BuscarUltimoRegistro();
    $id = $i->getId();
//
    echo '<pre>';
    echo var_dump($a);
    echo '</pre>';
//
    if (empty($d['inicio']) || empty($d['idauditoria']) || empty($d['termino']) || empty($d['setor']) || empty($d['auditor'])) {

        header("Location: ../../App/Views/auditoria/inicio.php?msg=1");
    }
    for ($i = 0; $i < count($d['situacao']); $i++) {

        $situacao = $d['situacao'];
        $evi = $d['evidencia'];
        $idquestao = $d['iditemquestao'];

        $aq->setAuditoriaId($d['idauditoria']);
        $aq->setEvidencias(nl2br(strtoupper($evi[$i])));
        $aq->setItemQuestionarioId($idquestao[$i]);
        $aq->setResposta($situacao[$i]);

        echo '<pre>';
        echo var_dump($aq);
        echo '</pre>';

        $aqdao->Editar($aq);
    }
    header("Location: ../../App/Views/auditoria/inicio.php");
}
///EDITAR///////////////////////////////////////////
if (isset($_POST['editar'])) {

    if (empty($d['inicio']) || empty($d['termino']) || empty($d['setor']) || empty($d['auditor'])) {

        header("Location: ../../App/Views/auditoria/inicio.php?msg=1");
    }

    $a->setDataInicio($d['inicio']);
    $a->setDataFim($d['termino']);
    $a->setConclusao(nl2br(strtoupper($d[''])));
    $a->setEscopo(nl2br(strtoupper($d['escopo'])));
    $a->setObjetivos(nl2br(strtoupper($d['objetivos'])));
    $a->setSetorId($d['setor']);
    $a->setAuditor(strtoupper($d['auditor']));
    $a->setId($d['idauditoria']);

    $adao->Editar($a);

    $i = $adao->BuscarUltimoRegistro();
    $id = $d['idauditoria'];

    echo '<pre>';
    echo var_dump($a);
    echo '</pre>';

    $h->setAuditoriaId($id);
    $h->setData($datatime);
    $h->setFuncionarioId($d['idfuncionario']);
    $h->setStatusId(6);

    echo '<pre>';
    echo var_dump($h);
    echo '</pre>';

    $hdao->Inserir($h);

    header("Location: ../../App/Views/auditoria/editarquestionario.php?id=$id");
}

if (isset($_POST['editarquestionario'])) {

    if (empty($d['inicio']) || empty($d['idauditoria']) || empty($d['termino']) || empty($d['setor']) || empty($d['auditor'])) {

        header("Location: ../../App/Views/auditoria/inicio.php?msg=1");
    }
    echo 'oi';
//    
    $a->setDataInicio($d['inicio']);
    $a->setDataFim($d['termino']);
    $a->setSetorId($d['setor']);
    $a->setAuditor(strtoupper($d['auditor']));
    $a->setId($d['idauditoria']);
////
    $adao->EditarQuestionario($a);
//    $i = $adao->BuscarUltimoRegistro();
    $id = $d['idauditoria'];
////
    echo '<pre>';
    echo var_dump($a);
    echo '</pre>';


//
    if (empty($d['inicio']) || empty($d['idauditoria']) || empty($d['termino']) || empty($d['setor']) || empty($d['auditor'])) {

        header("Location: ../../App/Views/auditoria/inicio.php?msg=1");
    }
    
    $aqdao->Deletar($d['idauditoria']);
    for ($i = 0; $i < count($d['situacao']); $i++) {

        $situacao = $d['situacao'];
        $evi = $d['evidencia'];
        $idquestao = $d['iditemquestao'];

        $aq->setAuditoriaId($d['idauditoria']);
        $aq->setEvidencias(nl2br(strtoupper($evi[$i])));
        $aq->setItemQuestionarioId($idquestao[$i]);
        $aq->setResposta($situacao[$i]);

        echo '<pre>';
        echo var_dump($aq);
        echo '</pre>';

        $aqdao->Inserir($aq);
    }
    $h->setAuditoriaId($id);
    $h->setData($datatime);
    $h->setFuncionarioId($d['idfuncionario']);
    $h->setStatusId(9);

    echo '<pre>';
    echo var_dump($h);
    echo '</pre>';

    $hdao->Inserir($h);
//    
    header("Location: ../../App/Views/auditoria/editarresultado.php?id=$id");
}

if (isset($_POST['editarresultado'])) {

    if (empty($d['inicio']) || empty($d['idauditoria']) || empty($d['termino']) || empty($d['setor']) || empty($d['auditor'])) {

        header("Location: ../../App/Views/auditoria/inicio.php?msg=1");
    }
    echo 'oi';
//    
    $a->setDataInicio($d['inicio']);
    $a->setDataFim($d['termino']);
    $a->setSetorId($d['setor']);
    $a->setAuditor(strtoupper($d['auditor']));
    $a->setSugestao(nl2br(strtoupper($d['sugestao'])));
    $a->setConclusao(nl2br(strtoupper($d['conclusao'])));
    $a->setId($d['idauditoria']);
    $a->setSituacao($d['situacao2']);
////
    $adao->EditarResultado($a);

    $id = $d['idauditoria'];
////
    echo '<pre>';
    echo var_dump($a);
    echo '</pre>';


//
    if (empty($d['inicio']) || empty($d['idauditoria']) || empty($d['termino']) || empty($d['setor']) || empty($d['auditor'])) {

        header("Location: ../../App/Views/auditoria/inicio.php?msg=1");
    }
    for ($i = 0; $i < count($d['situacao']); $i++) {

        $situacao = $d['situacao'];
        $evi = $d['evidencia'];
        $idquestao = $d['iditemquestao'];

        $aq->setAuditoriaId($d['idauditoria']);
        $aq->setEvidencias(nl2br(strtoupper($evi[$i])));
        $aq->setItemQuestionarioId($idquestao[$i]);
        $aq->setResposta($situacao[$i]);

        echo '<pre>';
        echo var_dump($aq);
        echo '</pre>';

        $aqdao->Editar($aq);
    }
    $h->setAuditoriaId($id);
    $h->setData($datatime);
    $h->setFuncionarioId($d['idfuncionario']);
    $h->setStatusId(10);

    echo '<pre>';
    echo var_dump($h);
    echo '</pre>';

    $hdao->Inserir($h);
    header("Location: ../../App/Views/auditoria/inicio.php");
}
//deletar
if ($deletar != null) {

//    echo $deletar;
    $aqdao->Deletar($deletar);
    $hdao->Deletar($deletar);
    $adao->Deletar($deletar);

    header("Location: ../../App/Views/auditoria/inicio.php");
}
