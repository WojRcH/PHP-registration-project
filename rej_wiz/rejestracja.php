<?php
include './bazamysqli.php';
if(isset($_POST['Imie']))
	$Imie=$_POST['Imie'];
if(isset($_POST['Nazwisko']))
	$Nazwisko=$_POST['Nazwisko'];
if(isset($_POST['Data_ur']))
	$Data_ur=$_POST['Data_ur'];
if(isset($_POST['Telefon']))
	$Telefon=$_POST['Telefon'];
if(isset($_POST['Pesel']))
	$Pesel=$_POST['Pesel'];
if(isset($_POST['login']))
	$login=$_POST['login'];
if(isset($_POST['haslo'])){
	$haslo=$_POST['haslo'];

	if(!empty($Imie) && !empty($Nazwisko) && !empty($Data_ur) && !empty($Telefon) && !empty($Pesel) && !empty($login) && !empty($haslo)){ // podwójne zabezpieczenie przed błędem

		$host = "localhost";
		$db_user = "root";
		$db_password = "";
		$db_name = "klinika_rehab";	
		
		$polaczenie = new mysqli(HOST,DB_USER,DB_PASSWORD,DB_NAME);
		
		
		if(mysqli_connect_error()){
			
			die('Brak polaczenia('.mysqli_connect_erno().')'.mysqli());
		}else {
			$SELECT ="SELECT login from pacjenci where login=? Limit 1 ";
			$INSERT= "INSERT INTO pacjenci (Nazwisko,Imie,Data_ur,Telefon,Pesel,login,haslo) values(?,?,?,?,?,?,?)";
			
			$stmt=$polaczenie->prepare($SELECT);//sprawdza liczbe pacjentow o tym samym loginie
			$stmt->bind_param("s",$login);
			$stmt->execute();
			$stmt->bind_result($login);
			$stmt->store_result();
			$rnum=$stmt->num_rows;
			
			if ($rnum==0) {
		  $stmt->close();
		  $stmt = $polaczenie->prepare($INSERT);
				$stmt->bind_param("sssssss",$Nazwisko,$Imie,$Data_ur,$Telefon,$Pesel,$login,$haslo);
				$stmt->execute();
				
				echo "Rejestracja przebiegła pomyślnie!";
				echo "<a href='index.php'>Wróć do ekranu logowania</a>";
			} else{
				echo "Ktoś się już zarejestrował korzystając z tego loginu";
				
			}
			$stmt->close();
			$polaczenie->close();
		}
			 
		}else {			
			echo "Wypełnij wszystkie pola!";			
		}

}
	




?>
<!DOCTYPE HTML>
<html>
<head>
<title>Formularz Rejestracyjny</title>
</head>
<body>
<form action ="rejestracja.php" method ="POST">
<table>
<tr>
<td>Imię: </td>
<td><input type ="text" name = "Imie" required></td>
</tr>
<tr>
<td>Nazwisko: </td>
<td><input type ="text" name = "Nazwisko" required></td>
</tr>

<tr>
<td>Data urodzenia : </td>
<td><input type ="date" name = "Data_ur" required></td>
</tr>

<tr>
<td>Telefon </td>
<td><input type ="phone" name = "Telefon" required></td>
</tr>

<tr>
<td>Pesel: </td>
<td><input type ="text" name = "Pesel" required></td>
</tr>

<tr>
<td>Login: </td>
<td><input type ="text" name = "login" required></td>
</tr>

<tr>
<td>Hasło: </td>
<td><input type ="password" name = "haslo" required></td>
</tr>

 <tr>
 <td></td>
    <td><input type="submit" value="Zarejestruj się!"></td>
   </tr>
</table>
</form>
</body>
</html>
