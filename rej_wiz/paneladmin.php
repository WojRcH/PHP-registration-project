<?php
include './bazamysqli.php';
$polaczenie = new mysqli(HOST,DB_USER,DB_PASSWORD,DB_NAME);

if(isset($_POST['nazw'])) 
$nazwisko = $_POST['nazw'];
if(isset($_POST['imie']))
$imie=$_POST['imie'];
if(isset($_POST['specj'])){
    $specj = ($_POST['specj']);
    if(mysqli_connect_error()){
			
        die('Brak polaczenia('.mysqli_connect_erno().')'.mysqli());
    }else {
        $INSERT= "INSERT INTO lekarze (Nazwisko,Imie,Specjalizacja) values(?,?,?)";
        $stmt = $polaczenie->prepare($INSERT);
				$stmt->bind_param("sss",$nazwisko,$imie,$specj);
                $stmt->execute();
                echo "Dodano pomyślnie lekarza!";
    }
}

if(isset($_POST['nr_sal'])) 
$nr_sal = ($_POST['nr_sal']);
if(isset($_POST['nr_pietr'])) 
$nr_pietr = ($_POST['nr_pietr']);
if(isset($_POST['nr_bud'])) 
$nr_bud = ($_POST['nr_bud']);
if(isset($_POST['specj_sal'])){
    $specj_sal = ($_POST['specj_sal']);
    if(mysqli_connect_error()){
			
        die('Brak polaczenia('.mysqli_connect_erno().')'.mysqli());
    }else {
        $INSERT= "INSERT INTO sale (nr_sali,pietro,nr_budynku,specj_sali) values(?,?,?,?)";
        $stmt = $polaczenie->prepare($INSERT);
				$stmt->bind_param("iiis",$nr_sal,$nr_pietr,$nr_bud,$specj_sal);
                $stmt->execute();
                echo "Dodano pomyślnie salę!";
    }
}

 
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="utf-8" />
    <title>Klinika rehabilitacji-panel admin</title>
</head>
<body>
Dodaj lekarzy
<form action="paneladmin.php" method="POST">
<table>
<tr><td>Nazwisko: </td><td><input type="text" name="nazw" required/></td></tr>
<tr><td>Imię: </td><td><input type="text" name="imie" required/></td></tr>
<tr><td>Specjalizacja: </td><td><input type="text" name="specj" required/></td></tr>
<tr><td><input type="submit" value="Dodaj"/></td></tr>
</table>
</form>
Dodaj sale
<form action="paneladmin.php" method="POST">
<table>
<tr><td>Numer sali: </td><td><input type="text" name="nr_sal" required/></td></tr>
<tr><td>Piętro: </td><td><input type="text" name="nr_pietr" required/></td></tr>
<tr><td>Numer budynku: </td><td><input type="text" name="nr_bud" required/></td></tr>
<tr><td>Specjalizacja sali: </td><td><input type="text" name="specj_sal" required/></td></tr>
<tr><td><input type="submit" value="Dodaj"/></td></tr>
</table>
</form>
<a href="wyloguj.php">Wyloguj</a>
</body>
</html>