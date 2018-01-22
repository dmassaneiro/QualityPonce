<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of MontegemItem
 *
 * @author diegu
 */
class MontegemItem {
    //put your code here
    private $montagemId;
    private $itemMontagemId;
    private $data;
    private $reponsavel;
    
    function getMontagemId() {
        return $this->montagemId;
    }

    function getItemMontagemId() {
        return $this->itemMontagemId;
    }

    function getData() {
        return $this->data;
    }

    function getReponsavel() {
        return $this->reponsavel;
    }

    function setMontagemId($montagemId) {
        $this->montagemId = $montagemId;
    }

    function setItemMontagemId($itemMontagemId) {
        $this->itemMontagemId = $itemMontagemId;
    }

    function setData($data) {
        $this->data = $data;
    }

    function setReponsavel($reponsavel) {
        $this->reponsavel = $reponsavel;
    }


}
