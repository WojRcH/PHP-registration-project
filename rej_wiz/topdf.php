<?php
session_start();
require ('fpdf.php');
include './bazamysqli.php';
$polaczenie = new mysqli(HOST,DB_USER,DB_PASSWORD,DB_NAME);
$id_pacjent=$_SESSION['ID_uzytkownika'];
$SELECT ="SELECT id_lekarz,id_sala,Data_zabiegu from zabiegi where id_pacjent=".$id_pacjent;
$pdf = new FPDF();
$pdf->AddPage('L');
$pdf->SetFont('courier','B',16);
$pdf->Cell(0,0,"Zabiegi w klinice",0,1);
$pdf->Cell(0,20,"Pacjent: ".$_SESSION['nazwa_uzytkownika'],0,1);
$pdf->Image('./rehab.png',220,0,90,0,'PNG');
$i=0;
if($result = $polaczenie->query($SELECT))
{
    if($result->num_rows)
    {
        while($row=$result->fetch_object())
        {
            $topdf="Lekarz: ".$row->id_lekarz." Sala: ".$row->id_sala." Data i czas zabiegu: ".$row->Data_zabiegu;
            $i+=5;
            $pdf->Cell(0,$i,$topdf,0,1);
            
            
        }
        $result->free();
    }
}

$pdf-> Output();
?>