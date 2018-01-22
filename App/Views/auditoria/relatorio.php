<?php

session_start();
$id_user = $_SESSION['user_id'];
$id_funcionario = $_SESSION['funcionario_id'];
$id_permissao = $_SESSION['permissao_id'];
if ($id_permissao == 1 || $id_permissao == 6) {
    
} else {
    header('Location: ../pri/principal.php?msg=12');
}

include_once '../../AutoLoad/AutoLoad.php';

$id = filter_input(INPUT_GET, 'id');

$adao = new AuditoriaDAO();
$sdao = new StatusDAO();
$tfdao = new TreinamentoFuncionarioDAO();
$fdao = new FuncionarioDAO();
$setordao = new SetorDAO();
$iqdao = new ItemQuestionarioDAO();

$dados = $adao->BuscarRegistroParaEditar($id);
$nm_setor = $setordao->BuscarNomeSetor($dados->getSetorId());


$data = date('d/m/Y');
$hora = date('H:m:s');

require('../fpdf/fpdf.php');

class PDF extends FPDF {

// Page header
    function Header() {
        $data = date('d/m/Y');
        $hora = date('H:i:s');

        $this->Image('../../../img/logo1.png', 4, 6, 40);
        $this->SetFont('Arial', 'B', 15);
        $this->Cell(80);
        $this->Cell(30, 10, utf8_decode('RELATÓRIO '), 0, 0, 'C');
        $this->Cell(-30, 20, utf8_decode('AUDITORIA '), 0, 0, 'C');
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

$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();

$pdf->SetFont('Arial', 'B', 9);
$pdf->Cell(30, 9, utf8_decode('Data Início'), 0, 0, 'L');
$pdf->Cell(50, 9, utf8_decode('Data Término'), 0, 1, 'L');
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(30, 1, date("d/m/Y", strtotime($dados->getDataInicio())), 0, 0, 'L');
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(50, 1, date("d/m/Y", strtotime($dados->getDataFim())));
$pdf->Ln(4);

$pdf->SetFont('Arial', 'B', 9);
$pdf->Cell(50, 9, utf8_decode('Setor'), 0, 0, 'L');
$pdf->Cell(50, 9, utf8_decode('Auditor'), 0, 1, 'L');
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(50, 1, strtoupper(utf8_decode(strip_tags($nm_setor->getDescricao()))), 0, 0, 'L');
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(50, 1, strtoupper(utf8_decode(strip_tags($dados->getAuditor()))));
$pdf->Ln(5);

$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(189, 8, utf8_decode('Objetivos'), 0, 0, 'l');
$pdf->Ln(8);
$pdf->SetFont('Arial', '', 10);
$pdf->MultiCell(189, 4, strtoupper(utf8_decode(strip_tags($dados->getObjetivos()))));
$pdf->Ln(2);

$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(189, 8, utf8_decode('Escopo'), 0, 0, 'l');
$pdf->Ln(8);
$pdf->SetFont('Arial', '', 10);
$pdf->MultiCell(189, 5, strtoupper(utf8_decode(strip_tags($dados->getEscopo()))));
$pdf->Ln(-5);

$pdf->Cell(190, 10, utf8_decode('________________________________________________________________________________________________'), 0, 0, 'C');
$pdf->Ln(10);

$pdf->SetFont('Arial', 'B', 15);
$pdf->Cell(189, 8, utf8_decode('Itens Não Conforme'), 0, 0, 'l');
$pdf->Ln(10);
$aqdao = new AuditoriaQuestaoDAO();
foreach ($aqdao->BuscarTodosNC($dados->getId()) as $idmodo) {
    $nm_questao = $iqdao->BuscarDescricaoQuestao($idmodo->getItemQuestionarioId());
    $count = $idmodo->getItemQuestionarioId();

    $pdf->SetFont('Arial', '', 10);
    $pdf->MultiCell(180, 4, strtoupper(utf8_decode(strip_tags($nm_questao->getDescricao()))));
    $pdf->SetFont('Arial', '', 10);
    $pdf->MultiCell(180, 8, strtoupper(utf8_decode(strip_tags('Evidência : ' . $idmodo->getEvidencias()))));
    $pdf->Ln(-6);
    $pdf->Cell(190, 10, utf8_decode('________________________________________________________________________________________________'), 0, 0, 'C');
    $pdf->Ln(10);
}
$pdf->Ln(2);

$pdf->SetFont('Arial', 'b', 10);
$pdf->Cell(189, 8, utf8_decode('Sugestão de Melhorias'), 0, 0, 'l');
$pdf->Ln(8);
$pdf->SetFont('Arial', '', 10);
$pdf->MultiCell(180, 4, strtoupper(utf8_decode(strip_tags($dados->getSugestao()))));
$pdf->SetFont('Arial', 'b', 10);
$pdf->Cell(189, 8, utf8_decode('Conclusão'), 0, 0, 'l');
$pdf->Ln(8);
$pdf->SetFont('Arial', '', 10);
$pdf->MultiCell(180, 4, strtoupper(utf8_decode(strip_tags($dados->getConclusao()))));
$pdf->Ln(-2);

$pdf->Output();
