<?php
$campo = $_GET['campo'];
$valor = $_GET['valor'];

// Verificando o campo login
if ($campo == "login") {
	
	if ($valor == "") {
		echo "Preencha o campo com seu login";
	} 
}

// Verificando o campo email
if ($campo == "email") {
	
	if ($valor == "") {
		echo "Preencha o campo com seu email";
	} 
	
}

// Verificando o campo CPF
if ($campo == "cpf") {

	if ($valor == "") {
		echo "Preencha o campo com seu cpf";
	} 

}

// Acentua��o
header("Content-Type: text/html; charset=ISO-8859-1",true);
