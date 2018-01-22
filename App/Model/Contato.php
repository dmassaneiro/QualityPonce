<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Contato
 *
 * @author diegu
 */
class Contato {
    //put your code here
    private $id;
    private $comercial;
    private $telefone;
    private $email;
    private $site;
    
    function getId() {
        return $this->id;
    }

    function getComercial() {
        return $this->comercial;
    }

    function getTelefone() {
        return $this->telefone;
    }

    function getEmail() {
        return $this->email;
    }

    function getSite() {
        return $this->site;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setComercial($comercial) {
        $this->comercial = $comercial;
    }

    function setTelefone($telefone) {
        $this->telefone = $telefone;
    }

    function setEmail($email) {
        $this->email = $email;
    }

    function setSite($site) {
        $this->site = $site;
    }


}
