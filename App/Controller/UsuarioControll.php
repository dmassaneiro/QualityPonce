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

$d = filter_input_array(INPUT_POST);
$deletar = filter_input(INPUT_GET, 'deletar');

$u = new Usuario();
$udao = new UsuarioDAO();

if (isset($_POST['gravar'])) {

    $func = $d['func'];
    
    if (empty($d['func'] || empty($d['login']) || empty($d['senha']) || empty($d['permissao']))) {
        header('Location: ../../App/Views/cadastros/usuario.php?msg=1');
    }
    $valida = $udao->VerificaseExiste($func);
    if ($valida->getId() != null) {
        header('Location: ../../App/Views/cadastros/usuario.php?msg=13');
    }
    

    $u->setFuncionarioId(strtoupper($d['func']));
    $u->setPermissaoGrupoId($d['permissao']);
    $u->setLogin($d['login']);
    $u->setSenha($d['senha']);
    $u->setDataCadastro(date('Y-m-d'));

    echo '<pre>';
    echo var_dump($u);
    echo '</pre>';

    $udao->Inserir($u);
     header('Location: ../../App/Views/cadastros/usuario.php');
}
if (isset($_POST['editar'])) {

    $func = $d['func'];
    
    if (empty($d['func'] || empty($d['login']) || empty($d['senha']) || empty($d['permissao']))) {
        header('Location: ../../App/Views/cadastros/usuario.php?msg=1');
    }

    $u->setFuncionarioId(strtoupper($d['func']));
    $u->setPermissaoGrupoId($d['permissao']);
    $u->setLogin($d['login']);
    $u->setSenha($d['senha']);
    $u->setDataCadastro(date('Y-m-d'));
    $u->setId($d['iduser']);

    echo '<pre>';
    echo var_dump($u);
    echo '</pre>';

    $udao->Editar($u);
     header('Location: ../../App/Views/cadastros/usuario.php');
}
if ($deletar != null) {

        $udao->Deletar($deletar);
        header("Location: ../../App/Views/cadastros/usuario.php");
     
}



