<?php
  //envio o charset para evitar problemas com acentos
  header("Content-Type: text/html; charset=UTF-8");


  $mysqli = new mysqli('localhost', 'root', '', 'mydb');

  $user = filter_input(INPUT_GET, 'nomeUsuario');
  $sql = "SELECT * FROM `setor` WHERE `descricao` = '{$user}'"; //monto a query


  $query = $mysqli->query( $sql ); //executo a query

  if( $query->num_rows > 0 ) {//se retornar algum resultado
    echo 'Já existe!';
  } else {
    echo 'Não existe ainda!';
  }