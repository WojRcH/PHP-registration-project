<?php
session_start();
echo 'zalogowano poprawnie jako <b>' .$_SESSION['nazwa_uzytkownika']. '</b>';
include './bazamysqli.php';
$polaczenie = new mysqli(HOST,DB_USER,DB_PASSWORD,DB_NAME);

if(isset($_POST['lekarz']))
$lekarz=$_POST['lekarz'];
if(isset($_POST['sala']))
$sala=$_POST['sala'];
if(isset($_POST['data']))
{
    $data=$_POST['data'];
    $id_pacjent=$_SESSION['ID_uzytkownika'];
    $INSERT= "INSERT INTO zabiegi (id_pacjent,id_lekarz,id_sala,Data_zabiegu) values(?,?,?,?)";
    $stmt = $polaczenie->prepare($INSERT);
	$stmt->bind_param("iiis",$id_pacjent,$lekarz,$sala,$data);
    $stmt->execute();
    echo "wizyta umowiona!";
}
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="utf-8" />
    <title>Rezerwuj wizytę!</title>
    <link rel="stylesheet" type="text/css" href="stylesheet2.css">
</head>
<body>
<form action ="rezerwuj.php" method ="POST">
<table>
<tr>
<td>
Lekarz: 
</td>
<td>
<?php
$SELECT = "SELECT ID,Nazwisko FROM lekarze";
$combo1="<select name='lekarz'>";
if($result = $polaczenie->query($SELECT))
{
    if($result->num_rows)
    {
        while($row=$result->fetch_object())
        {
            $combo1.="<option value='".$row->ID."'>".$row->Nazwisko."</option>";
        }
        $result->free();
    }
}
$combo1.="</select>";
echo $combo1;
?>
</td>
</tr>
<tr>
<td>
Sala: 
</td>
<td>
<?php
$SELECT = "SELECT ID,nr_sali FROM sale";
$combo1="<select name='sala'>";
if($result = $polaczenie->query($SELECT))
{
    if($result->num_rows)
    {
        while($row=$result->fetch_object())
        {
            $combo1.="<option value='".$row->ID."'>".$row->nr_sali."</option>";
        }
        $result->free();
    }
}
$combo1.="</select>";
echo $combo1;
?>
</td>
</tr>
<tr>
<td>
Data zabiegu:
</td>
<td>
<input name="data" type="datetime-local" required/>
</td>
</tr>
<tr>
<td>    
</td>
<td>
<input type="submit" value="Rezerwuj wizytę"/>
</td>
</tr>
</form>
<a href="zapiszdopliku.php">Zapisz harmonogram zabiegów w pliku txt</a>
<br/>
<a href="topdf.php">Pokaż harmonogram zabiegów w pliku PDF</a>
<br/>
<a href="wyloguj.php">Wyloguj</a>
<br/>
</body>
</html>
