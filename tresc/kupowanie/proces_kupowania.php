<?php
require_once("funkcje/f_panel_pracownika.php");
/*
 * plik stand-alone. "robi kupowanie", następnie przekierowuje do strony z potwierdzeniem.
 * 
 * Klient kupując tylko "rezerwuje". Liczba na magazynie się nie zmienia, 
 * tylko jest dodawany wpis do kupowanych
 */

 $db_host = "localhost";
$db_name = "fabryka";
$db_user = "root";
$db_pass = "";


$conn = new mysqli($db_host, $db_user, $db_pass, $db_name);

// Sprawdzamy, czy istenieje koszyczek
if(!isset($_SESSION['koszyk']) || @$_SESSION['koszyk'][0]['id_produktu']=="")
{
    // koszyk pusty? Oooo! To tragedia. Przekierowywujemy na do potwierdzenia i wyświetlamy errory
    header("Location: index.php?v=tresc/kupowanie/rozrachunek&komunikat=pusty_koszyk");
    return;
}
// sprawedzamy, czy user na pewno zalogowany. Jeśli nie to "kopas w dupas and smile at face".
if (!$_SESSION['user'])
{
    header("Location: index.php?v=tresc/kupowanie/rozrachunek&komunikat=nie_zalogowano");
    return;
}

$id_zamowienia = time() + (7 * 24 * 60 * 60);  // numer zamówienia to timestamp
$data = date("Y-m-d"); // data do wpisania do bazy

// TRASAKCJA!!! - start
 $conn->query("START TRANSACTION");

// dodawanie wpisu do bazy danych
 for($i = 0; $i<sprawdz_liczbe_w_koszyku(); $i++)
{
	$wyniki = $conn->query("SELECT * FROM users WHERE id={$_SESSION['user']}");
    $gg = mysqli_fetch_array($wyniki,MYSQLI_ASSOC);

    $przedmiot = $_SESSION['koszyk'][$i]; // przypisanie kawałka tablicy do zmiennej, by wygodniej operować

	//modul okreslania pracownika
	$ile = $przedmiot['ilosc'];
	$prod = $przedmiot['id_produktu'];
	if($prod == "1" ){
		$pracownik=1;
		dodaj_sklad(1,300,$ile); //miazga kakaowa
		dodaj_sklad(2,200,$ile); //cukier
		dodaj_sklad(3,100,$ile); //lecytyna
	}
	elseif($prod == "2" ){
		$pracownik=1;
		dodaj_sklad(1,300,$ile); //miazga kakaowa
		dodaj_sklad(2,200,$ile); //cukier
		dodaj_sklad(3,100,$ile); //lecytyna
		dodaj_sklad(6,400,$ile); //kokos
	}
	elseif($prod == "3" ){
		$pracownik=1;
		dodaj_sklad(1,300,$ile); //miazga kakaowa
		dodaj_sklad(2,200,$ile); //cukier
		dodaj_sklad(3,100,$ile); //lecytyna
	}
	elseif($prod == "4" ){
		$pracownik=2;
		dodaj_sklad(1,300,$ile); //miazga kakaowa
		dodaj_sklad(2,200,$ile); //cukier
		dodaj_sklad(3,100,$ile); //lecytyna
	}
	elseif($prod == "5" ){
		$pracownik=2;
		dodaj_sklad(1,300,$ile); //miazga kakaowa
		dodaj_sklad(2,200,$ile); //cukier
		dodaj_sklad(3,100,$ile); //lecytyna
		dodaj_sklad(4,400,$ile); //orzechy
	}
	elseif($prod == "6" ){
		$pracownik=3;
		dodaj_sklad(1,300,$ile); //miazga kakaowa
		dodaj_sklad(2,200,$ile); //cukier
		dodaj_sklad(3,100,$ile); //lecytyna
		dodaj_sklad(4,400,$ile); //orzechy
	}
	elseif($prod == "7" ){
		$pracownik=3;
		dodaj_sklad(1,300,$ile); //miazga kakaowa
		dodaj_sklad(2,200,$ile); //cukier
		dodaj_sklad(3,100,$ile); //lecytyna
	}
    $zapytanie = "INSERT INTO `sprzedaz` (`id_zamowienia`, `id_uzytkownika`, `id_produktu`, `ilosc` , `data`, `typ_wysylki`, `potwierdzenie`,`idWORKER`, `miejscowosc`) "
            . "VALUES ('{$id_zamowienia}', '{$_SESSION['user']}', '{$przedmiot['id_produktu']}', '{$przedmiot['ilosc']}', '{$data}', 'kurier', 'nowy','{$pracownik}', '{$gg['adres']}')";
    // dodanie zapytania do bazy
    $idzapytania = $conn->query($zapytanie) or die ("bleeee eeee");    
}
     
// TRASAKCJA!!! - stop
 $conn->query("COMMIT");

// usunięcie koszyka
usun_koszyk();
// przekierowanie do strony o potwiedzeniu
header("Location: index.php?v=tresc/kupowanie/rozrachunek&komunikat=ok");
    
