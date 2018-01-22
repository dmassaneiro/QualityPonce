<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of LaudoInspecao
 *
 * @author diegu
 */
class LaudoInspecao {

    //put your code here
    private $id;
    private $dataInspecao;
    private $numeroNota;
    private $numeroLote;
    private $dataRecebimento;
    private $quantidadeLote;
    private $quantidadeConforme;
    private $quantidadeDefeito;
    private $observacao;
    private $statusId;
    private $fornecedor;
    private $materiaPrimaId;
    private $criterios;
    private $tipoinspecao1;
    private $tipoinspecao2;

    function getNumeroLote() {
        return $this->numeroLote;
    }

    function setNumeroLote($numeroLote) {
        $this->numeroLote = $numeroLote;
    }

    function getTipoinspecao1() {
        return $this->tipoinspecao1;
    }

    function getTipoinspecao2() {
        return $this->tipoinspecao2;
    }

    function setTipoinspecao1($tipoinspecao1) {
        $this->tipoinspecao1 = $tipoinspecao1;
    }

    function setTipoinspecao2($tipoinspecao2) {
        $this->tipoinspecao2 = $tipoinspecao2;
    }

    function getCriterios() {
        return $this->criterios;
    }

    function setCriterios($criterios) {
        $this->criterios = $criterios;
    }

    function getId() {
        return $this->id;
    }

    function getDataInspecao() {
        return $this->dataInspecao;
    }

    function getNumeroNota() {
        return $this->numeroNota;
    }

    function getDataRecebimento() {
        return $this->dataRecebimento;
    }

    function getQuantidadeLote() {
        return $this->quantidadeLote;
    }

    function getQuantidadeConforme() {
        return $this->quantidadeConforme;
    }

    function getQuantidadeDefeito() {
        return $this->quantidadeDefeito;
    }

    function getObservacao() {
        return $this->observacao;
    }

    function getStatusId() {
        return $this->statusId;
    }

    function getFornecedor() {
        return $this->fornecedor;
    }

    function getMateriaPrimaId() {
        return $this->materiaPrimaId;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setDataInspecao($dataInspecao) {
        $this->dataInspecao = $dataInspecao;
    }

    function setNumeroNota($numeroNota) {
        $this->numeroNota = $numeroNota;
    }

    function setDataRecebimento($dataRecebimento) {
        $this->dataRecebimento = $dataRecebimento;
    }

    function setQuantidadeLote($quantidadeLote) {
        $this->quantidadeLote = $quantidadeLote;
    }

    function setQuantidadeConforme($quantidadeConforme) {
        $this->quantidadeConforme = $quantidadeConforme;
    }

    function setQuantidadeDefeito($quantidadeDefeito) {
        $this->quantidadeDefeito = $quantidadeDefeito;
    }

    function setObservacao($observacao) {
        $this->observacao = $observacao;
    }

    function setStatusId($statusId) {
        $this->statusId = $statusId;
    }

    function setFornecedor($fornecedor) {
        $this->fornecedor = $fornecedor;
    }

    function setMateriaPrimaId($materiaPrimaId) {
        $this->materiaPrimaId = $materiaPrimaId;
    }

}
