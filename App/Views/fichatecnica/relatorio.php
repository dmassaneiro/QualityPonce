<?php
session_start();
$id_user = $_SESSION['user_id'];
$id_funcionario = $_SESSION['funcionario_id'];
$id_permissao = $_SESSION['permissao_id'];
if ($id_permissao == 1 || $id_permissao == 6 || $id_permissao == 2 || $id_permissao == 3) {
            
        } else {
            header('Location: ../pri/principal.php?msg=12');
        }

include_once '../../AutoLoad/AutoLoad.php';

$id = filter_input(INPUT_GET, 'id');

$pdao = new ProdutoDAO();
$fdao = new FichaTecnicaDAO();

$id_ficha = $fdao->BuscarUltimoRegistro();
$d = $fdao->BuscarRegistroParaEditar($id);
$nm_produto = $pdao->VerificaSeProdutoExiste($d->getProdutoId());


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
        $this->Cell(-30, 20, utf8_decode('FICHA TÉCNICA '), 0, 0, 'C');
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
$pdf->Cell(30, 9, utf8_decode('Data Início'), 0, 0, 'L');
$pdf->Cell(50, 9, utf8_decode('Data Término'), 0, 1, 'L');
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(30, 1, date("d/m/Y", strtotime($d->getDataInicio())), 0, 0, 'L');
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(50, 1, date("d/m/Y", strtotime($d->getDataFim())));
$pdf->Ln(4);

$pdf->SetFont('Arial', 'B', 9);
$pdf->Cell(120, 9, utf8_decode('Produto'), 0, 0, 'L');
$pdf->Cell(30, 9, utf8_decode('Nr. da Ordem'), 0, 0, 'L');
$pdf->Cell(50, 9, utf8_decode('Nr. de Série'), 0, 1, 'L');
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(120, 1, utf8_decode($nm_produto->getNome()), 0, 0, 'L');
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(30, 1, utf8_decode($d->getNumeroOrdem()));
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(50, 1, utf8_decode(strtoupper($d->getNumeroSerie())));
$pdf->Ln(1);

$pdf->Cell(190, 10, utf8_decode('________________________________________________________________________________________________'), 0, 0, 'C');
$pdf->Ln(10);

$pdf->SetFont('Arial', 'B', 15);
$pdf->Cell(0, 5, utf8_decode('Montagem'), 0, 1);
$pdf->Ln(2);

$imdao = new ItemMontagemDAO();
$funcionariodao = new FuncionarioDAO();
$mdao = new MontagemDAO();
$d1 = $fdao->BuscarRegistroParaEditar($id);

foreach ($mdao->BuscarTodosdaFicha($d1->getId()) as $idmodo) {
    $count = $idmodo->getItemMontagemId();
    $nm_montagem = $imdao->BuscarDescricaoMontagem($idmodo->getItemMontagemId());

    $pdf->SetFont('Arial', 'B', 9);
    $pdf->Cell(120, 9, utf8_decode('Item Montagem'), 0, 0, 'L');
    $pdf->Cell(22, 9, utf8_decode('Data'), 0, 0, 'L');
    $pdf->Cell(25, 9, utf8_decode('Responsavel'), 0, 1, 'L');
    $pdf->SetFont('Arial', '', 10);
    $pdf->Cell(120, 1, utf8_decode($nm_montagem->getDescricao()), 0, 0, 'L');
    $pdf->SetFont('Arial', '', 10);
    $pdf->Cell(22, 1, date("d/m/Y", strtotime($idmodo->getData())));
    $pdf->SetFont('Arial', '', 10);
    $pdf->Cell(25, 1, utf8_decode($idmodo->getResponsavel()));
    $pdf->Ln(8);
}

$pdf->Cell(190, 10, utf8_decode('________________________________________________________________________________________________'), 0, 0, 'C');
$pdf->Ln(10);

$pdf->SetFont('Arial', 'B', 15);
$pdf->Cell(0, 5, utf8_decode('Rigidez Dielétrica'), 0, 1);
$pdf->Ln(2);

$irdao = new ItemRigidezDAO();
$rdao = new RigidezDAO();
foreach ($rdao->BuscarTodosdaFicha($d1->getId()) as $idmodo2) {
    $nm_rigidez = $irdao->BuscarDescricaoRigidez($idmodo2->getItemRigidezDieletricaId());
    $pdf->SetFont('Arial', 'B', 9);
    $pdf->Cell(120, 9, utf8_decode('Item Rigidez dielétrica'), 0, 0, 'L');
    $pdf->Cell(22, 9, utf8_decode(''), 0, 0, 'L');
    $pdf->Cell(25, 9, utf8_decode('Data'), 0, 1, 'L');
    $pdf->SetFont('Arial', '', 10);
    $pdf->Cell(120, 1, utf8_decode($nm_rigidez->getDescricao()), 0, 0, 'L');
    $pdf->SetFont('Arial', '', 10);
    $pdf->Cell(22, 1, utf8_decode(''));
    $pdf->SetFont('Arial', '', 10);
    $pdf->Cell(25, 1, date("d/m/Y", strtotime($idmodo->getData())));
    $pdf->Ln(2);

    $pdf->SetFont('Arial', 'B', 9);
    $pdf->Cell(35, 9, utf8_decode('Resultado'), 0, 0, 'L');
    $pdf->Cell(30, 9, utf8_decode('Corrente mA'), 0, 0, 'L');
    $pdf->Cell(25, 9, utf8_decode('Responsavel'), 0, 1, 'L');
    $pdf->SetFont('Arial', '', 10);
    if ($idmodo2->getResultado() == 'C') {
        $pdf->Cell(35, 1, utf8_decode('CONFORME'), 0, 0, 'L');
    }if ($idmodo2->getResultado() == 'NC') {
        $pdf->Cell(35, 1, utf8_decode('NÃO CONFORME'), 0, 0, 'L');
    }
    $pdf->SetFont('Arial', '', 10);
    $pdf->Cell(30, 1, $idmodo2->getCorrenteMa());
    $pdf->SetFont('Arial', '', 10);
    $pdf->Cell(25, 1, utf8_decode($idmodo2->getReponsavel()));
    $pdf->Ln(8);
}
$pdf->Cell(190, 10, utf8_decode('________________________________________________________________________________________________'), 0, 0, 'C');
$pdf->Ln(10);

$pdf->SetFont('Arial', 'B', 15);
$pdf->Cell(0, 5, utf8_decode('Corrente de Fuga'), 0, 1);
$pdf->Ln(2);

$itemcorrentedao = new CorrenteFugaDAO();
$modo = new ModoDAO();
$corrente = new ItemCorrenteDAO();
$cdao = new CorrenteFugaDAO();
$mododao = new ModoDAO();
foreach ($mododao->BuscarTodosdoProduto($d1->getProdutoId()) as $idcorrente) {
    $pdf->SetFont('Arial', 'B', 9);
    $pdf->Cell(120, 9, utf8_decode('Item Corrente de Fuga'), 0, 1, 'L');
    $pdf->SetFont('Arial', '', 10);
    $pdf->Cell(120, 1, utf8_decode($idcorrente->getDescricao()), 0, 0, 'L');
    $pdf->Ln(2);

    $t = new CorrenteFugaDAO();
    foreach ($t->BuscarTodosdaFicha($d1->getId(), $idcorrente->getId()) as $idmodo3) {
        $nm_corrente = $t->BuscarNomedaCorrente($idmodo3->getItemCorrenteFugaId());

        $pdf->SetFont('Arial', 'B', 9);
        $pdf->Cell(35, 9, utf8_decode('Modo'), 0, 0, 'L');
        $pdf->Cell(35, 9, utf8_decode('Data'), 0, 0, 'L');
        $pdf->Cell(30, 9, utf8_decode('Valor CA (uA)'), 0, 0, 'L');
        $pdf->Cell(35, 9, utf8_decode('Valor CC (uA)'), 0, 0, 'L');
        $pdf->Cell(25, 9, utf8_decode('Responsavel'), 0, 1, 'L');
        $pdf->SetFont('Arial', '', 10);
        $pdf->Cell(35, 1, utf8_decode($nm_corrente->getDescricao()), 0, 0, 'L');
        $pdf->SetFont('Arial', '', 10);
        $pdf->Cell(35, 1, date("d/m/Y", strtotime($idmodo3->getData())), 0, 0, 'L');
        $pdf->SetFont('Arial', '', 10);
        $pdf->Cell(30, 1, utf8_decode($idmodo3->getValorCa()), 0, 0, 'L');
        $pdf->SetFont('Arial', '', 10);
        $pdf->Cell(35, 1, $idmodo3->getValorCc());
        $pdf->SetFont('Arial', '', 10);
        $pdf->Cell(25, 1, utf8_decode($idmodo3->getResponsavel()));
        $pdf->Ln(4);
    }
    $pdf->Ln(6);
}
$pdf->Cell(190, 10, utf8_decode('________________________________________________________________________________________________'), 0, 0, 'C');
$pdf->Ln(10);

$pdf->SetFont('Arial', 'B', 15);
$pdf->Cell(0, 5, utf8_decode('Teste Funcional'), 0, 1);
$pdf->Ln(2);

$idao = new ItemTesteDAO();

$a = new TesteDAO();
$dados = $fdao->BuscarRegistroParaEditar($id);
foreach ($a->BuscarTodosdaFicha($dados->getId()) as $idmodo4) {
    $nm_teste = $a->BuscarNomeTeste($idmodo4->getItemTesteId());

    $pdf->SetFont('Arial', 'B', 9);
    $pdf->Cell(120, 9, utf8_decode('Item Teste Funcional'), 0, 0, 'L');
    $pdf->Cell(22, 9, utf8_decode(''), 0, 0, 'L');
    $pdf->Cell(25, 9, utf8_decode('Data'), 0, 1, 'L');
    $pdf->SetFont('Arial', '', 10);
    $pdf->Cell(120, 1, utf8_decode($nm_teste->getDescricao()), 0, 0, 'L');
    $pdf->SetFont('Arial', '', 10);
    $pdf->Cell(22, 1, utf8_decode(''));
    $pdf->SetFont('Arial', '', 10);
    $pdf->Cell(25, 1, date("d/m/Y", strtotime($idmodo4->getData())));
    $pdf->Ln(2);

    $pdf->SetFont('Arial', 'B', 9);
    $pdf->Cell(35, 9, utf8_decode('Resultado'), 0, 0, 'L');
    $pdf->Cell(30, 9, utf8_decode('Observação'), 0, 0, 'L');
    $pdf->Cell(25, 9, utf8_decode('Responsavel'), 0, 1, 'L');
    $pdf->SetFont('Arial', '', 10);
    if ($idmodo4->getResultado() == 'C') {
        $pdf->Cell(35, 1, utf8_decode('CONFORME'), 0, 0, 'L');
    }if ($idmodo4->getResultado() == 'NC') {
        $pdf->Cell(35, 1, utf8_decode('NÃO CONFORME'), 0, 0, 'L');
    }
    $pdf->SetFont('Arial', '', 10);
    $pdf->Cell(30, 1, utf8_decode($idmodo4->getObservacao()));
    $pdf->SetFont('Arial', '', 10);
    $pdf->Cell(25, 1, utf8_decode($idmodo4->getResponsavel()));
    $pdf->Ln(8);
}

$pdf->Cell(190, 10, utf8_decode('________________________________________________________________________________________________'), 0, 0, 'C');
$pdf->Ln(10);

$pdf->SetFont('Arial', 'B', 15);
$pdf->Cell(0, 5, utf8_decode('Instrumentos'), 0, 1);
$pdf->Ln(2);

$dados = $fdao->BuscarRegistroParaEditar($id);
$inss = new FichaTecnicaInstrumentoDAO();
$instrumento = new InstrumentoDAO();

$pdf->SetFont('Arial', 'B', 9);
$pdf->Cell(120, 9, utf8_decode('Nome Instrumento'), 0, 0, 'L');
$pdf->Cell(22, 9, utf8_decode(''), 0, 0, 'L');
$pdf->Cell(25, 9, utf8_decode('Idêntificação'), 0, 1, 'L');
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(120, 1, utf8_decode(''), 0, 0, 'L');
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(22, 1, utf8_decode(''));
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(25, 1, utf8_decode(('')));
$pdf->Ln(-8);

foreach ($inss->BuscarTodosdaFicha($dados->getId()) as $tf) {
    $nm_instrumento = $instrumento->BuscaroNomePeloId($tf->getInstrumentoId());

    $pdf->SetFont('Arial', 'B', 9);
    $pdf->Cell(120, 9, utf8_decode(''), 0, 0, 'L');
    $pdf->Cell(22, 9, utf8_decode(''), 0, 0, 'L');
    $pdf->Cell(25, 9, utf8_decode(''), 0, 1, 'L');
    $pdf->SetFont('Arial', '', 10);
    $pdf->Cell(120, 1, utf8_decode($nm_instrumento->getDescricao()), 0, 0, 'L');
    $pdf->SetFont('Arial', '', 10);
    $pdf->Cell(22, 1, utf8_decode(''));
    $pdf->SetFont('Arial', '', 10);
    $pdf->Cell(25, 1, utf8_decode(($nm_instrumento->getIdentificacao())));
    $pdf->Ln(-4);
}
    $pdf->Ln(8);

$pdf->Cell(190, 10, utf8_decode('________________________________________________________________________________________________'), 0, 0, 'C');
$pdf->Ln(10);

$pdf->SetFont('Arial', 'B', 15);
$pdf->Cell(0, 5, utf8_decode('Liberação do Produto'), 0, 1);
$pdf->Ln(2);

$ldao = new ItemLiberacaoDAO();
$libb = new LiberacaoDAO();

$pdf->SetFont('Arial', 'B', 9);
$pdf->Cell(120, 9, utf8_decode('Item Liberação'), 0, 0, 'L');
$pdf->Cell(22, 9, utf8_decode(''), 0, 0, 'L');
$pdf->Cell(25, 9, utf8_decode('Conferido?'), 0, 1, 'L');
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(120, 1, utf8_decode(''), 0, 0, 'L');
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(22, 1, utf8_decode(''));
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(25, 1, utf8_decode(('')));
$pdf->Ln(8);
foreach ($libb->BuscarTodosdaFicha($dados->getId()) as $lib) {
    $nm_item = $ldao->BuscarNomePeloId($lib->getItemLiberacaoId());
    
$pdf->SetFont('Arial', 'B', 9);
$pdf->Cell(120, 9, utf8_decode(''), 0, 0, 'L');
$pdf->Cell(22, 9, utf8_decode(''), 0, 0, 'L');
$pdf->Cell(25, 9, utf8_decode(''), 0, 1, 'L');
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(120, 1, utf8_decode(strtoupper($nm_item->getDescricao())), 0, 0, 'L');
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(22, 1, utf8_decode(''));
$pdf->SetFont('Arial', '', 10);
if ($lib->getConferido() == "S") {
$pdf->Cell(25, 1, utf8_decode(('SIM')));
}
if ($lib->getConferido() == "N") {
$pdf->Cell(25, 1, utf8_decode(('NÂO')));
}
$pdf->Ln(-3);
}

$pdf->Output();
