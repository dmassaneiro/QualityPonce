<?php


class Permissao {
 
    private $id;
    private $permissaoAcessoId;
    private $permissaoGrupoId;
    
    function getId() {
        return $this->id;
    }

    function getPermissaoAcessoId() {
        return $this->permissaoAcessoId;
    }

    function getPermissaoGrupoId() {
        return $this->permissaoGrupoId;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setPermissaoAcessoId($permissaoAcessoId) {
        $this->permissaoAcessoId = $permissaoAcessoId;
    }

    function setPermissaoGrupoId($permissaoGrupoId) {
        $this->permissaoGrupoId = $permissaoGrupoId;
    }


}
