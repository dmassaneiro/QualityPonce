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

if (isset($_POST['instrumentos'])) {

    $id = $d['idficha'];
    $h->setData($data);
    $h->setFuncionarioId($d['idfuncionario']);
    $h->setStatusId(16);
    $h->setFichaTecnicaId($id);

    echo '<pre>';
    echo var_dump($h);
    echo '</pre>';

    $hdao->Inserir($h);

    foreach ($d['func'] as $func) {

        $ins = new InstrumentoDAO();

        $id_ins = $ins->BuscarPorNome($func);


        $i->setFichaTecnicaId($d['idficha']);
        $i->setInstrumentoId($id_ins->getId());

        echo '<pre>';
        echo var_dump($i);
        echo '</pre>';

        $idao->Inserir($i);
    }


    header("Location: ../../App/Views/fichatecnica/liberacao.php?id=$id");
}
///////////SALVAR E SAIR /////////////////////////////////////////

if (isset($_POST['instrumentos-sair'])) {

    foreach ($d['func'] as $func) {

        $ins = new InstrumentoDAO();

        $id_ins = $ins->BuscarPorNome($func);


        $i->setFichaTecnicaId($d['idficha']);
        $i->setInstrumentoId($id_ins->getId());

        echo '<pre>';
        echo var_dump($i);
        echo '</pre>';

        $idao->Inserir($i);
    }

    $id = $d['idficha'];


    $h->setData($data);
    $h->setFuncionarioId($d['idfuncionario']);
    $h->setStatusId(16);
    $h->setFichaTecnicaId($id);

    echo '<pre>';
    echo var_dump($h);
    echo '</pre>';

    $hdao->Inserir($h);

    header("Location: ../../App/Views/fichatecnica/inicio.php");
}
