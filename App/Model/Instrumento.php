<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Instrumento
 *
 * @author diegu
 */
class Instrumento {

    //put your code here
    private $id;
    private $descricao;
    private $identificacao;
    private $dataValidade;
    private $situacao;
    
    function getSituacao() {
        return $this->situacao;
    }

    function setSituacao($situacao) {
        $this->situacao = $situacao;
    }

        
    function getId() {
        return $this->id;
    }

    function getDescricao() {
        return $this->descricao;
    }

    function getIdentificacao() {
        return $this->identificacao;
    }

    function getDataValidade() {
        return $this->dataValidade;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setDescricao($descricao) {
        $this->descricao = $descricao;
    }

    function setIdentificacao($identificacao) {
        $this->identificacao = $identificacao;
    }

    function setDataValidade($dataValidade) {
        $this->dataValidade = $dataValidade;
    }



}
