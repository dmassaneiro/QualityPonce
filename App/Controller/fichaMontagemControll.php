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
date_default_timezone_set("America/Sao_Paulo");
$deletar = filter_input(INPUT_GET, 'deletar');

$data = date('Y-m-d H:i:s');

$f = new FichaTecnica();
$fdao = new FichaTecnicaDAO();
$pdao = new ProdutoDAO();

$mdao = new MontagemDAO();
$m = new Montagem();

$r = new EnsaioItemRigidezDieletrica();
$rdao = new RigidezDAO();

$c = new EnsaioCorrenteFuga();
$cdao = new CorrenteFugaDAO();

$t = new TesteItemTeste();
$tdao = new TesteDAO();

$idao = new FichaTecnicaInstrumentoDAO();
$i = new FichaTecnicaInstrumento();

$ldao = new LiberacaoDAO();
$l = new Liberacao();

$hdao = new HistoricoFichaTecnicaDAO();
$h = new HistoricoFichaTecnica();

$d = filter_input_array(INPUT_POST);

if (isset($_POST['itemmontagem'])) {

    if (empty($d['iditemmontagem']) || empty($d['data'])) {
        header("Location: ../../App/Views/fichatecnica/inicio.php?msg=1");
    }

    $id = $d['idficha'];

    $h->setData($data);
    $h->setFuncionarioId($d['idfuncionario']);
    $h->setStatusId(12);
    $h->setFichaTecnicaId($id);

    echo '<pre>';
    echo var_dump($h);
    echo '</pre>';

    $hdao->Inserir($h);

    for ($i = 0; $i < count($d['iditemmontagem']); $i++) {

        $responsavel = $d['responsavel'];
        $dat = $d['data'];
        $idmontagem = $d['iditemmontagem'];

        $m->setFichaTecnicaId($d['idficha']);
        $m->setItemMontagemId($idmontagem[$i]);
        $m->setData($dat[$i]);
        $m->setResponsavel($responsavel[$i]);

        echo '<pre>';
        echo var_dump($m);
        echo '</pre>';

        $mdao->Inserir($m);
    }


    header("Location: ../../App/Views/fichatecnica/rigidezdieletrica.php?id=$id");
}
///////////SALVAR E SAIR /////////////////////////////////////////
if (isset($_POST['itemmontagem-sair'])) {

    if (empty($d['iditemmontagem']) || empty($d['data'])) {
        header("Location: ../../App/Views/fichatecnica/inicio.php?msg=1");
    }

    for ($i = 0; $i < count($d['iditemmontagem']); $i++) {

        $responsavel = $d['responsavel'];
        $dat = $d['data'];
        $idmontagem = $d['iditemmontagem'];

        $m->setFichaTecnicaId($d['idficha']);
        $m->setItemMontagemId($idmontagem[$i]);
        $m->setData($dat[$i]);
        $m->setResponsavel($responsavel[$i]);

        echo '<pre>';
        echo var_dump($m);
        echo '</pre>';

        $mdao->Inserir($m);
    }
    $id = $d['idficha'];

    $h->setData($data);
    $h->setFuncionarioId($d['idfuncionario']);
    $h->setStatusId(12);
    $h->setFichaTecnicaId($id);

    echo '<pre>';
    echo var_dump($h);
    echo '</pre>';

    $hdao->Inserir($h);

    header("Location: ../../App/Views/fichatecnica/inicio.php");
}
