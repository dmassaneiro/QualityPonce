<?php
session_cache_expire(240);
$cache_expire = session_cache_expire();

session_start();

if (!isset($_SESSION['funcionario_id'])) {

    header("Location: ../pri/login.php");
    exit;
}
