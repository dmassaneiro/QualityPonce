<?php

session_start();
$id_user = $_SESSION['user_id'];
$id_funcionario = $_SESSION['funcionario_id'];
$id_permissao = $_SESSION['permissao_id'];

include_once '../../AutoLoad/AutoLoad.php';

$ncdao = new NcProcessoDAO();
$setordao = new SetorDAO();
$tipodencdao = new TipoNaoConformidadeDAO();

$id_nc_processo = filter_input(INPUT_GET, 'id');

$dados = $ncdao->BuscarRegistroParaEditar($id_nc_processo);
$nome_setor = $setordao->BuscarNomeSetor($dados->getSetorId());
$nome_tipo_nc = $tipodencdao->BuscarNomeNC($dados->getTipoNaoConformidadeId());

require('../fpdf/fpdf.php');
$data = date('d/m/Y');
$hora = date('H:i:s');


$pdf = new FPDF();
$pdf->AddPage();
$pdf->Image('../../../img/logo1.png', 4, 6, 40);
$pdf->SetFont('Arial', 'B', 15);
$pdf->Cell(80);
$pdf->Cell(30, 10, utf8_decode('RELATÓRIO '), 0, 0, 'C');
$pdf->Cell(-30, 20, utf8_decode('NÃO CONFORMIDADE PROCESSO'), 0, 0, 'C');
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
$pdf->Cell(0, 10, date("d/m/Y", strtotime($dados->getDataEmisao())), 0, 1, 'L');
$pdf->Ln(0);

$pdf->SetFont('Arial', 'B', 9);
$pdf->Cell(0, 2, utf8_decode('Areá de Detecção '), 0, 1);
$pdf->Ln(4);
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(0, -2, utf8_decode($nome_setor->getDescricao()), 0, 1, 'L');
$pdf->Ln(10);

$pdf->SetFont('Arial', 'B', 9);
$pdf->Cell(0, -5, utf8_decode('Origem'), 0, 1);
$pdf->SetFont('Arial', '', 10);
$pdf->Ln(4);
$pdf->Cell(0, 7, utf8_decode($nome_tipo_nc->getDescricao()), 0, 1, 'L');
$pdf->Ln(4);

$pdf->Ln(5);
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(189, 8, utf8_decode('Descrição da Não Conformidade'), 0, 0, 'l');
$pdf->Ln(8);
$pdf->SetFont('Arial', '', 10);
$pdf->MultiCell(189, 5, utf8_decode(strtoupper($dados->getDescricao())));

$pdf->Cell(190, 10, utf8_decode('________________________________________________________________________________________________'), 0, 0, 'C');

$pdf->Ln(5);
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(189, 8, utf8_decode('Justificativa'), 0, 0, 'l');
$pdf->Ln(8);
$pdf->SetFont('Arial', '', 10);
$pdf->MultiCell(189, 5, strtoupper(utf8_decode(strip_tags($dados->getJustifiva()))));

$pdf->Cell(190, 10, utf8_decode('________________________________________________________________________________________________'), 0, 0, 'C');

$pdf->Ln(5);
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(189, 8, utf8_decode('Ação Executada'), 0, 0, 'l');
$pdf->Ln(8);
$pdf->SetFont('Arial', '', 10);
$pdf->MultiCell(189, 5, strtoupper(utf8_decode(strip_tags($dados->getAcaoExecutada()))));

$pdf->Cell(190, 10, utf8_decode('________________________________________________________________________________________________'), 0, 0, 'C');
$pdf->Ln(5);

$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(189, 8, utf8_decode('Notificado(s)'), 0, 0, 'l');
$pdf->Ln(8);
$pdf->SetFont('Arial', '', 10);
$pdf->MultiCell(189, 5, strtoupper(utf8_decode(strip_tags($dados->getNotificado()))));

$pdf->Cell(190, 10, utf8_decode('________________________________________________________________________________________________'), 0, 0, 'C');
$pdf->Ln(10);
$pdf->SetFont('Arial', 'B', 9);
$pdf->Cell(50, 9, utf8_decode('Exige Ação Corretiva'), 0, 0, 'L');
$pdf->Cell(50, 9, 'Gravidade', 0, 1, 'L');
$pdf->SetFont('Arial', '', 10);
if ($dados->getAcaoCorretiva() == 'S') {
    $pdf->Cell(50, 1, utf8_decode('SIM'), 0, 0, 'L');
} if ($dados->getAcaoCorretiva() == 'N') {
    $pdf->Cell(50, 1, utf8_decode('NÃO'), 0, 0, 'L');
}
if ($dados->getGravidade() == 'A') {
    $pdf->Cell(50, 1, 'ALTA', 0, 1, 'L');
} if ($dados->getGravidade() == 'B') {
    $pdf->Cell(50, 1, 'BAIXA', 0, 1, 'L');  
}
$pdf->Ln(-2);

$pdf->Output();
