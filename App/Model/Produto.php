<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Produto
 *
 * @author diegu
 */
class Produto {
    //put your code here
    
   private $id;
   private $nome;
   private $descricao;
   private $categoriaId;
   private $situacao;
   
   function getId() {
       return $this->id;
   }

   function getNome() {
       return $this->nome;
   }

   function getDescricao() {
       return $this->descricao;
   }

   function getCategoriaId() {
       return $this->categoriaId;
   }

   function getSituacao() {
       return $this->situacao;
   }

   function setId($id) {
       $this->id = $id;
   }

   function setNome($nome) {
       $this->nome = $nome;
   }

   function setDescricao($descricao) {
       $this->descricao = $descricao;
   }

   function setCategoriaId($categoriaId) {
       $this->categoriaId = $categoriaId;
   }

   function setSituacao($situacao) {
       $this->situacao = $situacao;
   }


}
