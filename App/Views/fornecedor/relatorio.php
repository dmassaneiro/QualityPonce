<?php

header('Content-type: text/html; charset=utf-8');
setlocale(LC_ALL, 'pt_BR.utf-8', 'pt_BR', 'Portuguese_Brazil');
include_once '../../AutoLoad/AutoLoad.php';

session_start();
$id_user = $_SESSION['user_id'];
$id_funcionario = $_SESSION['funcionario_id'];
$id_permissao = $_SESSION['permissao_id'];

if ($id_permissao == 1 || $id_permissao == 6 || $id_permissao == 4 || $id_permissao == 5 || $id_permissao == 2 || $id_permissao == 8 || $id_permissao == 7) {
    
} else {
    header('Location: ../pri/principal.php?msg=12');
}

$id = filter_input(INPUT_GET, 'id');

$adao = new AvaliacaoDAO();
$cdao = new CriterioFornecedorDAO();
$acdao = new AvaliacaoCriterioDAO();
$fdao = new FornecedorDAO();


$dados = $adao->BuscarRegistroParaEditar($id);

$forn = $fdao->BuscarNome($dados->getFornecedorId());



require('../fpdf/fpdf.php');
$data = date('d/m/Y');
$hora = date('H:i:s');


$pdf = new FPDF();
$pdf->AddPage();
$pdf->Image('../../../img/logo1.png', 4, 6, 40);
$pdf->SetFont('Arial', 'B', 15);
$pdf->Cell(80);
$pdf->Cell(30, 10, utf8_decode('RELATÓRIO '), 0, 0, 'C');
$pdf->Cell(-30, 20, utf8_decode('AVALIAÇÃO DE FORNECEDOR'), 0, 0, 'C');
$pdf->Cell(40);
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(110, 10, 'Data :' . $data, 0, 0, 'C');
$pdf->Cell(-114, 20, 'Hora :' . $hora, 0, 0, 'C');
$pdf->Ln(15);

$pdf->Cell(190, 10, utf8_decode('________________________________________________________________________________________________'), 0, 0, 'C');
$pdf->Ln(10);

$pdf->SetFont('Arial', 'B', 9);
$pdf->Cell(0, 10, 'Fornecedor ', 0, 1);
$pdf->Ln(-5);
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(0, 10, utf8_decode($forn->getNome()), 0, 1, 'L');
$pdf->Ln(0);

$pdf->SetFont('Arial', 'B', 9);
$pdf->Cell(0, 2, 'CNPJ ', 0, 1);
$pdf->Ln(4);
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(0, -2, utf8_decode($forn->getCnpj()), 0, 1, 'L');
$pdf->Ln(10);

$pdf->SetFont('Arial', 'B', 9);
$pdf->Cell(0, -5, utf8_decode('Produtos/Serviços '), 0, 1);
$pdf->SetFont('Arial', '', 10);
$pdf->Ln(4);
$pdf->Cell(0, 7, utf8_decode($dados->getProdutosServicos()), 0, 1, 'L');
$pdf->Ln(10);

$pdf->SetFont('Arial', 'B', 9);
$pdf->Cell(0, -12, utf8_decode('Data Cadastro : '), 0, 1);
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(72, 12, date("d/m/Y", strtotime($dados->getData())), 0, 1, 'C');
$pdf->Ln(5);

$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(0, 10, utf8_decode('CRITÉRIOS E NOTAS'), 0, 1);

$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(135, 8, utf8_decode('CRITÉRIO'), 1, 0, 'C');
$pdf->Cell(27, 8, 'NOTA PESO', 1, 0, 'C');
$pdf->Cell(27, 8, 'NOTA OBTIDA', 1, 1, 'C');

foreach ($acdao->BuscarTodosID($dados->getId()) as $a) {
    $nm_cri = $cdao->BuscarTodosEdit($a->getCriterioFornecedorId());
    $pdf->SetFont('Arial', '', 8);
    $pdf->Cell(135, 8, utf8_decode($nm_cri->getDescricao()), 1, 0, 'l');
    $pdf->SetFont('Arial', '', 10);
    $pdf->Cell(27, 8, $nm_cri->getNotaPeso(), 1, 0, 'C');
    $pdf->Cell(27, 8, round($a->getPontuacao()), 1, 1, 'C');
}
$pdf->Ln(5);
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(135, 8, '', 0, 0, 'C');
$pdf->Cell(27, 8, utf8_decode('PONTUAÇÃO'), 1, 0, 'C');
$pdf->Cell(27, 8, round($dados->getMedia()), 1, 1, 'C');

$pdf->Ln(5);
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(189, 8, utf8_decode('OBSERVAÇÃO'), 0, 0, 'l');
$pdf->Ln(8);
$pdf->SetFont('Arial', '', 10);
$pdf->MultiCell(189, 5, strtoupper(utf8_decode(strip_tags($dados->getObservacao()))));





$pdf->Output();
