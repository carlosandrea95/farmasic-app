<?php
class PDF_Purchase_Orders extends PDF
{
  private $pdf;
  public function __construct()
  {
    $this->pdf = new PDF();
    $page_limiter = 25;
    $nb_page = Shopping::getPDFLinesPerPage($page_limiter);
    $num_page = 1;
    $limit_inf = 0;
    $limit_sup = $page_limiter;
    while ($num_page <= $nb_page) {
      $this->pdf->AddPage();
      $this->header();
      $this->lines_header();
      $line = Shopping::getPDFShoppingLines($limit_inf, $limit_sup);
      for ($i = 0; $i < $page_limiter; $i++) {
        if (isset($line[$i])) {
          if ($i == 0) {
            $this->pdf->Cell(30, 5, $line[$i]['id'], 'TL', 0, 'C');
            $this->pdf->Cell(80, 5, utf8_decode(strtoupper($line[$i]['product'])), 'TLR', 0, 'L');
            $this->pdf->Cell(20, 5, $line[$i]['quantity'], 'TLR', 0, 'C');
            $this->pdf->Cell(30, 5,  number_format($line[$i]['punit'], 2, ',', '.'), 'TLR', 0, 'R');
            $this->pdf->Cell(30, 5, number_format($line[$i]['sub_bs'], 2, ',', '.'), 'TR', 0, 'R');
            $this->pdf->Ln();
          } else {
            $this->pdf->Cell(30, 5, $line[$i]['id'], 'L', 0, 'C');
            $this->pdf->Cell(80, 5, utf8_decode(strtoupper($line[$i]['product'])), 'LR', 0, 'L');
            $this->pdf->Cell(20, 5, $line[$i]['quantity'], 'LR', 0, 'C');
            $this->pdf->Cell(30, 5,  number_format($line[$i]['punit'], 2, ',', '.'), 'LR', 0, 'R');
            $this->pdf->Cell(30, 5, number_format($line[$i]['sub_bs'], 2, ',', '.'), 'R', 0, 'R');
            $this->pdf->Ln();
          }
        } else {
          if ($i == ($page_limiter - 1)) {
            $this->pdf->Cell(30, 5, '', 'BL', 0, 'C');
            $this->pdf->Cell(80, 5, '', 'BLR', 0, 'L');
            $this->pdf->Cell(20, 5, '', 'BLR', 0, 'C');
            $this->pdf->Cell(30, 5, '', 'BLR', 0, 'C');
            $this->pdf->Cell(30, 5, '', 'BR', 0, 'C');
            $this->pdf->Ln();
          } else {
            $this->pdf->Cell(30, 5, '', 'L', 0, 'C');
            $this->pdf->Cell(80, 5, '', 'LR', 0, 'L');
            $this->pdf->Cell(20, 5, '', 'LR', 0, 'C');
            $this->pdf->Cell(30, 5, '', 'LR', 0, 'C');
            $this->pdf->Cell(30, 5, '', 'R', 0, 'C');
            $this->pdf->Ln();
          }
        }
      }
      if ($num_page == $nb_page) {
        $this->Footer();
      }
      if ($nb_page > 1) {
        $this->pdf->SetXY(178.5, 1.5);
        $this->pdf->SetFont('Arial', 'B', 7.5);
        $this->pdf->Cell(30, 3.5, utf8_decode('Página ' . $num_page . '/' . $nb_page), '', 0, 'C');
      }
      $num_page++;
      $limit_inf = $limit_inf + $page_limiter;
      $limit_sup = $limit_inf;
    }
  }
  public function preview()
  {
    $this->pdf->Output();
  }
  public function header()
  {

    // LOGO
    $this->pdf->Image(IMG_URI . 'tools/logo_drovaz.png', 10, 10, 70, 20);

    // DOCUMENT INFO
    $this->pdf->SetXY(120, 5);
    $this->pdf->SetFont("Arial", "B", 12);
    $ShoppingOrderInfo = Shopping::getPDFShoppingOrderInfo();
    $num_fact = "ORDEN DE COMPRA No. " . $ShoppingOrderInfo['id'];
    $this->pdf->SetLineWidth(0.1);
    $this->pdf->SetFillColor(192);
    $this->pdf->Rect(120, 15, 85, 8, "DF");
    $this->pdf->SetXY(120, 15);
    $this->pdf->SetFont("Arial", "B", 12);
    $this->pdf->Cell(85, 8, $num_fact, 0, 0, 'C');

    // ORDER INFO
    $champ_date = date_create($ShoppingOrderInfo['created_at']);
    $date_fact = date_format($champ_date, 'd/m/Y');
    $this->pdf->SetFont("Arial", "B", 9);
    $this->pdf->SetXY(175, 22);
    $this->pdf->Cell(60, 8, "FECHA: " . $date_fact, 0, 0, '');

    // COMPANY INFO 
    $companyInfo = Parameters::getPDFCompanyInfo();
    $this->pdf->SetFont("Arial", "B", 8);
    $this->pdf->SetXY(10, 36);
    $this->pdf->MultiCell(70, 3.5, utf8_decode($companyInfo['address']), 0, 'L', false);
    $this->pdf->MultiCell(70, 3.5, utf8_decode($companyInfo['email']), '', 'L', false);
    $this->pdf->MultiCell(70, 3.5, utf8_decode('Teléfono: ' . $companyInfo['phone']), '', 'L', false);

    // SUPPLIER  INFO
    $supplierInfo = Shopping::getPDFSupplierInfo();
    $num_fact = "VENDEDOR";
    $this->pdf->SetLineWidth(0.1);
    $this->pdf->SetFillColor(192);
    $y = $this->pdf->GetY();
    $this->pdf->Rect(10, $y + 2, 85, 5, "DF");
    $this->pdf->SetXY(10, $y + 2.1);
    $this->pdf->SetFont("Arial", "B", 9);
    $this->pdf->Cell(85, 5, $num_fact, 0, 0, 'C');
    $this->pdf->Ln();
    $this->pdf->Cell(70, 5, $supplierInfo['name'], 0, 0, 'J');
    $this->pdf->Ln();
    $this->pdf->MultiCell(70, 5, utf8_decode($supplierInfo['address'] . ',' . $supplierInfo['contact_person']), 0, 'L', false);
    $this->pdf->Cell(70, 5,  utf8_decode('Teléfono: ') . $supplierInfo['contact_person'], 0, 0, 'J');
    $this->pdf->Ln();
    $this->pdf->Cell(70, 5,  $supplierInfo['email'], 0, 0, 'J');
    $this->pdf->Ln();
    $this->pdf->Ln();
  }
  public function lines_header()
  {
    $this->pdf->SetY(80);
    $this->pdf->AliasNbPages();
    $this->pdf->SetFont('Arial', 'B', 7);
    $this->pdf->Cell(30, 3.5, utf8_decode('CÓDIGO'), 1, 0, 'C');
    $this->pdf->Cell(80, 3.5, utf8_decode('DESCRIPCIÓN DEL PRODUCTO'), 1, 0, 'C');
    $this->pdf->Cell(20, 3.5, utf8_decode('CANT.'), 1, 0, 'C');
    $this->pdf->Cell(30, 3.5, 'P/U', 1, 0, 'C');
    $this->pdf->Cell(30, 3.5, utf8_decode('TOTAL'), 1, 0, 'C');
    $this->pdf->Ln();
    $this->pdf->SetFont('Arial', '', 7.5);
  }
  function Footer()
  {
    $ShoppingOrderInfo = Shopping::getPDFShoppingOrderInfo();
    $this->pdf->SetX(140);
    $this->pdf->SetFont('Arial', '', 9);
    $this->pdf->Cell(30, 5, 'SUBTOTAL', 0, 0, 'R');
    $this->pdf->SetX(170);
    $this->pdf->SetFont('Arial', 'B', 6.8);
    $this->pdf->Cell(30, 5, '123', 1, 0, 'R');
    $this->pdf->Ln();
    $this->pdf->SetX(140);
    $this->pdf->SetFont('Arial', '', 9);
    $this->pdf->Cell(30, 5, utf8_decode('I.V.A (16%)'), 0, 0, 'R');
    $this->pdf->SetX(170);
    $this->pdf->SetFont('Arial', 'B', 6.8);
    $this->pdf->Cell(30, 5, '123', 1, 0, 'R');
    $this->pdf->Ln();
    $this->pdf->SetX(140);
    $this->pdf->SetFont('Arial', 'B', 12);
    $this->pdf->Cell(30, 5, 'TOTAL', 0, 0, 'R');
    $this->pdf->SetX(170);
    $this->pdf->SetFont('Arial', 'B', 6.8);
    $this->pdf->Cell(30, 5, number_format($ShoppingOrderInfo['amount'], 2, ',', '.'), 1, 0, 'R');
    $this->pdf->Ln();
    $this->pdf->SetX(10);
    $this->pdf->Cell(90, 5, utf8_decode('OBSERVACIONES'), 1, 0, 'C');
    $this->pdf->Ln();
    $y = $this->pdf->GetY();
    $this->pdf->Rect(10, $y, 90, 35);
    $this->pdf->MultiCell(90, 3.5, utf8_decode(''), '', 'L', false);
  }
}
