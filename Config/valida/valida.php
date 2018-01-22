<?php
session_cache_expire(240);
$cache_expire = session_cache_expire();
session_start();
include './conexao.php';

$preco = filter_input(INPUT_POST,'login');
$senha = filter_input(INPUT_POST,'senha');



if ($preco && $senha != null) {
    $result = mysqli_query($conn, "SELECT * FROM `Usuario` WHERE login = '$preco' && senha = '$senha'");
    $row = mysqli_fetch_assoc($result);


    if ($row == null) {
        $_SESSION['loginErro'] = "Usuario e/ou Senha Invalidos3";
        header("Location: ../../App/Views/pri/login.php?msg=1");
    } elseif ($row != null) {
        session_start();
        $_SESSION['user_id'] = $row['id'];
        $_SESSION['funcionario_id'] = $row['funcionarioId'];
        $_SESSION['permissao_id'] = $row['permissaoGrupoId'];

        header("Location: ../../App/Views/pri/principal.php");
    }
} else {
    $_SESSION['loginErro'] = "Os campos Login e/ou Senha não podem ficar em branco";
    header("Location: ../../App/Views/pri/login.php?msg=1");
}

$action = $_GET['action'];
if ($action == 'logout') {
    session_start();
    $_SESSION['user_id'] = null;
    $_SESSION['user_nome'] = null;
    $_SESSION['user_acesso'] = null;
    $_SESSION['user_setor'] = null;
    header("Location: ../../App/Views/pri/login.php");
}
    