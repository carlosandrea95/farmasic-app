<?php
class PDF_Psychotropic extends PDF
{
   public $OrderId;
   private $page_limiter = 20, $limit_sup;
   private $num_page = 1;
   private $limit_inf = 0;
   private $pdf;
   private $nb_page;

   public function __construct()
   {
      $this->pdf = new PDF();
      $this->nb_page = Orders::getPDFLinesPerPage(Tools::getValue('id'), $this->page_limiter);
      $this->limit_sup = $this->page_limiter;
      while ($this->num_page <= $this->nb_page) {
         $this->pdf->AddPage();
         $this->Header();
         $this->lines_header();
         $line = Orders::getPDFOrderLines(Tools::getValue('id'), $this->limit_inf, $this->limit_sup);
         for ($i = 0; $i < $this->page_limiter; $i++) {
            if (isset($line[$i])) {
               $this->pdf->Cell(40, 5, utf8_decode($line[$i]['code']), 1, 0, 'C');
               $this->pdf->Cell(70, 5, utf8_decode(strtoupper($line[$i]['name'])), 1, 0, 'L');
               $this->pdf->Cell(40, 5, utf8_decode($line[$i]['quantity']), 1, 0, 'C');
               $this->pdf->Cell(40, 5, utf8_decode($line[$i]['units']), 1, 0, 'C');
               $this->pdf->Ln();
            } else {
               $this->pdf->Cell(40, 5, '', 1, 0, 'C');
               $this->pdf->Cell(70, 5, '', 1, 0, 'L');
               $this->pdf->Cell(40, 5, '', 1, 0, 'C');
               $this->pdf->Cell(40, 5, '', 1, 0, 'C');
               $this->pdf->Ln();
            }
         }
         $this->Footer();
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

   public function Header()
   {
      $this->pdf->SetFont('Arial', 'B', 6.8);
      $this->pdf->SetXY(50, 5);
      $this->pdf->Cell(95, 3, utf8_decode('CONTRALORÍA  REGENCIA'), 1, 0, 'C');
      $this->pdf->Rect(10, 5, 40, 25);
      $this->pdf->Image(IMG_URI . 'tools/logo_drovaz.png', 12.5, 11.5, 35);
      $this->pdf->SetXY(50, 8);
      $this->pdf->Cell(45, 22, utf8_decode('FORMATO PSICOTRÓPICOS'), 1, 0, 'C');
      $this->pdf->SetXY(95, 8);
      $this->pdf->Cell(25, 5, 'NRO. SOLICITUD', 'TR', 0, 'C');
      $this->pdf->SetXY(95, 13);
      $this->pdf->SetFont('Arial', '', 7.5);
      $id = Orders::getCurrentIdOrder();
      $this->pdf->Cell(25, 17, str_pad(Orders::getCurrentIdOrder(), 6, '0', STR_PAD_LEFT), 'TBR', 0, 'C');
      $this->pdf->SetXY(120, 8);
      $this->pdf->SetFont('Arial', 'B', 6.8);
      $this->pdf->MultiCell(25, 2.5, 'NUMERO DE PERMISO', 'TBR', 'C');
      $this->pdf->Rect(120, 13, 25, 17);
      $this->pdf->SetXY(145, 5);
      $this->pdf->Cell(55, 4, 'AREA DE ESTAMPILLA', 'TR', 0, 'C');
      $this->pdf->Rect(145, 8, 55, 22);
      $this->pdf->SetXY(10, 30);
      $this->pdf->SetFont('Arial', '', 6.8);
      $this->pdf->MultiCell(135, 2.5, utf8_decode('Me dirijo a Usted, a fin tramitar la solicitud de Permiso Sanitario (compra-venta) de Sustancias Psicotrópicas ante el Servicio Autónomo de Contraloría Sanitaria (M.P.P.S), establecido en el artículo 59 de la Ley Orgánica de Drogas G.O 39546 del 05/11/2010'), 'BL', 'L');
      $this->pdf->SetXY(145, 30);
      $this->pdf->SetFont('Arial', 'B', 6.8);
      $this->pdf->Cell(55, 3, 'FECHA SOLICITUD', 1, 0, 'C');
      $this->pdf->SetXY(145, 33);
      $orderInfo = Orders::getPDFInvoiceInfo(Tools::getValue('id'));
      $champ_date = date_create($orderInfo['created_at']);
      $date_fact = date_format($champ_date, 'd/m/Y');
      $this->pdf->Cell(55, 4.5, $date_fact, 1, 0, 'C');
   }
   public function addLines($lines)
   {
      $this->lines_header();
      for ($i = 1; $i <= $lines; $i++) {
         if ($i % 20) {
            $this->addLine($i);
         } else {
            $this->pdf->AddPage();
         }
      }
   }
   public function addLine($i)
   {
      $this->pdf->Cell(40, 5, $i, 1, 0, 'C');
      $this->pdf->Cell(70, 5, '', 1, 0, 'L');
      $this->pdf->Cell(40, 5, '', 1, 0, 'C');
      $this->pdf->Cell(40, 5, '', 1, 0, 'C');
      $this->pdf->Ln();
   }
   public function lines_header()
   {
      $this->pdf->SetY(37.5);
      $this->pdf->AliasNbPages();
      $this->pdf->SetFont('Arial', 'B', 7);
      $this->pdf->Cell(40, 3.5, utf8_decode('CÓDIGO PRODUCTO'), 1, 0, 'C');
      $this->pdf->Cell(70, 3.5, utf8_decode('DESCRIPCIÓN DEL PRODUCTO'), 1, 0, 'C');
      $this->pdf->Cell(40, 3.5, 'CANTIDAD CAJA', 1, 0, 'C');
      $this->pdf->Cell(40, 3.5, utf8_decode('UNIDADES POSOLÓGICAS'), 1, 0, 'C');
      $this->pdf->Ln();
      $this->pdf->SetFont('Arial', '', 7.5);
   }
   public function lines_test()
   {

      for ($i = 1; $i <= 20; $i++) {
         $this->pdf->Cell(40, 5, $i, 1, 0, 'C');
         $this->pdf->Cell(70, 5, '', 1, 0, 'L');
         $this->pdf->Cell(40, 5, '', 1, 0, 'C');
         $this->pdf->Cell(40, 5, '', 1, 0, 'C');
         $this->pdf->Ln();
      }
   }
   function Footer()
   {
      $clientInfo = Orders::getPDFClientInfo(Tools::getValue('id'));
      $this->pdf->SetFont('Arial', 'B', 6.8);
      $this->pdf->Cell(190, 8, utf8_decode('DATOS DEL ESTABLECIMIENTO FARMACÉUTICO (Cliente)'), 1, 0, 'C');
      $this->pdf->Ln();
      $this->pdf->SetFont('Arial', 'B', 6.8);
      $this->pdf->Cell(40, 5, utf8_decode('CÓDIGO CLIENTE'), 1, 0, 'C');
      $this->pdf->Cell(95, 5, utf8_decode('NOMBRE DEL ESTABLECIMIENTO FARMACÉUTICO'), 1, 0, 'C');
      $this->pdf->Cell(55, 5, utf8_decode('TELÉFONO'), 1, 0, 'C');
      $this->pdf->Ln();
      $this->pdf->Cell(40, 8, $clientInfo['code'], 1, 0, 'C');
      $this->pdf->Cell(95, 8, $clientInfo['name'], 1, 0, 'C');
      $this->pdf->Cell(55, 8, $clientInfo['phone'], 1, 0, 'C');
      $this->pdf->Ln();
      $this->pdf->Cell(110, 5, utf8_decode('UBICACIÓN'), 1, 0, 'C');
      $this->pdf->Cell(25, 5, 'ESTADO', 1, 0, 'C');
      $this->pdf->MultiCell(55, 2.5, utf8_decode('SELLO DEL ESTABLECIMIENTO FARMACÉUTICO'), 1, 'C');
      $this->pdf->Cell(110, 10, $clientInfo['address'], 1, 0, 'L');
      $this->pdf->Cell(25, 10, $clientInfo['state'], 1, 0, 'C');
      $this->pdf->Cell(55, 10, '', 'R', 0, 'C');
      $this->pdf->Ln();
      $this->pdf->Cell(45, 3.5, 'NOMBRE DEL REGENTE', 1, 0, 'C');
      $this->pdf->Cell(45, 3.5, 'FIRMA DEL REGENTE', 1, 0, 'C');
      $this->pdf->Cell(45, 3.5, 'C.I.', 1, 0, 'C');
      $this->pdf->Cell(55, 3.5, '', 'R', 0, 'C');
      $this->pdf->Ln();
      $this->pdf->Cell(45, 8, '', 1, 0, 'C');
      $this->pdf->Cell(45, 8, '', 1, 0, 'C');
      $this->pdf->Cell(45, 8, '', 1, 0, 'C');
      $this->pdf->Cell(55, 8, '', 'R', 0, 'C');
      $this->pdf->Ln();
      $this->pdf->Cell(45, 3.5, 'MATRICULA M.P.P.S', 1, 0, 'C');
      $this->pdf->Cell(45, 3.5, 'COLFAR', 1, 0, 'C');
      $this->pdf->Cell(45, 3.5, 'IMPREFAR', 1, 0, 'C');
      $this->pdf->Cell(55, 3.5, '', 'R', 0, 'C');
      $this->pdf->Ln();
      $this->pdf->Cell(45, 8, '', 1, 0, 'C');
      $this->pdf->Cell(45, 8, '', 1, 0, 'C');
      $this->pdf->Cell(45, 8, '', 1, 0, 'C');
      $this->pdf->Cell(55, 8, '', 'BR', 0, 'C');
      $this->pdf->Ln();
      $this->pdf->Cell(190, 8, utf8_decode('SOLO PARA SER RELLENADO POR DROVAZCA'), 1, 0, 'C');
      $this->pdf->Ln();
      $this->pdf->Cell(45, 5, 'FIRMA DEL REGENTE DE DROVAZCA', 1, 0, 'C');
      $this->pdf->Cell(45, 5, 'SELLO DEL REGENTE DE DROVAZCA', 1, 0, 'C');
      $this->pdf->Cell(45, 5, 'SEDE', 1, 0, 'C');
      $this->pdf->Cell(55, 5, utf8_decode('SELLO DE DROGARÍA DROVAZCA'), 1, 0, 'C');
      $this->pdf->Ln();
      $this->pdf->Cell(45, 15, '', 1, 0, 'C');
      $this->pdf->Cell(45, 15, '', 1, 0, 'C');
      $this->pdf->Cell(45, 15, '', 1, 0, 'C');
      $this->pdf->Cell(55, 15, '', 1, 0, 'C');
      $this->pdf->Ln();
      $this->pdf->Cell(45, 5, 'RECIBIDO POR', 1, 0, 'C');
      $this->pdf->Cell(45, 5, 'FECHA RECIBIDO', 1, 0, 'C');
      $this->pdf->Cell(45, 5, 'INCLUIDO POR', 1, 0, 'C');
      $this->pdf->Cell(55, 5, 'FECHA INCLUIDO', 1, 0, 'C');
      $this->pdf->Ln();
      $this->pdf->Cell(45, 8, '', 1, 0, 'C');
      $this->pdf->Cell(45, 8, '', 1, 0, 'C');
      $this->pdf->Cell(45, 8, '', 1, 0, 'C');
      $this->pdf->Cell(55, 8, '', 1, 0, 'C');
      $this->pdf->Ln();
      $this->pdf->Cell(45, 5, 'ACLARAR DUDAS', 1, 0, 'C');
      $this->pdf->Cell(145, 5, utf8_decode('OPCIONES DE ENVIÓ DE TU SOLICITUD DE PSICOTRÓPICOS IMPRESA ORIGINAL + RECAUDOS'), 1, 0, 'C');
      $this->pdf->Ln();
      $this->pdf->Cell(45, 12, $this->pdf->Image(IMG_URI . 'icons/phone.png', $this->pdf->GetX() + 19, $this->pdf->GetY() + 2.5, 7), 'LTR');
      $this->pdf->Cell(45, 12, $this->pdf->Image(IMG_URI . 'icons/truck.png', $this->pdf->GetX() + 19, $this->pdf->GetY() + 2.5, 7), 'LTR');
      $this->pdf->Cell(100, 12, $this->pdf->Image(IMG_URI . 'icons/envelop.png', $this->pdf->GetX() + 45, $this->pdf->GetY() + 2.5, 7), 'LTR');
      $this->pdf->Ln();
      $this->pdf->Cell(45, 5, 'NUMERO DE CONTACTO', 'LR', 0, 'C');
      $this->pdf->Cell(45, 5, 'TRANSPORTE DROVAZCA', 'LR', 0, 'C');
      $this->pdf->Cell(100, 5, utf8_decode('ENVIÓ POR CORREO ELECTRÓNICO'), 'LR', 0, 'C');
      $this->pdf->Ln();
      $this->pdf->Cell(45, 10, '0251 - 0212',  'LBR', 0, 'C');
      // $this->pdf->SetXY(55, 263);
      $this->pdf->SetX(55);
      $this->pdf->MultiCell(45, 2.5, utf8_decode('Estimado Farmacéutico: Escribe en el documento Relación de entrega de mercancía (REM) que consignas una solicitud de psicotrópicos'), 'LRB', 'C', false);
      // $this->pdf->SetXY(100, 262);
      $y = $this->pdf->GetY();
      $this->pdf->SetXY(100, $y - 11);
      $this->pdf->Cell(100, 3.5, 'drovazca@gmail - info@drovaz.com', 'LR', 0, 'C');
      $this->pdf->Ln();
      // $this->pdf->SetXY(100, 265.5);
      $y = $this->pdf->GetY();
      $this->pdf->SetXY(100, $y);
      $this->pdf->MultiCell(100, 2.5, utf8_decode('Estimado Farmacéutico: envía la solicitud de compra de psicotrópicos + recaudos en formato PDF (relación mensual, permiso de funcionamiento, copia de la cédula de identidad, titulo del farmacéutico)'), 'LRB', 'C');
   }
   public function print()
   {
      $this->pdf->Output('I', utf8_decode('FORMATO_PSICOTRÓPICOS.pdf'));
   }
   public function preview()
   {
      $this->pdf->Output();
   }
}
