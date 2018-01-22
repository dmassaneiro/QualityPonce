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

$l = new LaudoInspecao();
$ldao = new LaudoInspecaoDAO();
$fdao = new FornecedorDAO();
$mdao = new MateriaPrimaDAO();
$hdao = new HistoricoLaudoInspecaoDAO();
$h = new HistoricoLaudo();

$dados = filter_input_array(INPUT_POST);
$data = date('Y-m-d H:i:s');
$deletar = filter_input(INPUT_GET, 'deletar');

if (isset($_POST['gravar'])) {


    if (empty($dados['data']) || empty($dados['numeroserie']) || empty($dados['datarecebimento']) || empty($dados['item']) || empty($dados['qtdlote']) || empty($dados['criterios']) || empty($dados['tipo1'])) {
        header("Location: ../../App/Views/inspecao/inicio.php?msg=1");
    }
    if (empty($dados['idfornecedor'])) {
        header("Location: ../../App/Views/inspecao/inicio.php?msg=3");
    }
//    echo $aa->getId();
    $aa = $mdao->VerificaFornecedor($dados['idfornecedor']);
    if ($aa->getId() == null) {
        header("Location: ../../App/Views/inspecao/inicio.php?msg=14");
    } else {

        $l->setDataInspecao($dados['data']);
        $l->setNumeroNota($dados['numeroserie']);
        $l->setNumeroLote($dados['numerolote']);
        $l->setDataRecebimento($dados['datarecebimento']);
        $l->setFornecedor($dados['idfornecedor']);
        $l->setMateriaPrimaId($dados['item']);
        $l->setQuantidadeLote($dados['qtdlote']);
        $l->setCriterios(nl2br(strtoupper($dados['criterios'])));
        $l->setTipoinspecao1($dados['tipo1']);
        $l->setTipoinspecao2($dados['tipo2'] . '' . $dados['tipo3']);
        $l->setQuantidadeConforme($dados['qtdconforme']);
        $l->setQuantidadeDefeito($dados['qtdnc']);
        $l->setStatusId($dados['status']);
        $l->setObservacao(nl2br(strtoupper($dados['obs'])));

        echo '<pre>';
        var_dump($l);
        echo '</pre>';

        $ldao->Inserir($l);

        $h->setData($data);
        $h->setFuncionarioId($dados['idfuncionario']);
        $h->setLaudoInspecaoId($dados['cod']);
        $h->setStatusId(7);

        echo '<pre>';
        var_dump($h);
        echo '</pre>';

        $hdao->Inserir($h);
        header("Location: ../../App/Views/inspecao/inicio.php");
    }
}
if (isset($_POST['editar'])) {


    if (empty($dados['data']) || empty($dados['numeroserie']) || empty($dados['datarecebimento']) || empty($dados['item']) || empty($dados['qtdlote']) || empty($dados['criterios']) || empty($dados['tipo1'])) {
        header("Location: ../../App/Views/inspecao/inicio.php?msg=1");
    }
    if (empty($dados['idfornecedor'])) {
        header("Location: ../../App/Views/inspecao/inicio.php?msg=3");
    }
    $aa = $mdao->VerificaFornecedor($dados['idfornecedor']);
    if ($aa->getId() == null) {
        header("Location: ../../App/Views/inspecao/inicio.php?msg=14");
    } else {
        $l->setDataInspecao($dados['data']);
        $l->setNumeroNota($dados['numeroserie']);
        $l->setNumeroLote($dados['numerolote']);
        $l->setDataRecebimento($dados['datarecebimento']);
        $l->setFornecedor($dados['idfornecedor']);
        $l->setMateriaPrimaId($dados['item']);
        $l->setQuantidadeLote($dados['qtdlote']);
        $l->setCriterios(nl2br(strtoupper($dados['criterios'])));
        $l->setTipoinspecao1($dados['tipo1']);
        $l->setTipoinspecao2($dados['tipo2'] . '' . $dados['tipo3']);
        $l->setQuantidadeConforme($dados['qtdconforme']);
        $l->setQuantidadeDefeito($dados['qtdnc']);
        $l->setStatusId($dados['status']);
        $l->setObservacao(nl2br(strtoupper($dados['obs'])));

        $l->setId($dados['id']);

        echo '<pre>';
        var_dump($l);
        echo '</pre>';

        $h->setData($data);
        $h->setFuncionarioId($dados['idfuncionario']);
        $h->setLaudoInspecaoId($dados['cod']);
        $h->setStatusId(6);
//
        $ldao->Editar($l);
        $hdao->Inserir($h);
        header("Location: ../../App/Views/inspecao/inicio.php");
    }
}
if ($deletar != null) {

    $hdao->Deletar($deletar);
    $ldao->Deletar($deletar);
    header("Location: ../../App/Views/inspecao/inicio.php");
}