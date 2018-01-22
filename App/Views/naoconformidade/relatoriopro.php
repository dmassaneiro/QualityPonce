<?php
session_start();
$id_user = $_SESSION['user_id'];
$id_funcionario = $_SESSION['funcionario_id'];
$id_permissao = $_SESSION['permissao_id'];


include_once '../../AutoLoad/AutoLoad.php';

$ncdao = new NcProdutoDAO();
$setordao = new SetorDAO();
$tipodencdao = new TipoNaoConformidadeProdutoDAO();

$id_nc_processo = filter_input(INPUT_GET, 'id');

$dados = $ncdao->BuscarRegistroParaEditar($id_nc_processo);
//$nome_setor = $setordao->BuscarNomeSetor($dados->getSetorId());
$nome_tipo_nc = $tipodencdao->BuscarNomeNC($dados->getTipoNaoConformidadeProdutoId());

require('../fpdf/fpdf.php');
$data = date('d/m/Y');
$hora = date('H:i:s');


$pdf = new FPDF();
$pdf->AddPage();
$pdf->Image('../../../img/logo1.png', 4, 6, 40);
$pdf->SetFont('Arial', 'B', 15);
$pdf->Cell(80);
$pdf->Cell(30, 10, utf8_decode('RELATÓRIO '), 0, 0, 'C');
$pdf->Cell(-30, 20, utf8_decode('NÃO CONFORMIDADE '), 0, 0, 'C');
$pdf->Cell(40);
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(110, 10, 'Data :' . $data, 0, 0, 'C');
$pdf->Cell(-114, 20, 'Hora :' . $hora, 0, 0, 'C');
$pdf->Ln(15);

$pdf->Cell(190, 10, utf8_decode('________________________________________________________________________________________________'), 0, 0, 'C');
$pdf->Ln(10);

$pdf->SetFont('Arial', 'B', 9);
$pdf->Cell(0, 10, 'Data ', 0, 1);
$pdf->Ln(-5);
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(0, 10, date("d/m/Y", strtotime($dados->getDataEmissao())), 0, 1, 'L');
$pdf->Ln(0);

$pdf->SetFont('Arial', 'B', 9);
$pdf->Cell(0, 2, utf8_decode('Tipo Não Conformidade'), 0, 1);
$pdf->Ln(4);
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(0, -2, utf8_decode($nome_tipo_nc->getDescricao()), 0, 1, 'L');
$pdf->Ln(10);

$pdf->SetFont('Arial', 'B', 9);
$pdf->Cell(0, -5, utf8_decode('N° Controle Interno'), 0, 1);
$pdf->SetFont('Arial', '', 10);
$pdf->Ln(4);
$pdf->Cell(0, 7, utf8_decode($dados->getControle()), 0, 1, 'L');

$pdf->Ln(-3);
$pdf->Cell(190, 10, utf8_decode('________________________________________________________________________________________________'), 0, 0, 'C');
$pdf->Ln(5);

$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(189, 8, utf8_decode('Descrição da Não Conformidade'), 0, 0, 'l');
$pdf->Ln(8);
$pdf->SetFont('Arial', '', 10);
$pdf->MultiCell(189, 5, strtoupper(utf8_decode(strip_tags($dados->getDescricao()))));

$pdf->Ln(5);
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(189, 8, utf8_decode('Ação Executada'), 0, 0, 'l');
$pdf->Ln(8);
$pdf->SetFont('Arial', '', 10);
$pdf->MultiCell(189, 5, strtoupper(utf8_decode(strip_tags($dados->getAcaoExecutada()))));

$pdf->Ln(5);

$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(189, 8, utf8_decode('Responsável'), 0, 0, 'l');
$pdf->Ln(8);
$pdf->SetFont('Arial', '', 10);
$pdf->MultiCell(189, 5, strtoupper(utf8_decode(strip_tags($dados->getResponsavel1()))));

$pdf->Cell(190, 10, utf8_decode('________________________________________________________________________________________________'), 0, 0, 'C');
$pdf->Ln(5);

$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(189, 8, utf8_decode('Destinação'), 0, 0, 'l');
$pdf->Ln(8);
$pdf->SetFont('Arial', '', 10);
$pdf->MultiCell(189, 5, strtoupper(utf8_decode(strip_tags($dados->getDestino()))));
$pdf->Ln(5);


$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(189, 8, utf8_decode('Responsável'), 0, 0, 'l');
$pdf->Ln(8);
$pdf->SetFont('Arial', '', 10);
$pdf->MultiCell(189, 5, strtoupper(utf8_decode(strip_tags($dados->getResponsavel2()))));
$pdf->Ln(2);

$pdf->Cell(190, 10, utf8_decode('________________________________________________________________________________________________'), 0, 0, 'C');
$pdf->Ln(10);

$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(189, 8, utf8_decode('Avaliação'), 0, 0, 'l');
$pdf->Ln(8);
//$pdf->SetFont('Arial', '', 10);
//$pdf->MultiCell(189, 5, strtoupper(utf8_decode(strip_tags($dados->getResponsavel2()))));
//$pdf->Ln(10);

$pdf->SetFont('Arial', 'B', 9);
$pdf->Cell(50, 9, utf8_decode('Investigar?'), 0, 0, 'L');
$pdf->Cell(50, 9, utf8_decode('Responsável'), 0, 1, 'L');
$pdf->SetFont('Arial', '', 10);
if ($dados->getInvestigar() == 'S') {
    $pdf->Cell(50, 1, utf8_decode('SIM'), 0, 0, 'L');
} if ($dados->getInvestigar() == 'N') {
    $pdf->Cell(50, 1, utf8_decode('NÃO'), 0, 0, 'L');
}

$pdf->SetFont('Arial', '', 10);
$pdf->Cell(50, 1, strtoupper(utf8_decode(strip_tags($dados->getResponsavel3()))));
$pdf->Ln(8);

$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(189, 8, utf8_decode('Pessoas Notificadas'), 0, 0, 'l');
$pdf->Ln(8);
$pdf->SetFont('Arial', '', 10);
$pdf->MultiCell(189, 5, strtoupper(utf8_decode(strip_tags($dados->getNotificados()))));
$pdf->Ln(5);


$pdf->Output();
