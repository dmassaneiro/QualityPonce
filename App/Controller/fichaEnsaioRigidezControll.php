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


if (isset($_POST['regidez'])) {

    if (empty($d['iditem'])) {
        header("Location: ../../App/Views/fichatecnica/inicio.php?msg=1");
    }

    $id = $d['idficha'];

    $h->setData($data);
    $h->setFuncionarioId($d['idfuncionario']);
    $h->setStatusId(13);
    $h->setFichaTecnicaId($id);

    echo '<pre>';
    echo var_dump($h);
    echo '</pre>';

    $hdao->Inserir($h);

    for ($i = 0; $i < count($d['iditem']); $i++) {

        $responsavel = $d['responsavel'];
        $dat = $d['data'];
        $idmontagem = $d['iditem'];
        $resultado = $d['resultado'];
        $idmodo = $d['corrente'];

        $r->setFichaTecnica_id($d['idficha']);
        $r->setItemRigidezDieletricaId($idmontagem[$i]);
        $r->setData($dat[$i]);
        $r->setReponsavel($responsavel[$i]);
        $r->setResultado($resultado[$i]);
        $r->setCorrenteMa($idmodo[$i]);

        echo '<pre>';
        echo var_dump($r);
        echo '</pre>';

        $rdao->Inserir($r);
    }

    header("Location: ../../App/Views/fichatecnica/correntefuga.php?id=$id");
}

///////////SALVAR E SAIR /////////////////////////////////////////
if (isset($_POST['regidez-sair'])) {

    if (empty($d['iditem'])) {
        header("Location: ../../App/Views/fichatecnica/inicio.php?msg=1");
    }

    for ($i = 0; $i < count($d['iditem']); $i++) {

        $responsavel = $d['responsavel'];
        $dat = $d['data'];
        $idmontagem = $d['iditem'];
        $resultado = $d['resultado'];
        $idmodo = $d['corrente'];

        $r->setFichaTecnica_id($d['idficha']);
        $r->setItemRigidezDieletricaId($idmontagem[$i]);
        $r->setData($dat[$i]);
        $r->setReponsavel($responsavel[$i]);
        $r->setResultado($resultado[$i]);
        $r->setCorrenteMa($idmodo[$i]);

        echo '<pre>';
        echo var_dump($r);
        echo '</pre>';

        $rdao->Inserir($r);
    }
    $id = $d['idficha'];


    $h->setData($data);
    $h->setFuncionarioId($d['idfuncionario']);
    $h->setStatusId(13);
    $h->setFichaTecnicaId($id);

    echo '<pre>';
    echo var_dump($h);
    echo '</pre>';

    $hdao->Inserir($h);

    header("Location: ../../App/Views/fichatecnica/inicio.php");
}
