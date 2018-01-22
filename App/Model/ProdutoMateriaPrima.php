<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ProdutoMateriaPrima
 *
 * @author diegu
 */
class ProdutoMateriaPrima {
    //put your code here
    private $ProdutoId;
    private $MateriaPrimaId;
    
    function getProdutoId() {
        return $this->ProdutoId;
    }

    function getMateriaPrimaId() {
        return $this->MateriaPrimaId;
    }

    function setProdutoId($ProdutoId) {
        $this->ProdutoId = $ProdutoId;
    }

    function setMateriaPrimaId($MateriaPrimaId) {
        $this->MateriaPrimaId = $MateriaPrimaId;
    }


}
