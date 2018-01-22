<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ItemQuestionario
 *
 * @author diegu
 */
class ItemQuestionario {
    //put your code here
    private $id;
    private $descricao;
    private $tipoAuditoriaId;
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

    function getTipoAuditoriaId() {
        return $this->tipoAuditoriaId;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setDescricao($descricao) {
        $this->descricao = $descricao;
    }

    function setTipoAuditoriaId($tipoAuditoriaId) {
        $this->tipoAuditoriaId = $tipoAuditoriaId;
    }


}
