<?php

include_once '../../AutoLoad/AutoLoad.php';

$tdao = new TreinamentoDAO();
$fdao = new FuncionarioDAO();
$tfdao = new TreinamentoFuncionarioDAO;

$id = filter_input(INPUT_GET, 'id');

$dados = $tdao->BuscarEdit($id);


require('../fpdf/fpdf.php');

class PDF extends FPDF {

// Page header
    function Header() {
        $data = date('d/m/Y');
        $hora = date('H:i:s');

        $this->Image('../../../img/logo1.png', 4, 6, 40);
        $this->SetFont('Arial', 'B', 15);
        $this->Cell(80);
        $this->Cell(30, 10, utf8_decode(' '), 0, 0, 'C');
        $this->Cell(-30, 20, utf8_decode('LISTA DE PRESENÇA TREINAMENTO '), 0, 0, 'C');
        $this->Cell(40);
        $this->SetFont('Arial', '', 10);
        $this->Cell(110, 10, 'Data :' . $data, 0, 0, 'C');
        $this->Cell(-114, 20, 'Hora :' . $hora, 0, 0, 'C');
        $this->SetY(12);
        $this->SetFont('Arial', '', 10);
        $this->Cell(346, 30, utf8_decode('Página : ') . $this->PageNo() . '/{nb}', 0, 0, 'C');
        $this->Ln(12);
        $this->SetFont('Arial', '', 10);
        $this->Cell(190, 10, utf8_decode('________________________________________________________________________________________________'), 0, 0, 'C');
        $this->Ln(10);
    }

}

// Instanciation of inherited class
$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Arial', 'B', 9);
$pdf->Cell(0, 10, utf8_decode('Data Início '), 0, 1);
$pdf->Ln(-5);
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(0, 10, date("d/m/Y", strtotime($dados->getDataInicio())), 0, 1, 'L');
$pdf->Ln(0);

$pdf->SetFont('Arial', 'B', 9);
$pdf->Cell(0, 2, utf8_decode('Data Fim'), 0, 1);
$pdf->Ln(4);
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(0, -2, date("d/m/Y", strtotime($dados->getDataFim())), 0, 1, 'L');
$pdf->Ln(10);

$pdf->SetFont('Arial', 'B', 9);
$pdf->Cell(0, -5, utf8_decode('Descrição/ Nome Treinamento'), 0, 1);
$pdf->SetFont('Arial', '', 10);
$pdf->Ln(4);
$pdf->Cell(0, 7, utf8_decode($dados->getDescricao()), 0, 1, 'L');
$pdf->Ln(5);

$pdf->SetFont('Arial', 'B', 9);
$pdf->Cell(0, -5, utf8_decode('Nome do Aplicador'), 0, 1);
$pdf->SetFont('Arial', '', 10);
$pdf->Ln(4);
$pdf->Cell(0, 7, utf8_decode($dados->getAplicador()), 0, 1, 'L');
$pdf->Ln(5);

$pdf->SetFont('Arial', 'B', 9);
$pdf->Cell(0, -5, utf8_decode('Local'), 0, 1);
$pdf->SetFont('Arial', '', 10);
$pdf->Ln(4);
$pdf->Cell(0, 7, utf8_decode($dados->getLocalTreinamento()), 0, 1, 'L');
$pdf->Ln(0);

$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(189, 8, utf8_decode('Conteúdo Programático'), 0, 0, 'l');
$pdf->Ln(8);
$pdf->SetFont('Arial', '', 10);
$pdf->MultiCell(189, 5, strtoupper(utf8_decode(strip_tags($dados->getDescricao()))));


$pdf->Ln(-3);
$pdf->Cell(190, 10, utf8_decode('________________________________________________________________________________________________'), 0, 0, 'C');
$pdf->Ln(10);

//$pdf->SetFont('Arial', 'B', 12);
//$pdf->Cell(189, 8, utf8_decode('PARTICIPANTES'), 0, 0, 'l');
//$pdf->Ln(4);
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(120, 9, utf8_decode('PARTICIPANTES'), 0, 0, 'L');
$pdf->SetFont('Arial', 'B', 9);
$pdf->Cell(30, 9, utf8_decode('Assinatura'), 0, 1, 'c');
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(120, 1, '', 0, 0, 'L');
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(30, 1, '');
$pdf->Ln(-4);

foreach ($tfdao->BuscarFuncionariosDoTreinamento2($dados->getId()) as $tf) {
    $nm_funcionario = $fdao->BuscarNomeFuncionario($tf->getFuncionarioId());
//    $pdf->SetFont('Arial', '', 10);
//    $pdf->Cell(189, 8, strtoupper(utf8_decode(strip_tags($nm_funcionario->getNome()))), 0, 0, 'l');
//    $pdf->Ln(8);
    
$pdf->SetFont('Arial', 'B', 9);
$pdf->Cell(120, 9, utf8_decode(''), 0, 0, 'L');
$pdf->Cell(30, 9, utf8_decode(''), 0, 1, 'L');
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(120, 1, strtoupper(utf8_decode(strip_tags($nm_funcionario->getNome()))), 0, 0, 'L');
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(30, 1, '___________________________________');
$pdf->Ln(-1);
}
$pdf->Cell(190, 10, utf8_decode('________________________________________________________________________________________________'), 0, 0, 'C');
$pdf->Ln(10);




$pdf->Output();
