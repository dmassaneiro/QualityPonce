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

$d = filter_input_array(INPUT_POST);

$c = new CriterioFornecedor();
$cdao = new CriterioFornecedorDAO();
$a = new AvaliacaoFornecedor();
$adao = new AvaliacaoDAO();
$ac = new AvaliacaoCriterio();
$acdao = new AvaliacaoCriterioDAO();
$fdao = new FornecedorDAO();

if (isset($_POST['gravar'])) {

    if (empty($d['nota']) || empty($d['idcriterio']) || empty($d['produto']) || empty($d['media']) || empty($d['idfornecedor'])) {
        header("Location: ../../App/Views/fornecedor/inicio.php?msg=1");
    }
    $forn = $fdao->BuscarNome($d['idfornecedor']);
    if (empty($forn->getNome())) {
        header("Location: ../../App/Views/fornecedor/inicio.php?msg=3");
    } else {

        $a->setData($d['data']);
        $a->setFornecedorId($d['idfornecedor']);
        $a->setMedia($d['media']);
        $a->setObservacao(nl2br(strtoupper($d['obs'])));
        $a->setProdutosServicos(strtoupper($d['produto']));
        $a->setStatusId($d['situacao']);

        echo '<pre>';
        echo var_dump($a);
        echo '</pre>';

        $adao->Inserir($a);
        $id = $adao->BuscarUltimoRegistro();

        for ($i = 0; $i < count($d['nota']); $i++) {

            $nota = $d['nota'];
            $crit = $d['idcriterio'];

            $ac->setPontuacao($nota[$i]);
            $ac->setCriterioFornecedorId($crit[$i]);
            $ac->setAvaliacaoFornecedorId($id->getId());

            echo '<pre>';
            echo var_dump($ac);
            echo '</pre>';

            $acdao->Inserir($ac);
        }
        header("Location: ../../App/Views/fornecedor/inicio.php");
    }
}
if (isset($_POST['editar'])) {

    if (empty($d['nota']) || empty($d['idcriterio']) || empty($d['produto']) || empty($d['media']) || empty($d['idfornecedor'])) {
        header("Location: ../../App/Views/fornecedor/inicio.php?msg=1");
    }
    $forn = $fdao->BuscarNome($d['idfornecedor']);
    if (empty($forn->getNome())) {
        header("Location: ../../App/Views/fornecedor/inicio.php?msg=1");
    } else {

        $a->setData($d['data']);
        $a->setFornecedorId($d['idfornecedor']);
        $a->setMedia($d['media']);
        $a->setObservacao(nl2br(strtoupper($d['obs'])));
        $a->setProdutosServicos(strtoupper($d['produto']));
        $a->setStatusId($d['situacao']);
        $a->setId($d['idavaliacao']);

        echo '<pre>';
        echo var_dump($a);
        echo '</pre>';

        $adao->Editar($a);

        $acdao->Deletar($d['idavaliacao']);

        for ($i = 0; $i < count($d['nota']); $i++) {

            $nota = $d['nota'];
            $crit = $d['idcriterio'];

            $ac->setPontuacao($nota[$i]);
            $ac->setCriterioFornecedorId($crit[$i]);
            $ac->setAvaliacaoFornecedorId($d['idavaliacao']);

            echo '<pre>';
            echo var_dump($ac);
            echo '</pre>';

            $acdao->Inserir($ac);
        }
        header("Location: ../../App/Views/fornecedor/inicio.php");
    }
}
if ($deletar != null) {

    $acdao->Deletar($deletar);
    $adao->Deletar($deletar);
    header("Location: ../../App/Views/fornecedor/inicio.php");
}