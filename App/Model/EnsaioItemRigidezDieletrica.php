<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of EnsaioItemRigidezDieletrica
 *
 * @author diegu
 */
class EnsaioItemRigidezDieletrica {
    //put your code here
    private $itemRigidezDieletricaId;
    private $fichaTecnica_id;
    private $data;
    private $resultado;
    private $correnteMa;
    private $reponsavel;
    
    
    function getItemRigidezDieletricaId() {
        return $this->itemRigidezDieletricaId;
    }

    function getFichaTecnica_id() {
        return $this->fichaTecnica_id;
    }

    function getData() {
        return $this->data;
    }

    function getResultado() {
        return $this->resultado;
    }

    function getCorrenteMa() {
        return $this->correnteMa;
    }

    function getReponsavel() {
        return $this->reponsavel;
    }

    function setItemRigidezDieletricaId($itemRigidezDieletricaId) {
        $this->itemRigidezDieletricaId = $itemRigidezDieletricaId;
    }

    function setFichaTecnica_id($fichaTecnica_id) {
        $this->fichaTecnica_id = $fichaTecnica_id;
    }

    function setData($data) {
        $this->data = $data;
    }

    function setResultado($resultado) {
        $this->resultado = $resultado;
    }

    function setCorrenteMa($correnteMa) {
        $this->correnteMa = $correnteMa;
    }

    function setReponsavel($reponsavel) {
        $this->reponsavel = $reponsavel;
    }



}
