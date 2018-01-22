<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of FichaTecnica
 *
 * @author diegu
 */
class FichaTecnica {
    //put your code here
    private $id;
    private $numeroOrdem;
    private $numeroSerie;
    private $dataInicio;
    private $dataFim;
    private $statusId;
    private $produtoId;
    
    function getId() {
        return $this->id;
    }

    function getNumeroOrdem() {
        return $this->numeroOrdem;
    }

    function getNumeroSerie() {
        return $this->numeroSerie;
    }

    function getDataInicio() {
        return $this->dataInicio;
    }

    function getDataFim() {
        return $this->dataFim;
    }

    function getStatusId() {
        return $this->statusId;
    }

    function getProdutoId() {
        return $this->produtoId;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setNumeroOrdem($numeroOrdem) {
        $this->numeroOrdem = $numeroOrdem;
    }

    function setNumeroSerie($numeroSerie) {
        $this->numeroSerie = $numeroSerie;
    }

    function setDataInicio($dataInicio) {
        $this->dataInicio = $dataInicio;
    }

    function setDataFim($dataFim) {
        $this->dataFim = $dataFim;
    }

    function setStatusId($statusId) {
        $this->statusId = $statusId;
    }

    function setProdutoId($produtoId) {
        $this->produtoId = $produtoId;
    }


}
