<?php


class Usuario {
   
    private $id;
    private $login;
    private $senha;
    private $dataCadastro;
    private $permissaoGrupoId;
    private $funcionarioId;
    
    function getId() {
        return $this->id;
    }

    function getLogin() {
        return $this->login;
    }

    function getSenha() {
        return $this->senha;
    }

    function getDataCadastro() {
        return $this->dataCadastro;
    }

    function getPermissaoGrupoId() {
        return $this->permissaoGrupoId;
    }

    function getFuncionarioId() {
        return $this->funcionarioId;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setLogin($login) {
        $this->login = $login;
    }

    function setSenha($senha) {
        $this->senha = $senha;
    }

    function setDataCadastro($dataCadastro) {
        $this->dataCadastro = $dataCadastro;
    }

    function setPermissaoGrupoId($permissaoGrupoId) {
        $this->permissaoGrupoId = $permissaoGrupoId;
    }

    function setFuncionarioId($funcionarioId) {
        $this->funcionarioId = $funcionarioId;
    }


}
