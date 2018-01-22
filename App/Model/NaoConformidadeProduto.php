<?php

class NaoConformidadeProduto {
    //put your code here
    private $id;
    private $controle;
    private $dataEmissao;
    private $descricao;
    private $acaoExecutada;
    private $destino;
    private $responsavel1;
    private $responsavel2;
    private $responsavel3;
    private $investigar;
    private $notificados;
    private $statusId;
    private $tipoNaoConformidadeProdutoId;
    
    function getControle() {
        return $this->controle;
    }

    function setControle($controle) {
        $this->controle = $controle;
    }

        
    function getId() {
        return $this->id;
    }

    function getDataEmissao() {
        return $this->dataEmissao;
    }

    function getDescricao() {
        return $this->descricao;
    }

    function getAcaoExecutada() {
        return $this->acaoExecutada;
    }

    function getDestino() {
        return $this->destino;
    }

    function getResponsavel1() {
        return $this->responsavel1;
    }

    function getResponsavel2() {
        return $this->responsavel2;
    }

    function getResponsavel3() {
        return $this->responsavel3;
    }

    function getInvestigar() {
        return $this->investigar;
    }

    function getNotificados() {
        return $this->notificados;
    }

    function getStatusId() {
        return $this->statusId;
    }

    function getTipoNaoConformidadeProdutoId() {
        return $this->tipoNaoConformidadeProdutoId;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setDataEmissao($dataEmissao) {
        $this->dataEmissao = $dataEmissao;
    }

    function setDescricao($descricao) {
        $this->descricao = $descricao;
    }

    function setAcaoExecutada($acaoExecutada) {
        $this->acaoExecutada = $acaoExecutada;
    }

    function setDestino($destino) {
        $this->destino = $destino;
    }

    function setResponsavel1($responsavel1) {
        $this->responsavel1 = $responsavel1;
    }

    function setResponsavel2($responsavel2) {
        $this->responsavel2 = $responsavel2;
    }

    function setResponsavel3($responsavel3) {
        $this->responsavel3 = $responsavel3;
    }

    function setInvestigar($investigar) {
        $this->investigar = $investigar;
    }

    function setNotificados($notificados) {
        $this->notificados = $notificados;
    }

    function setStatusId($statusId) {
        $this->statusId = $statusId;
    }

    function setTipoNaoConformidadeProdutoId($tipoNaoConformidadeProdutoId) {
        $this->tipoNaoConformidadeProdutoId = $tipoNaoConformidadeProdutoId;
    }


}
