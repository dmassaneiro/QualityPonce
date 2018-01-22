<?php
include_once '../../Config/ConexaoPDO.php';
include_once '../../App/DAO/FornecedorDAO.php';
include_once '../../App/Model/Fornecedor.php';

function retorna($matricula) {
    $fdao = new FornecedorDAO();
    $result_aluno = $fdao->BuscarCnpj($matricula);
    if ($result_aluno->getNome() == null) {
        $valores['nome_aluno'] = 'FORNECEDOR NÃO ENCONTRADO';
    } else {

        $valores['nome_aluno'] = $result_aluno->getNome();
        $valores['rg'] = $result_aluno->getId();
    }
    return json_encode($valores);
}

if (isset($_GET['matricula'])) {
    echo retorna($_GET['matricula']);
}
?>