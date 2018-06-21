<?php
include './baza.php';
try{
    $baza=new PDO(DSN,UZYTKOWNIK,HASLO);
    //echo "Polaczono z baza";
    //$sql='select * from pacjenci';
    //$zapytanie=$baza->prepare($sql);
    //$zapytanie->execute([$id]);
    //$ilosc=$zapytanie->rowCount();
    
}

catch(Exception $ex)
{
    echo "Problem z połączeniem z bazą!";
}
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="utf-8" />
    <title>Klinika rehabilitacji</title>
    <link rel="stylesheet" type="text/css" href="stylesheet.css">
</head>
<body>
<header><h1>Zarezerwuj swoją wizytę w klinice!</h1></header>
<nav>Zaloguj się w celu dokonania rezerwacji
<form action="zaloguj.php" method="POST">
<table>
<tr><td><input type="text" name="login" placeholder="Login" required ></td></tr> 
<tr><td><input type="password" name="haslo" placeholder="Hasło" required></td><td><input type="submit" value="Zaloguj"/></td></tr>
<tr><td>Nie posiadasz konta?</td><td><a href="rejestracja.php">Zarejestruj się!</a></td></tr>
</table>
</form>
</nav>
<article>   
Witaj użytkowniku!<br/>
Jesteśmy firmą zajmująca się rehabilitacją od 10 lat.<br/>
Skorzystaj z naszego serwisu do rezerwacji wizyt w klinice :)</article>
<aside>
<img src="rehab.png" width="500px" heigth="250px"/></aside>
<footer>
    Made by Kamila Ludwig, Wojciech Kochański
</footer>


</body>
</html>