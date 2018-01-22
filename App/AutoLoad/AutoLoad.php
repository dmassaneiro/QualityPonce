<?php

function __autoload($classname) {
    if (file_exists($dao = "../../DAO/" . $classname . ".php")) {
        include_once($dao);
    }
    if (file_exists($model = "../../Model/" . $classname . ".php")) {
        include_once($model);
    }
    include_once '../../../Config/ConexaoPDO.php';
}
