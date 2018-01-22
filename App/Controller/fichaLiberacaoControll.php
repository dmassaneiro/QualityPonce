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




if (isset($_POST['concluir'])) {

    $h->setData($data);
    $h->setFuncionarioId($d['idfuncionario']);
    $h->setStatusId(1);
    $h->setFichaTecnicaId($d['idficha']);

    echo '<pre>';
    echo var_dump($h);
    echo '</pre>';

    $hdao->Inserir($h);
    for ($i = 0; $i < count($d['idliberacao']); $i++) {

        $idliberacao = $d['idliberacao'];
        $conferido = $d['conferido'];

        $l->setFichaTecnica_id($d['idficha']);
        $l->setItemLiberacaoId($idliberacao[$i]);
        $l->setConferido($conferido[$i]);

        echo '<pre>';
        echo var_dump($l);
        echo '</pre>';

        $ldao->Inserir($l);
    }

    $f->setStatusId(1);
    $f->setId($d['idficha']);

    echo '<pre>';
    echo var_dump($f);
    echo '</pre>';

    $fdao->EditarConcluir($f);


    $id = $d['idficha'];
    header("Location: ../../App/Views/fichatecnica/inicio.php");
}

///////////SALVAR E SAIR /////////////////////////////////////////
