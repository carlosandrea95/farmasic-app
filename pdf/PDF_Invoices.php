<?php

class PDF_Invoices extends PDF
{
  public $OrderId;
  private $pdf;
  private $page_limiter = 30, $limit_sup;
  private $num_page = 1;
  private $limit_inf = 0;
  private $nb_page;

  public function __construct()
  {
    $this->pdf = new PDF();
    $this->nb_page = Orders::getPDFLinesPerPage(Tools::getValue('id'), $this->page_limiter);
    $this->limit_sup = $this->page_limiter;
    while ($this->num_page <= $this->nb_page) {
      $this->pdf->AddPage();
      $this->header();
      $this->lines_header();
      $line = Orders::getPDFOrderLines(Tools::getValue('id'), $this->limit_inf, $this->limit_sup);
      for ($i = 0; $i < $this->page_limiter; $i++) {
        if (isset($line[$i])) {
          if ($i == 0) {
            $this->pdf->Cell(30, 5, $line[$i]['code'], 'TL', 0, 'C');
            $this->pdf->Cell(80, 5, utf8_decode(strtoupper($line[$i]['name'])), 'TLR', 0, 'L');
            $this->pdf->Cell(20, 5, $line[$i]['quantity'], 'TLR', 0, 'C');
            $this->pdf->Cell(30, 5,  number_format($line[$i]['price'], 2, ',', '.'), 'TLR', 0, 'R');
            $this->pdf->Cell(30, 5, number_format($line[$i]['subtotal'], 2, ',', '.'), 'TR', 0, 'R');
            $this->pdf->Ln();
          } else {
            $this->pdf->Cell(30, 5, $line[$i]['code'], 'L', 0, 'C');
            $this->pdf->Cell(80, 5, utf8_decode(strtoupper($line[$i]['name'])), 'LR', 0, 'L');
            $this->pdf->Cell(20, 5, $line[$i]['quantity'], 'LR', 0, 'C');
            $this->pdf->Cell(30, 5,  number_format($line[$i]['price'], 2, ',', '.'), 'LR', 0, 'R');
            $this->pdf->Cell(30, 5, number_format($line[$i]['subtotal'], 2, ',', '.'), 'R', 0, 'R');
            $this->pdf->Ln();
          }
        } else {
          if ($i == ($this->page_limiter - 1)) {
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
      if ($this->num_page == $this->nb_page) {
        $this->Footer();
      }
      if ($this->nb_page > 1) {
        $this->pdf->SetXY(178.5, 1.5);
        $this->pdf->SetFont('Arial', 'B', 7.5);
        $this->pdf->Cell(30, 3.5, utf8_decode('Página ' . $this->num_page . '/' . $this->nb_page), '', 0, 'C');
      }
      $this->num_page++;
      $this->limit_inf = $this->limit_inf + $this->page_limiter;
      $this->limit_sup = $this->limit_inf;
    }
  }
  public function header()
  {

    // LOGO
    $this->pdf->Image(IMG_URI . 'tools/logo_drovaz.png', 10, 10, 70, 20);

    $this->pdf->SetXY(120, 5);
    $this->pdf->SetFont("Arial", "B", 12);

    // DOCUMENT INFO
    $InvoiceInfo = Orders::getPDFInvoiceInfo(Tools::getValue('id'));
    if ($InvoiceInfo['op_invoice_type'] == 'F') {
      $num_fact = "FACTURA DE VENTA No. " . $InvoiceInfo['id'];
    } else {
      $num_fact = "NOTA DE VENTA No. " . $InvoiceInfo['id'];
    }
    $this->pdf->SetLineWidth(0.1);
    $this->pdf->SetFillColor(192);
    $this->pdf->Rect(120, 15, 85, 8, "DF");
    $this->pdf->SetXY(120, 15);
    $this->pdf->SetFont("Arial", "B", 12);
    $this->pdf->Cell(85, 8, $num_fact, 0, 0, 'C');

    $champ_date = date_create($InvoiceInfo['created_at']);
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

    // CLIENT INFO
    $ClientInfo = Orders::getPDFClientInfo(Tools::getValue('id'));
    $this->pdf->SetLineWidth(0.1);
    $this->pdf->SetFillColor(192);
    $y = $this->pdf->GetY();
    $this->pdf->Rect(10, $y + 2, 85, 5, "DF");
    $this->pdf->SetXY(10, $y + 2.1);
    $this->pdf->SetFont("Arial", "B", 8);
    $this->pdf->Cell(85, 5, 'CLIENTE', 0, 0, 'C');
    $this->pdf->Ln();
    $y = $this->pdf->GetY();
    $this->pdf->SetXY(10, $y + 1.5);
    $this->pdf->SetFont("Arial", "B", 7.5);
    $this->pdf->Cell(70, 3, utf8_decode('NOMBRE:' . $ClientInfo['name']), 0, 0, 'J');
    $this->pdf->Ln();
    $this->pdf->MultiCell(70, 3, utf8_decode('DIRECCIÓN:' . $ClientInfo['address']), 0, 'L', false);
    $this->pdf->Cell(70, 3,  utf8_decode('TELÉFONO: ') . $ClientInfo['phone'], 0, 0, 'J');
    $this->pdf->Ln();
    $this->pdf->Cell(70, 3,  utf8_decode('CORREO: ') . $ClientInfo['email'], 0, 0, 'J');
    $this->pdf->Ln();
    $this->pdf->Ln();

    // ORDER INFO
    $OrderInfo = Orders::getPDFOrderInfo(Tools::getValue('id'));
    $champ_date = date_create($OrderInfo['created_at']);
    $date_fact = date_format($champ_date, 'd/m/Y');
    $this->pdf->SetXY(155, 36);
    $this->pdf->SetFont("Arial", "B", 8);
    $this->pdf->Cell(25, 5, utf8_decode('N° DE PEDIDO:'), 0, 0, 'R');
    $this->pdf->Cell(25, 5, utf8_decode('#' . $OrderInfo['id']), 0, 0, 'R');
    $this->pdf->SetXY(155, 39);
    $this->pdf->Cell(25, 5, utf8_decode('FECHA DEL PEDIDO:'), 0, 0, 'R');

    $this->pdf->Cell(25, 5, utf8_decode($date_fact), 0, 0, 'R');
  }
  public function lines_header()
  {
    $this->pdf->SetY(75);
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
    $InvoiceInfo = Orders::getPDFInvoiceInfo(Tools::getValue('id'));
    $taxes = Orders::getPDFInvoiceTaxes(Tools::getValue('id'));
    $this->pdf->SetX(140);
    $this->pdf->SetFont('Arial', '', 9);
    $this->pdf->Cell(30, 5, 'Subtotal', 0, 0, 'R');
    $this->pdf->SetX(170);
    $this->pdf->SetFont('Arial', 'B', 8);
    $this->pdf->Cell(30, 5, 'Bs. ' . number_format($taxes['subtotal'], 2, ',', '.'), 1, 0, 'R');
    $this->pdf->Ln();
    $this->pdf->SetX(140);
    $this->pdf->SetFont('Arial', '', 9);
    $this->pdf->Cell(30, 5, utf8_decode('Descuento'), 0, 0, 'R');
    $this->pdf->SetX(170);
    $this->pdf->SetFont('Arial', 'B', 8);
    $this->pdf->Cell(30, 5, 'Bs. ' . number_format($taxes['discounts'], 2, ',', '.'), 1, 0, 'R');
    $this->pdf->Ln();
    $this->pdf->SetX(140);
    $this->pdf->SetFont('Arial', '', 9);
    $this->pdf->Cell(30, 5, utf8_decode('Impuesto'), 0, 0, 'R');
    $this->pdf->SetX(170);
    $this->pdf->SetFont('Arial', 'B', 8);
    $this->pdf->Cell(30, 5, 'Bs. ' . number_format($taxes['feed'], 2, ',', '.'), 1, 0, 'R');
    $this->pdf->Ln();
    $this->pdf->SetX(140);
    $this->pdf->SetFont('Arial', 'B', 12);
    $this->pdf->Cell(30, 5, 'TOTAL', 0, 0, 'R');
    $this->pdf->SetX(170);
    $this->pdf->SetFont('Arial', 'B', 8);
    $this->pdf->Cell(30, 5, 'Bs. ' . number_format(($InvoiceInfo['amount']), 2, ',', '.'), 1, 0, 'R');
    $this->pdf->Ln();
  }
  public function print()
  {
    $this->pdf->Output();
  }
}
