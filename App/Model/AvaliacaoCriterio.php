<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of AvaliacaoCriterio
 *
 * @author diegu
 */
class AvaliacaoCriterio {
    //put your code here
    private $avaliacaoFornecedorId;
    private $criterioFornecedorId;
    private $pontuacao;
    
    function getAvaliacaoFornecedorId() {
        return $this->avaliacaoFornecedorId;
    }

    function getCriterioFornecedorId() {
        return $this->criterioFornecedorId;
    }

    function getPontuacao() {
        return $this->pontuacao;
    }

    function setAvaliacaoFornecedorId($avaliacaoFornecedorId) {
        $this->avaliacaoFornecedorId = $avaliacaoFornecedorId;
    }

    function setCriterioFornecedorId($criterioFornecedorId) {
        $this->criterioFornecedorId = $criterioFornecedorId;
    }

    function setPontuacao($pontuacao) {
        $this->pontuacao = $pontuacao;
    }


}
