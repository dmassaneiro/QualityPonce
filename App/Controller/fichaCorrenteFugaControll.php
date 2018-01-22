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





if (isset($_POST['corrente'])) {

    $mododao = new ModoDAO();
    $idproduto = $d['idproduto'];

    if (empty($idproduto)) {
        $id = $d['idficha'];
        header("Location: ../../App/Views/fichatecnica/testefuncional.php?id=$id");
    }
    $id = $d['idficha'];
    $h->setData($data);
    $h->setFuncionarioId($d['idfuncionario']);
    $h->setStatusId(14);
    $h->setFichaTecnicaId($id);

    echo '<pre>';
    echo var_dump($h);
    echo '</pre>';

    $hdao->Inserir($h);

    foreach ($mododao->BuscarTodosdoProduto($idproduto) as $modo) {

        $c->setFichaTecnica_id($d['idficha']);
        $cont = 0;
        foreach ($d['idcorrente' . $modo->getId()] as $teste) {
            $c->setItemCorrenteFugaId($teste);

//            var_dump($d['responsavel' . $modo->getId()][$cont]);
            $c->setResponsavel($d['responsavel' . $modo->getId()][$cont]);
            $c->setValorCc($d['valorcc' . $modo->getId()][$cont]);
            $c->setValorCa($d['valorca' . $modo->getId()][$cont]);
            $c->setData($d['data' . $modo->getId()][$cont]);

            foreach ($d['idmodo' . $modo->getId()] as $idmodo) {
                $c->setModoId($idmodo);
//                echo 'idcorrente ' . $idmodo . '<br>';
            }
            $cont++;

            echo '<pre>';
            echo var_dump($c);
            echo '</pre>';

            $cdao->Inserir($c);
        }
        header("Location: ../../App/Views/fichatecnica/testefuncional.php?id=$id");
    }
}

///////////SALVAR E SAIR /////////////////////////////////////////

if (isset($_POST['corrente-sair'])) {

    $mododao = new ModoDAO();
    $idproduto = $d['idproduto'];

    $id = $d['idficha'];

    $h->setData($data);
    $h->setFuncionarioId($d['idfuncionario']);
    $h->setStatusId(14);
    $h->setFichaTecnicaId($id);

    echo '<pre>';
    echo var_dump($h);
    echo '</pre>';

    $hdao->Inserir($h);

    foreach ($mododao->BuscarTodosdoProduto($idproduto) as $modo) {

        $c->setFichaTecnica_id($d['idficha']);
        $cont = 0;
        foreach ($d['idcorrente' . $modo->getId()] as $teste) {
            $c->setItemCorrenteFugaId($teste);

//            var_dump($d['responsavel' . $modo->getId()][$cont]);
            $c->setResponsavel($d['responsavel' . $modo->getId()][$cont]);
            $c->setValorCc($d['valorcc' . $modo->getId()][$cont]);
            $c->setValorCa($d['valorca' . $modo->getId()][$cont]);
            $c->setData($d['data' . $modo->getId()][$cont]);

            foreach ($d['idmodo' . $modo->getId()] as $idmodo) {
                $c->setModoId($idmodo);
//                echo 'idcorrente ' . $idmodo . '<br>';
            }
            $cont++;

            echo '<pre>';
            echo var_dump($c);
            echo '</pre>';

            $cdao->Inserir($c);
        }
    header("Location: ../../App/Views/fichatecnica/inicio.php");
    }


}
