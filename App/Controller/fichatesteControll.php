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

date_default_timezone_set("America/Sao_Paulo");
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




if (isset($_POST['teste'])) {

    if (empty($d['iditem'])) {
        header("Location: ../../App/Views/fichatecnica/inicio.php?msg=1");
    }

    $id = $d['idficha'];
    $h->setData($data);
    $h->setFuncionarioId($d['idfuncionario']);
    $h->setStatusId(15);
    $h->setFichaTecnicaId($id);

    echo '<pre>';
    echo var_dump($h);
    echo '</pre>';

    $hdao->Inserir($h);

    for ($i = 0; $i < count($d['iditem']); $i++) {

        $responsavel = $d['responsavel'];
        $dat = $d['data'];
        $idteste = $d['iditem'];
        $resultado = $d['resultado'];
        $idobs = $d['observacao'];

        $t->setFichaTecnica_id($d['idficha']);
        $t->setItemTesteId($idteste[$i]);
        $t->setData($dat[$i]);
        $t->setResponsavel($responsavel[$i]);
        $t->setResultado($resultado[$i]);
        $t->setObservacao(strtoupper($idobs[$i]));

        echo '<pre>';
        echo var_dump($t);
        echo '</pre>';

        $tdao->Inserir($t);
    }

    header("Location: ../../App/Views/fichatecnica/instrumento.php?id=$id");
}

///////////SALVAR E SAIR /////////////////////////////////////////

if (isset($_POST['teste-sair'])) {

    if (empty($d['iditem'])) {
        header("Location: ../../App/Views/fichatecnica/inicio.php?msg=1");
    }

    for ($i = 0; $i < count($d['iditem']); $i++) {

        $responsavel = $d['responsavel'];
        $dat = $d['data'];
        $idteste = $d['iditem'];
        $resultado = $d['resultado'];
        $idobs = $d['observacao'];

        $t->setFichaTecnica_id($d['idficha']);
        $t->setItemTesteId($idteste[$i]);
        $t->setData($dat[$i]);
        $t->setResponsavel($responsavel[$i]);
        $t->setResultado($resultado[$i]);
        $t->setObservacao(strtoupper($idobs[$i]));

        echo '<pre>';
        echo var_dump($t);
        echo '</pre>';

        $tdao->Inserir($t);
    }
    $id = $d['idficha'];

    $h->setData($data);
    $h->setFuncionarioId($d['idfuncionario']);
    $h->setStatusId(15);
    $h->setFichaTecnicaId($id);

    echo '<pre>';
    echo var_dump($h);
    echo '</pre>';

    $hdao->Inserir($h);

    header("Location: ../../App/Views/fichatecnica/inicio.php");
}
