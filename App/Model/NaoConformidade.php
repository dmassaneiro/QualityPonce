<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of NaoConformidade
 *
 * @author diegu
 */
class NaoConformidade {
    //put your code here
    private $id;
    private $dataEmisao;
    private $descricao;
    private $justifiva;
    private $acaoExecutada;
    private $gravidade;
    private $notificado;
    private $acaoCorretiva;
    private $tipoNaoConformidadeId;
    private $setorId;
    private $statusId;
   
    function getId() {
        return $this->id;
    }

    function getDataEmisao() {
        return $this->dataEmisao;
    }

    function getDescricao() {
        return $this->descricao;
    }

    function getJustifiva() {
        return $this->justifiva;
    }

    function getAcaoExecutada() {
        return $this->acaoExecutada;
    }

    function getGravidade() {
        return $this->gravidade;
    }

    function getNotificado() {
        return $this->notificado;
    }

    function getAcaoCorretiva() {
        return $this->acaoCorretiva;
    }

    function getTipoNaoConformidadeId() {
        return $this->tipoNaoConformidadeId;
    }

    function getSetorId() {
        return $this->setorId;
    }

    function getStatusId() {
        return $this->statusId;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setDataEmisao($dataEmisao) {
        $this->dataEmisao = $dataEmisao;
    }

    function setDescricao($descricao) {
        $this->descricao = $descricao;
    }

    function setJustifiva($justifiva) {
        $this->justifiva = $justifiva;
    }

    function setAcaoExecutada($acaoExecutada) {
        $this->acaoExecutada = $acaoExecutada;
    }

    function setGravidade($gravidade) {
        $this->gravidade = $gravidade;
    }

    function setNotificado($notificado) {
        $this->notificado = $notificado;
    }

    function setAcaoCorretiva($acaoCorretiva) {
        $this->acaoCorretiva = $acaoCorretiva;
    }

    function setTipoNaoConformidadeId($tipoNaoConformidadeId) {
        $this->tipoNaoConformidadeId = $tipoNaoConformidadeId;
    }

    function setSetorId($setorId) {
        $this->setorId = $setorId;
    }

    function setStatusId($statusId) {
        $this->statusId = $statusId;
    }


}
