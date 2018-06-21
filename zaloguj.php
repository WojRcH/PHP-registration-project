	<?php 

session_start();
include './baza.php';
$baza=new PDO(DSN, UZYTKOWNIK, HASLO);

if(isset($_POST['login'])) 
	$login = $_POST['login'];
if(isset($_POST['haslo'])) {
	$haslo = sha1($_POST['haslo']);
	echo sha1($_POST['haslo']);
}

$sql = 'select * from pacjenci where login=? and haslo=?';
$zapytanie=$baza->prepare($sql);
$zapytanie->execute([$login, $haslo]);

$ilosc_rekordow=$zapytanie->rowCount();
if ($ilosc_rekordow==1) {
	$dane=$zapytanie->fetch();
	echo 'Zalogowano poprawnie'; 
	$_SESSION['zalogowany']=true;
	$_SESSION['nazwa_uzytkownika']=$dane['Imie'];
	$_SESSION['ID_uzytkownika']=$dane['ID'];
	if($login=='admin')
	{
		header('Location:paneladmin.php');	
	}
	else header('Location:rezerwuj.php');		
}
else {
	echo 'Błąd logowania'; 
	echo '<a href="'.$_SERVER['HTTP_REFERER'].'">Powrót do panelu logowania</a>'; 
}






?>