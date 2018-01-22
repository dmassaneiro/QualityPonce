<?php
include_once '../../Config/ConexaoPDO.php';
include_once '../Model/Fornecedor.php';
include_once '../DAO/FornecedorDAO.php';

$s = new Fornecedor();
$sdao = new FornecedorDAO();

 $searchTerm = $_GET['term'];

foreach ($sdao->BuscarTodosDescricao($searchTerm) as $set){
    $cname = $set->getNome();
    $data[] = $cname;
	//echo "$cname\n";
}
echo json_encode($data);
