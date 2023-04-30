<?php
class PDF_Purchase_Orders extends PDF
{
  private $pdf;
  // public $num_solcitud;
  // public $fecha;
  public function __construct()
  {
    $this->pdf = new PDF();
    $this->header();
  }
  public function header()
  {
    $this->pdf->Image('logo_societe.png', 10, 10, 80, 55);

    // n° page en haute à droite
    $this->pdf->SetXY(120, 5);
    $this->pdf->SetFont("Arial", "B", 12);
    // $this->pdf->Cell(160, 8, $num_page . '/' . $nb_page, 0, 0, 'C');

    // n° facture, date echeance et reglement et obs
    // $select = 'select date,numero,mnt_ttc,mnt_ht,mnt_tva,obs,reglement,date_echeance FROM facture where id_facture=' . $var_id_facture;
    // $result = mysqli_query($mysqli, $select)  or die('Erreur SQL : ' . $select . mysqli_connect_error());
    // $row = mysqli_fetch_row($result);
    // mysqli_free_result($result);


    $num_fact = "FACTURE N° " . '000001';
    $this->pdf->SetLineWidth(0.1);
    $this->pdf->SetFillColor(192);
    $this->pdf->Rect(120, 15, 85, 8, "DF");
    $this->pdf->SetXY(120, 15);
    $this->pdf->SetFont("Arial", "B", 12);
    $this->pdf->Cell(85, 8, '000001', 0, 0, 'C');

    // nom du fichier final
    // $nom_file = "fact_" . $annee . '-' . str_pad($row[1], 4, '0', STR_PAD_LEFT) . ".this->pdf";

    // date facture
    // $champ_date = date_create($row[0]);
    // $date_fact = date_format($champ_date, 'd/m/Y');
    $this->pdf->SetFont('Arial', '', 11);
    $this->pdf->SetXY(122, 30);
    $this->pdf->Cell(60, 8, "MA VILLE, le " . 'd/m/Y', 0, 0, '');
  }
}
// nb de page pour le multi-page : 18 lignes
$sql = 'select count(*) FROM ligne_facture where id_facture=' . $var_id_facture;
$result = mysqli_query($mysqli, $sql)  or die('Erreur SQL : ' . $sql . mysqli_connect_error());
$row_client = mysqli_fetch_row($result);
mysqli_free_result($result);
$nb_page = $row_client[0];
$sql = 'select abs(FLOOR(-' . $nb_page . '/18))';
$result = mysqli_query($mysqli, $sql)  or die('Erreur SQL : ' . $sql . mysqli_connect_error());
$row_client = mysqli_fetch_row($result);
mysqli_free_result($result);
$nb_page = $row_client[0];

$num_page = 1;
$limit_inf = 0;
$limit_sup = 18;
