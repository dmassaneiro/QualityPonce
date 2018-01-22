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

if ($deletar != null) {

    $mdao->Deletar($deletar);
    $rdao->Deletar($deletar);
    $cdao->Deletar($deletar);
    $tdao->Deletar($deletar);
    $idao->Deletar($deletar);
    $ldao->Deletar($deletar);
    $hdao->Deletar($deletar);
    $fdao->Deletar($deletar);

    echo 'deu bom';

    header("Location: ../../App/Views/fichatecnica/inicio.php");
}


if (isset($_POST['gravar'])) {

    if (empty($d['inicio']) || empty($d['fim']) || empty($d['nrordem']) || empty($d['nrserie']) || empty($d['produto'])) {
        header("Location: ../../App/Views/fichatecnica/inicio.php?msg=1");
    }

    if ($d['fim'] < $d['inicio']) {
        header("Location: ../../App/Views/fichatecnica/inicio.php?msg=9");
    }

    $pro = $pdao->VerificaSeProdutoExiste($d['produto']);
    if (empty($pro->getId())) {
        header("Location: ../../App/Views/fichatecnica/inicio.php?msg=10");
    }

    $f->setDataInicio($d['inicio']);
    $f->setDataFim($d['fim']);
    $f->setNumeroOrdem(strtoupper($d['nrordem']));
    $f->setNumeroSerie($d['nrserie']);
    $f->setProdutoId($d['produto']);
    $f->setStatusId(2);

    echo '<pre>';
    echo var_dump($f);
    echo '</pre>';

    $fdao->Inserir($f);

    $dados = $fdao->BuscarUltimoRegistro();
    $idd = $dados->getId();

    $h->setData($data);
    $h->setFuncionarioId($d['idfuncionario']);
    $h->setStatusId(7);
    $h->setFichaTecnicaId($idd);

    echo '<pre>';
    echo var_dump($h);
    echo '</pre>';

    $hdao->Inserir($h);
    header("Location: ../../App/Views/fichatecnica/montagem.php?id=$idd");
}
//if (isset($_POST['itemmontagem'])) {
//
//    if (empty($d['iditemmontagem']) || empty($d['data'])) {
//        header("Location: ../../App/Views/fichatecnica/inicio.php?msg=1");
//    }
//
//    $id = $d['idficha'];
//
//    $h->setData($data);
//    $h->setFuncionarioId($d['idfuncionario']);
//    $h->setStatusId(12);
//    $h->setFichaTecnicaId($id);
//
//    echo '<pre>';
//    echo var_dump($h);
//    echo '</pre>';
//
//    $hdao->Inserir($h);
//
//    for ($i = 0; $i < count($d['iditemmontagem']); $i++) {
//
//        $responsavel = $d['responsavel'];
//        $dat = $d['data'];
//        $idmontagem = $d['iditemmontagem'];
//
//        $m->setFichaTecnicaId($d['idficha']);
//        $m->setItemMontagemId($idmontagem[$i]);
//        $m->setData($dat[$i]);
//        $m->setResponsavel($responsavel[$i]);
//
//        echo '<pre>';
//        echo var_dump($m);
//        echo '</pre>';
//
//        $mdao->Inserir($m);
//    }
//
//
//    header("Location: ../../App/Views/fichatecnica/rigidezdieletrica.php?id=$id");
//}
//if (isset($_POST['regidez'])) {
//
//    if (empty($d['iditem'])) {
//        header("Location: ../../App/Views/fichatecnica/inicio.php?msg=1");
//    }
//
//    $id = $d['idficha'];
//
//    $h->setData($data);
//    $h->setFuncionarioId($d['idfuncionario']);
//    $h->setStatusId(13);
//    $h->setFichaTecnicaId($id);
//
//    echo '<pre>';
//    echo var_dump($h);
//    echo '</pre>';
//
//    $hdao->Inserir($h);
//
//    for ($i = 0; $i < count($d['iditem']); $i++) {
//
//        $responsavel = $d['responsavel'];
//        $dat = $d['data'];
//        $idmontagem = $d['iditem'];
//        $resultado = $d['resultado'];
//        $idmodo = $d['corrente'];
//
//        $r->setFichaTecnica_id($d['idficha']);
//        $r->setItemRigidezDieletricaId($idmontagem[$i]);
//        $r->setData($dat[$i]);
//        $r->setReponsavel($responsavel[$i]);
//        $r->setResultado($resultado[$i]);
//        $r->setCorrenteMa($idmodo[$i]);
//
//        echo '<pre>';
//        echo var_dump($r);
//        echo '</pre>';
//
//        $rdao->Inserir($r);
//    }
//
//    header("Location: ../../App/Views/fichatecnica/correntefuga.php?id=$id");
//}
//if (isset($_POST['corrente'])) {
//
//    $mododao = new ModoDAO();
//    $idproduto = $d['idproduto'];
//
//    if (empty($idproduto)) {
//        $id = $d['idficha'];
//        header("Location: ../../App/Views/fichatecnica/testefuncional.php?id=$id");
//    }
//    $id = $d['idficha'];
//    $h->setData($data);
//    $h->setFuncionarioId($d['idfuncionario']);
//    $h->setStatusId(14);
//    $h->setFichaTecnicaId($id);
//
//    echo '<pre>';
//    echo var_dump($h);
//    echo '</pre>';
//
//    $hdao->Inserir($h);
//
//    foreach ($mododao->BuscarTodosdoProduto($idproduto) as $modo) {
//
//        $c->setFichaTecnica_id($d['idficha']);
//        $cont = 0;
//        foreach ($d['idcorrente' . $modo->getId()] as $teste) {
//            $c->setItemCorrenteFugaId($teste);
//
////            var_dump($d['responsavel' . $modo->getId()][$cont]);
//            $c->setResponsavel($d['responsavel' . $modo->getId()][$cont]);
//            $c->setValorCc($d['valorcc' . $modo->getId()][$cont]);
//            $c->setValorCa($d['valorca' . $modo->getId()][$cont]);
//            $c->setData($d['data' . $modo->getId()][$cont]);
//
//            foreach ($d['idmodo' . $modo->getId()] as $idmodo) {
//                $c->setModoId($idmodo);
////                echo 'idcorrente ' . $idmodo . '<br>';
//            }
//            $cont++;
//
//            echo '<pre>';
//            echo var_dump($c);
//            echo '</pre>';
//
//            $cdao->Inserir($c);
//        }
//    }
//
//    header("Location: ../../App/Views/fichatecnica/testefuncional.php?id=$id");
//}
//if (isset($_POST['teste'])) {
//
//    if (empty($d['iditem'])) {
//        header("Location: ../../App/Views/fichatecnica/inicio.php?msg=1");
//    }
//
//    $id = $d['idficha'];
//    $h->setData($data);
//    $h->setFuncionarioId($d['idfuncionario']);
//    $h->setStatusId(15);
//    $h->setFichaTecnicaId($id);
//
//    echo '<pre>';
//    echo var_dump($h);
//    echo '</pre>';
//
//    $hdao->Inserir($h);
//
//    for ($i = 0; $i < count($d['iditem']); $i++) {
//
//        $responsavel = $d['responsavel'];
//        $dat = $d['data'];
//        $idteste = $d['iditem'];
//        $resultado = $d['resultado'];
//        $idobs = $d['observacao'];
//
//        $t->setFichaTecnica_id($d['idficha']);
//        $t->setItemTesteId($idteste[$i]);
//        $t->setData($dat[$i]);
//        $t->setResponsavel($responsavel[$i]);
//        $t->setResultado($resultado[$i]);
//        $t->setObservacao(strtoupper($idobs[$i]));
//
//        echo '<pre>';
//        echo var_dump($t);
//        echo '</pre>';
//
//        $tdao->Inserir($t);
//    }
//
//    header("Location: ../../App/Views/fichatecnica/instrumento.php?id=$id");
//}
//if (isset($_POST['instrumentos'])) {
//
//    $id = $d['idficha'];
//    $h->setData($data);
//    $h->setFuncionarioId($d['idfuncionario']);
//    $h->setStatusId(16);
//    $h->setFichaTecnicaId($id);
//
//    echo '<pre>';
//    echo var_dump($h);
//    echo '</pre>';
//
//    $hdao->Inserir($h);
//
//    foreach ($d['func'] as $func) {
//
//        $ins = new InstrumentoDAO();
//
//        $id_ins = $ins->BuscarPorNome($func);
//
//
//        $i->setFichaTecnicaId($d['idficha']);
//        $i->setInstrumentoId($id_ins->getId());
//
//        echo '<pre>';
//        echo var_dump($i);
//        echo '</pre>';
//
//        $idao->Inserir($i);
//    }
//
//
//    header("Location: ../../App/Views/fichatecnica/liberacao.php?id=$id");
//}
//if (isset($_POST['concluir'])) {
//
//    $h->setData($data);
//    $h->setFuncionarioId($d['idfuncionario']);
//    $h->setStatusId(1);
//    $h->setFichaTecnicaId($d['idficha']);
//
//    echo '<pre>';
//    echo var_dump($h);
//    echo '</pre>';
//
//    $hdao->Inserir($h);
//    for ($i = 0; $i < count($d['idliberacao']); $i++) {
//
//        $idliberacao = $d['idliberacao'];
//        $conferido = $d['conferido'];
//
//        $l->setFichaTecnica_id($d['idficha']);
//        $l->setItemLiberacaoId($idliberacao[$i]);
//        $l->setConferido($conferido[$i]);
//
//        echo '<pre>';
//        echo var_dump($l);
//        echo '</pre>';
//
//        $ldao->Inserir($l);
//    }
//
//    $f->setStatusId(1);
//    $f->setId($d['idficha']);
//
//    echo '<pre>';
//    echo var_dump($f);
//    echo '</pre>';
//
//    $fdao->EditarConcluir($f);
//
//
//    $id = $d['idficha'];
//    header("Location: ../../App/Views/fichatecnica/inicio.php");
//}
//////////////////////////EDITAR////////////////////////////////
$tes = 0;
if (isset($_POST['gravar-edit'])) {
    $tes++;
    if (empty($d['inicio']) || empty($d['fim']) || empty($d['nrordem']) || empty($d['nrserie']) || empty($d['produto'])) {
        header("Location: ../../App/Views/fichatecnica/inicio.php?msg=1");
    }
    if ($d['fim'] < $d['inicio']) {
        header("Location: ../../App/Views/fichatecnica/inicio.php?msg=9");
    }
    $pro = $pdao->VerificaSeProdutoExiste($d['produto']);
    if (empty($pro->getId())) {
        header("Location: ../../App/Views/fichatecnica/inicio.php?msg=10");
    }

    $idd = $d['idficha'];
//    if ($tes == '1') {

        $h->setData($data);
        $h->setFuncionarioId($d['idfuncionario']);
        $h->setStatusId(6);
        $h->setFichaTecnicaId($idd);

        echo '<pre>';
        echo var_dump($h);
        echo '</pre>';

        $hdao->Inserir($h);
//    }

    $f->setDataInicio($d['inicio']);
    $f->setDataFim($d['fim']);
    $f->setNumeroOrdem(strtoupper($d['nrordem']));
    $f->setNumeroSerie($d['nrserie']);
    $f->setProdutoId($d['produto']);
    $f->setStatusId(2);
    $f->setId($d['idficha']);

    echo '<pre>';
    echo var_dump($f);
    echo '</pre>';

    $fdao->Editar($f);
//
    $dados = $fdao->BuscarUltimoRegistro();
    //
    header("Location: ../../App/Views/fichatecnica/montagem-edit.php?id=$idd");
}
if (isset($_POST['itemmontagem-edit'])) {

    if (empty($d['iditemmontagem']) || empty($d['data'])) {
        header("Location: ../../App/Views/fichatecnica/inicio.php?msg=1");
    }
    $mdao->Deletar($d['idficha']);
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


    header("Location: ../../App/Views/fichatecnica/rigidezdieletrica-edit.php?id=$id");
}

if (isset($_POST['regidezz-edit'])) {

    if (empty($d['iditem'])) {
        header("Location: ../../App/Views/fichatecnica/inicio.php?msg=1");
    }
    $rdao->Deletar($d['idficha']);

    for ($i = 0; $i < count($d['iditem']); $i++) {
//
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
//
        echo '<pre>';
        echo var_dump($r);
        echo '</pre>';
//
//
        $rdao->Inserir($r);
    }
    $id = $d['idficha'];
    header("Location: ../../App/Views/fichatecnica/correntefuga-edit.php?id=$id");
}

if (isset($_POST['corrente-edit'])) {


    $mododao = new ModoDAO();
    $idproduto = $d['idproduto'];

    $cdao->Deletar($d['idficha']);
    if (empty($idproduto)) {
        $id = $d['idficha'];
        header("Location: ../../App/Views/fichatecnica/testefuncional-edit.php?id=$id");
    }

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
            $id = $d['idficha'];
            header("Location: ../../App/Views/fichatecnica/testefuncional-edit.php?id=$id");
        }
    }
}

if (isset($_POST['teste-edit'])) {

    if (empty($d['iditem'])) {
        header("Location: ../../App/Views/fichatecnica/inicio.php?msg=1");
    }
    $tdao->Deletar($d['idficha']);
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
    header("Location: ../../App/Views/fichatecnica/instrumento-edit.php?id=$id");
}

if (isset($_POST['instrumentos-edit'])) {

    $idao->Deletar($d['idficha']);
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
    header("Location: ../../App/Views/fichatecnica/liberacao-edit.php?id=$id");
}
if (isset($_POST['concluir-edit'])) {

    $ldao->Deletar($d['idficha']);
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
    $h->setData($data);
    $h->setFuncionarioId($d['idfuncionario']);
    $h->setStatusId(1);
    $h->setFichaTecnicaId($id);

    echo '<pre>';
    echo var_dump($h);
    echo '</pre>';

    $hdao->Inserir($h);

    header("Location: ../../App/Views/fichatecnica/inicio.php");
}
///////////SALVAR E SAIR /////////////////////////////////////////
//if (isset($_POST['itemmontagem-sair'])) {
//
//    if (empty($d['iditemmontagem']) || empty($d['data'])) {
//        header("Location: ../../App/Views/fichatecnica/inicio.php?msg=1");
//    }
//
//    for ($i = 0; $i < count($d['iditemmontagem']); $i++) {
//
//        $responsavel = $d['responsavel'];
//        $dat = $d['data'];
//        $idmontagem = $d['iditemmontagem'];
//
//        $m->setFichaTecnicaId($d['idficha']);
//        $m->setItemMontagemId($idmontagem[$i]);
//        $m->setData($dat[$i]);
//        $m->setResponsavel($responsavel[$i]);
//
//        echo '<pre>';
//        echo var_dump($m);
//        echo '</pre>';
//
//        $mdao->Inserir($m);
//    }
//    $id = $d['idficha'];
//
//    $h->setData($data);
//    $h->setFuncionarioId($d['idfuncionario']);
//    $h->setStatusId(12);
//    $h->setFichaTecnicaId($id);
//
//    echo '<pre>';
//    echo var_dump($h);
//    echo '</pre>';
//
//    $hdao->Inserir($h);
//
//    header("Location: ../../App/Views/fichatecnica/inicio.php");
//}
//if (isset($_POST['regidez-sair'])) {
//
//    if (empty($d['iditem'])) {
//        header("Location: ../../App/Views/fichatecnica/inicio.php?msg=1");
//    }
//
//    for ($i = 0; $i < count($d['iditem']); $i++) {
//
//        $responsavel = $d['responsavel'];
//        $dat = $d['data'];
//        $idmontagem = $d['iditem'];
//        $resultado = $d['resultado'];
//        $idmodo = $d['corrente'];
//
//        $r->setFichaTecnica_id($d['idficha']);
//        $r->setItemRigidezDieletricaId($idmontagem[$i]);
//        $r->setData($dat[$i]);
//        $r->setReponsavel($responsavel[$i]);
//        $r->setResultado($resultado[$i]);
//        $r->setCorrenteMa($idmodo[$i]);
//
//        echo '<pre>';
//        echo var_dump($r);
//        echo '</pre>';
//
//        $rdao->Inserir($r);
//    }
//    $id = $d['idficha'];
//
//
//    $h->setData($data);
//    $h->setFuncionarioId($d['idfuncionario']);
//    $h->setStatusId(13);
//    $h->setFichaTecnicaId($id);
//
//    echo '<pre>';
//    echo var_dump($h);
//    echo '</pre>';
//
//    $hdao->Inserir($h);
//
//    header("Location: ../../App/Views/fichatecnica/inicio.php");
//}
//if (isset($_POST['corrente-sair'])) {
//
//    $mododao = new ModoDAO();
//    $idproduto = $d['idproduto'];
//
////    foreach ($d['idmodo'] as $idmodo) {
//
//    foreach ($mododao->BuscarTodosdoProduto($idproduto) as $modo) {
//
//        $c->setFichaTecnica_id($d['idficha']);
//        $cont = 0;
//        foreach ($d['idcorrente' . $modo->getId()] as $teste) {
//            $c->setItemCorrenteFugaId($teste);
//
////            var_dump($d['responsavel' . $modo->getId()][$cont]);
//            $c->setResponsavel($d['responsavel' . $modo->getId()][$cont]);
//            $c->setValorCc($d['valorcc' . $modo->getId()][$cont]);
//            $c->setValorCa($d['valorca' . $modo->getId()][$cont]);
//            $c->setData($d['data' . $modo->getId()][$cont]);
//
//            foreach ($d['idmodo' . $modo->getId()] as $idmodo) {
//                $c->setModoId($idmodo);
////                echo 'idcorrente ' . $idmodo . '<br>';
//            }
//            $cont++;
//
//            echo '<pre>';
//            echo var_dump($c);
//            echo '</pre>';
//
//            $cdao->Inserir($c);
//        }
//    }
//    $id = $d['idficha'];
//
//    $h->setData($data);
//    $h->setFuncionarioId($d['idfuncionario']);
//    $h->setStatusId(14);
//    $h->setFichaTecnicaId($id);
//
//    echo '<pre>';
//    echo var_dump($h);
//    echo '</pre>';
//
//    $hdao->Inserir($h);
//
//    header("Location: ../../App/Views/fichatecnica/inicio.php");
//}
//if (isset($_POST['teste-sair'])) {
//
//    if (empty($d['iditem'])) {
//        header("Location: ../../App/Views/fichatecnica/inicio.php?msg=1");
//    }
//
//    for ($i = 0; $i < count($d['iditem']); $i++) {
//
//        $responsavel = $d['responsavel'];
//        $dat = $d['data'];
//        $idteste = $d['iditem'];
//        $resultado = $d['resultado'];
//        $idobs = $d['observacao'];
//
//        $t->setFichaTecnica_id($d['idficha']);
//        $t->setItemTesteId($idteste[$i]);
//        $t->setData($dat[$i]);
//        $t->setResponsavel($responsavel[$i]);
//        $t->setResultado($resultado[$i]);
//        $t->setObservacao(strtoupper($idobs[$i]));
//
//        echo '<pre>';
//        echo var_dump($t);
//        echo '</pre>';
//
//        $tdao->Inserir($t);
//    }
//    $id = $d['idficha'];
//
//    $h->setData($data);
//    $h->setFuncionarioId($d['idfuncionario']);
//    $h->setStatusId(15);
//    $h->setFichaTecnicaId($id);
//
//    echo '<pre>';
//    echo var_dump($h);
//    echo '</pre>';
//
//    $hdao->Inserir($h);
//
//    header("Location: ../../App/Views/fichatecnica/inicio.php");
//}
//if (isset($_POST['instrumentos-sair'])) {
//
//    foreach ($d['func'] as $func) {
//
//        $ins = new InstrumentoDAO();
//
//        $id_ins = $ins->BuscarPorNome($func);
//
//
//        $i->setFichaTecnicaId($d['idficha']);
//        $i->setInstrumentoId($id_ins->getId());
//
//        echo '<pre>';
//        echo var_dump($i);
//        echo '</pre>';
//
//        $idao->Inserir($i);
//    }
//
//    $id = $d['idficha'];
//
//
//    $h->setData($data);
//    $h->setFuncionarioId($d['idfuncionario']);
//    $h->setStatusId(16);
//    $h->setFichaTecnicaId($id);
//
//    echo '<pre>';
//    echo var_dump($h);
//    echo '</pre>';
//
//    $hdao->Inserir($h);
//
//    header("Location: ../../App/Views/fichatecnica/inicio.php");
//}
///////////////////////EDITARRR SALVAR E SAIR////////////////////////////////

if (isset($_POST['itemmontagem-edit-sair'])) {

    if (empty($d['iditemmontagem']) || empty($d['data'])) {
        header("Location: ../../App/Views/fichatecnica/inicio.php?msg=1");
    }
    $mdao->Deletar($d['idficha']);
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
    $h->setStatusId(19);
    $h->setFichaTecnicaId($id);

    echo '<pre>';
    echo var_dump($h);
    echo '</pre>';

    $hdao->Inserir($h);

    header("Location: ../../App/Views/fichatecnica/inicio.php");
}

if (isset($_POST['regidez-edit-sair'])) {

    if (empty($d['iditem'])) {
        header("Location: ../../App/Views/fichatecnica/inicio.php?msg=1");
    }
    $rdao->Deletar($d['idficha']);

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
    $h->setStatusId(18);
    $h->setFichaTecnicaId($id);

    echo '<pre>';
    echo var_dump($h);
    echo '</pre>';

    $hdao->Inserir($h);
    header("Location: ../../App/Views/fichatecnica/inicio.php");
}

if (isset($_POST['corrente-edit-sair'])) {


    $mododao = new ModoDAO();
    $idproduto = $d['idproduto'];

    $cdao->Deletar($d['idficha']);
    
    $id = $d['idficha'];
    $h->setData($data);
    $h->setFuncionarioId($d['idfuncionario']);
    $h->setStatusId(20);
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

if (isset($_POST['teste-edit-sair'])) {

    if (empty($d['iditem'])) {
        header("Location: ../../App/Views/fichatecnica/inicio.php?msg=1");
    }
    $tdao->Deletar($d['idficha']);
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
    $h->setStatusId(21);
    $h->setFichaTecnicaId($id);

    echo '<pre>';
    echo var_dump($h);
    echo '</pre>';

    $hdao->Inserir($h);
    header("Location: ../../App/Views/fichatecnica/inicio.php");
}

if (isset($_POST['instrumentos-edit-sair'])) {

    $idao->Deletar($d['idficha']);
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
    $h->setStatusId(22);
    $h->setFichaTecnicaId($id);

    echo '<pre>';
    echo var_dump($h);
    echo '</pre>';

    $hdao->Inserir($h);
    header("Location: ../../App/Views/fichatecnica/inicio.php");
}
