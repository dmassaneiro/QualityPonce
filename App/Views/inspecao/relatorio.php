<?php
session_start();
$id_user = $_SESSION['user_id'];
$id_funcionario = $_SESSION['funcionario_id'];
$id_permissao = $_SESSION['permissao_id'];
 if ($id_permissao == 1 || $id_permissao == 6 || $id_permissao == 4 || $id_permissao == 5 || $id_permissao == 2) {
            
        } else {
            header('Location: ../pri/principal.php?msg=12');
        }

header('Content-type: text/html; charset=utf-8');
setlocale(LC_ALL, 'pt_BR.utf-8', 'pt_BR', 'Portuguese_Brazil');
include_once '../../AutoLoad/AutoLoad.php';

include_once '../../AutoLoad/AutoLoad.php';

$ldao = new LaudoInspecaoDAO();
$fdao = new FornecedorDAO();
$mdao = new MateriaPrimaDAO();

$id = filter_input(INPUT_GET, 'id');
if (empty($id)) {
    header("Location: ../inspecao/inicio.php");
}

$d = $ldao->BuscarRegistroParaEditar($id);
$m = $mdao->BuscaPeloId($d->getMateriaPrimaId());
$f = $fdao->BuscarNome($d->getFornecedor());



require('../fpdf/fpdf.php');
$data = date('d/m/Y');
$hora = date('H:i:s');


$pdf = new FPDF();
$pdf->AddPage();
$pdf->Image('../../../img/logo1.png', 4, 6, 40);
$pdf->SetFont('Arial', 'B', 15);
$pdf->Cell(80);
$pdf->Cell(30, 10, utf8_decode('RELATÓRIO '), 0, 0, 'C');
$pdf->Cell(-30, 20, utf8_decode('INSPEÇÃO DE MATÉRIA-PRIMA'), 0, 0, 'C');
$pdf->Cell(40);
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(110, 10, 'Data :' . $data, 0, 0, 'C');
$pdf->Cell(-114, 20, 'Hora :' . $hora, 0, 0, 'C');
$pdf->Ln(15);

$pdf->Cell(190, 10, utf8_decode('________________________________________________________________________________________________'), 0, 0, 'C');
$pdf->Ln(10);

$pdf->SetFont('Arial', 'B', 9);
$pdf->Cell(0, 10, 'Fornecedor', 0, 1);
$pdf->SetFont('Arial', '', 10);
$pdf->Ln(10);
$nm_for = $fdao->BuscarNome($d->getFornecedor());
$pdf->Cell(0, -20, utf8_decode($nm_for->getNome()), 0, 1, 'L');
$pdf->Ln(12);

$pdf->SetFont('Arial', 'B', 9);
$pdf->Cell(0, 10, 'CNPJ', 0, 1);
$pdf->SetFont('Arial', '', 10);
$pdf->Ln(10);
$pdf->Cell(0, -20, utf8_decode($nm_for->getCnpj()), 0, 1, 'L');
$pdf->Ln(12);

$pdf->SetFont('Arial', 'B', 9);
$pdf->Cell(63, 9, utf8_decode('Numero/Série NF-e'), 0, 0, 'L');
$pdf->Cell(63, 9, 'Data do Cadastro', 0, 0, 'L');
$pdf->Cell(63, 9, 'Data do Recebimento', 0, 1, 'L');
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(63, 1, utf8_decode($d->getNumeroNota()), 0, 0, 'L');
$pdf->Cell(63, 1, date("d/m/Y", strtotime($d->getDataInspecao())), 0, 0, 'L');
$pdf->Cell(63, 1, date("d/m/Y", strtotime($d->getDataRecebimento())), 0, 1, 'L');
$pdf->Ln(5);

$pdf->Cell(190, 10, utf8_decode('________________________________________________________________________________________________'), 0, 0, 'C');
$pdf->Ln(5);

$pdf->SetFont('Arial', 'B', 9);
$pdf->Cell(156, 9, utf8_decode('Item'), 0, 0, 'L');
$pdf->Cell(20, 9, 'Qtd. no Lote', 0, 1, 'L');
$pdf->SetFont('Arial', '', 10);
$nm_mat = $mdao->BuscaNome($d->getMateriaPrimaId());
$pdf->Cell(156, 1, utf8_decode($nm_mat->getNome()), 0, 0, 'L');
$pdf->Cell(20, 1, $d->getQuantidadeLote(), 0, 1, 'L');
$pdf->Ln(-2);

$pdf->Cell(190, 10, utf8_decode('________________________________________________________________________________________________'), 0, 0, 'C');
$pdf->Ln(8);

$pdf->SetFont('Arial', 'B', 9);
$pdf->Cell(30, 9, utf8_decode('Tipo de Inspeção'), 0, 0, 'L');
$pdf->Cell(30, 9, '', 0, 1, 'L');

$pdf->SetFont('Arial', '', 10);
if ($d->getTipoinspecao1() == '1') {
    $pdf->Cell(30, 1, utf8_decode('100 %'), 0, 0, 'L');
    if ($d->getTipoinspecao2() == 'N') {
        $pdf->Cell(30, 1, 'NORMAL', 0, 1, 'L');
    }
    if ($d->getTipoinspecao2() == 'S') {
        $pdf->Cell(30, 1, 'SEVERA', 0, 1, 'L');
    }
    if ($d->getTipoinspecao2() == 'A') {
        $pdf->Cell(30, 1, 'ATENUADA', 0, 1, 'L');
    }
} else {
    $pdf->Cell(30, 1, utf8_decode('AMOSTRAL'), 0, 0, 'L');

    if ($d->getTipoinspecao2() == '1') {
        $pdf->Cell(30, 1, 'I', 0, 1, 'L');
    }if ($d->getTipoinspecao2() == '2') {
        $pdf->Cell(30, 1, 'II', 0, 1, 'L');
    } if ($d->getTipoinspecao2() == '3') {
        $pdf->Cell(30, 1, 'III', 0, 1, 'L');
    } if ($d->getTipoinspecao2() == '4') {
        $pdf->Cell(30, 1, 'NÃO APLICAVEL', 0, 1, 'L');
    }
}
$pdf->Ln(5);

$pdf->SetFont('Arial', 'B', 9);
$pdf->Cell(189, 8, utf8_decode('Critérios para Aprovação'),0, 0, 'l');
$pdf->Ln(8);
$pdf->SetFont('Arial', '', 10);
$pdf->MultiCell(189, 3, strtoupper(utf8_decode(strtoupper(strip_tags($d->getCriterios())))));

$pdf->Cell(190, 10, utf8_decode('________________________________________________________________________________________________'), 0, 0, 'C');
$pdf->Ln(8);

$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(189, 8, utf8_decode('RESULTADOS'),0, 0, 'l');
$pdf->Ln(8);

$pdf->SetFont('Arial', 'B', 9);
$pdf->Cell(63, 9, utf8_decode('Qtd. Conforme'), 0, 0, 'L');
$pdf->Cell(63, 9, utf8_decode('Qtd. não Conforme'), 0, 0, 'L');
$pdf->Cell(63, 9, 'Nr. do Lote', 0, 1, 'L');
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(63, 1, utf8_decode($d->getQuantidadeConforme() ), 0, 0, 'L');
$pdf->Cell(63, 1, $d->getQuantidadeDefeito(), 0, 0, 'L');
$pdf->Cell(63, 1, $d->getNumeroLote() , 0, 1, 'L');

$pdf->Ln(8);

$pdf->SetFont('Arial', 'B', 9);
$pdf->Cell(189, 8, utf8_decode('Observação'),0, 0, 'l');
$pdf->Ln(8);
$pdf->SetFont('Arial', '', 10);
$pdf->MultiCell(189, 3, strtoupper(utf8_decode(strtoupper(strip_tags($d->getObservacao())))));

$pdf->Output();
