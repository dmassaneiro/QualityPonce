<?php

include_once '../../Config/ConexaoPDO.php';
include_once '../DAO/FuncionarioDAO.php';
include_once '../Model/Funcionario.php';
include_once '../DAO/SetorDAO.php';
include_once '../Model/Setor.php';


$fdao = new FuncionarioDAO();
$sdao = new SetorDAO();
$f = new Funcionario();

$dados = filter_input_array(INPUT_POST);
$data = date('Y-m-d');
$deletar = filter_input(INPUT_GET, 'deletar');

if (isset($_POST['gravar'])) {
    if (empty($dados['nome']) || empty($dados['sobrenome']) || empty($dados['setor']) || empty($dados['sexo']) || empty($dados['situacao'])) {

        header("Location: ../../App/Views/cadastros/funcionario.php?msg=1");
    }
    $setor = $sdao->BuscarNomeSetor($dados['setor']);
    if ($setor->getDescricao() == null) {
        header("Location: ../../App/Views/cadastros/funcionario.php?msg=5");
    }
    if ($dados['situacao'] !== "A" && $dados['situacao'] !== "I") {
        header("Location: ../../App/Views/cadastros/funcionario.php?msg=5");
    }

    $f->setNome(strtoupper($dados['nome']));
    $f->setSobrenome(strtoupper($dados['sobrenome']));
    $f->setSetorId($dados['setor']);
    $f->setSexo($dados['sexo']);
    $f->setSituacao($dados['situacao']);
    $f->setDataCadastro($data);

    echo '<pre>';
    echo var_dump($f);
    echo '</pre>';
    $fdao->Inserir($f);
    header("Location: ../../App/Views/cadastros/funcionario.php");
}
if (isset($_POST['editar'])) {
    if (empty($dados['nome']) || empty($dados['sobrenome']) || empty($dados['setor']) || empty($dados['sexo']) || empty($dados['situacao'])) {

        header("Location: ../../App/Views/cadastros/funcionario.php?msg=1");
    }
    $setor = $sdao->BuscarNomeSetor($dados['setor']);
    if ($setor->getDescricao() == null) {
        header("Location: ../../App/Views/cadastros/funcionario.php?msg=5");
    }
    if ($dados['situacao'] !== "A" && $dados['situacao'] !== "I") {
        header("Location: ../../App/Views/cadastros/funcionario.php?msg=5");
    }

    $f->setNome(strtoupper($dados['nome']));
    $f->setSobrenome(strtoupper($dados['sobrenome']));
    $f->setSetorId($dados['setor']);
    $f->setSexo($dados['sexo']);
    $f->setSituacao($dados['situacao']);
    $f->setDataCadastro($data);

    $f->setId($dados['cod']);

    echo '<pre>';
    echo var_dump($f);
    echo '</pre>';
    $fdao->Editar($f);
    header("Location: ../../App/Views/cadastros/funcionario.php");
}
if ($deletar != null) {
     $teste1 = $fdao->VerificaParaDeletar1($deletar);
     $teste2 = $fdao->VerificaParaDeletar2($deletar);
    if ($teste1->getId() == '0' && $teste2->getId() == '0') {
        $fdao->Deletar($deletar);
        header("Location: ../../App/Views/cadastros/funcionario.php");
        echo 'deu Bom';
    } else {
        echo 'deu ruim';
        header("Location: ../../App/Views/cadastros/funcionario.php?msg=2");
    }
    
    
    
//    header("Location: ../../App/Views/cadastros/funcionario.php");
}


