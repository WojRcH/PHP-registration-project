<?php
session_start();
include './bazamysqli.php';
$polaczenie = new mysqli(HOST,DB_USER,DB_PASSWORD,DB_NAME);
$id_pacjent=$_SESSION['ID_uzytkownika'];
$SELECT ="SELECT id_lekarz,id_sala,Data_zabiegu from zabiegi where id_pacjent=".$id_pacjent;
$ciag="Zabiegi: ";
if($result = $polaczenie->query($SELECT))
{
    if($result->num_rows)
    {
        while($row=$result->fetch_object())
        {
            $ciag.="Lekarz: ".$row->id_lekarz." Sala: ".$row->id_sala." Data i czas zabiegu: ".$row->Data_zabiegu;                     
            
        }
        $result->free();
    }
}
$fp = fopen("zabiegi.txt", "w");
fputs($fp, $ciag);
fclose($fp);
echo "Zapisano pomyślnie!";
echo "<a href='rezerwuj.php'>   Wróć do panelu użytkownika</a>";
?>