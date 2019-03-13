<?php
/*
 *  Funkcje do panelu pracownika
 */

// Sprawdza, czy ktoś przypadkiem aby nie przetwarza zamowienia
// zwraca true, jeśli jest przetwarzanie
// zwraca false, jeśli nic nie jest przetwarzane
function czy_przetwarza($id_usera)
{
$db_host = "localhost";
$db_name = "fabryka";
$db_user = "root";
$db_pass = "";


$conn = new mysqli($db_host, $db_user, $db_pass, $db_name);
    // musimy sprawdzić, czy w tabeli 'sprzedaz' ktoś nie nadał polu 'potwierdzenie' wartosci "czeka"
    // jeśli tak, to sprawdzamy, czy to ten user. Jeśli to ten user, to przepuszczamy dalej
    // w przeciwnym wypadku nie przepuszczamy i wyświetlamy komunikat o przetwarzaniu danych
    
    // mądre zapytanie SQL powinno wszystko ładnie rozjaśnić co i jak
    $wynik = $conn->query("SELECT * FROM sprzedaz GROUP BY id_zamowienia HAVING potwierdzenie='czeka' ") or die ("Zdechłem na zawał przetwarzania");
    if (mysqli_num_rows($wynik) > 0)
    {   // jeśli znaleźliśmy kogoś, kto przetwara zamowienie i to nie my to zwracamy false
        return FALSE;
    }
    else if (mysqli_num_rows($wynik) == 0)
    {   // w przeciwnym wypadku zwracamy true, bo nikt nie przetwarza
        return TRUE;
    }
}

// funkcja sprawdza czy dany uzytkownik niczego nie przetwarza. 
// jeśli tak (przetwarza), zwraca true
// w przeciwnym wypadku zwraca false
function czy_ja_cos_przetwarzam($id_usera)
{
$db_host = "localhost";
$db_name = "fabryka";
$db_user = "root";
$db_pass = "";


$conn = new mysqli($db_host, $db_user, $db_pass, $db_name);

    $wynik = $conn->query("SELECT * FROM sprzedaz GROUP BY id_zamowienia HAVING potwierdzenie='czeka' ") or die ("Zdechłem na zawał przetwarzania");
    if (mysqli_num_rows($wynik) > 0)
    {   // jeśli nasz uzytkownik przetwarza zamowienie, zwracamy true
        return TRUE;
    }
    else if (mysqli_num_rows($wynik) == 0)
    {   // w przeciwnym wypadku zwracamy false, jeśli nic nie przetwarzamy
        return FALSE;
    }
}

// funkcja sprawdza, czy jest tyle towaru w sklepie/magazynie
// zwraca true, jeśli starcza
// zwraca false, jeśli towaru braknie
// $ilosc to wymagana ilosc, ile chcemy zabrac ze sklepu
function czy_starcza_towaru($id_produktu, $ilosc)
{
$db_host = "localhost";
$db_name = "fabryka";
$db_user = "root";
$db_pass = "";


$conn = new mysqli($db_host, $db_user, $db_pass, $db_name);

    $wynik =$conn->query("SELECT * FROM product WHERE id_produktu={$id_produktu}");
    while($gg = mysqli_fetch_array($wynik,MYSQLI_ASSOC))
    {   // jesli ilość towaru w magazynie jest mniejsza niz ilość towaru
        if ($gg['ilosc'] < $ilosc) return FALSE;
        else return TRUE;
    }
}

// zwraca ilość danego produktu w bazie
function sprawdz_ilosc_produktu_w_bazie($id_produktu)
{   
$db_host = "localhost";
$db_name = "fabryka";
$db_user = "root";
$db_pass = "";


$conn = new mysqli($db_host, $db_user, $db_pass, $db_name);
// pobieramy odpowiedni produkt z bazy
    $wynik = $conn->query("SELECT * FROM `product` WHERE id_produktu={$id_produktu}");
    while($r = mysqli_fetch_array($wynik,MYSQLI_ASSOC)) 
    {   // przypisujemy ilość produktu do zmiennej ilosc
        $ilosc = $r['ilosc'];
        return $ilosc;
    }
}

//zwraca ilosc danego skladnika w magazynie
function sprawdz_ilosc_skladnika_w_magazynie($id_sklad)
{   
$db_host = "localhost";
$db_name = "fabryka";
$db_user = "root";
$db_pass = "";


$conn = new mysqli($db_host, $db_user, $db_pass, $db_name);
// pobieramy odpowiedni produkt z bazy
    $wynik = $conn->query("SELECT * FROM `sklad` WHERE id_sklad={$id_sklad}");
    while($r = mysqli_fetch_array($wynik,MYSQLI_ASSOC)) 
    {   // przypisujemy ilość produktu do zmiennej ilosc
        $ilosc = $r['ilosc'];
        return $ilosc;
    }
}

function dostawa($id_sklad,$dod)
{   
$db_host = "localhost";
$db_name = "fabryka";
$db_user = "root";
$db_pass = "";


$conn = new mysqli($db_host, $db_user, $db_pass, $db_name);
// pobieramy odpowiedni produkt z bazy
    $wynik = $conn->query("SELECT * FROM `sklad` WHERE id_sklad={$id_sklad}");
    while($r = mysqli_fetch_array($wynik,MYSQLI_ASSOC)) 
    {   // przypisujemy ilość produktu do zmiennej ilosc
        $ilosc = $r['ilosc'];
    }
	$magazyn=$ilosc+$dod;
	$wynik2 = $conn->query("UPDATE `sklad` SET `ilosc` = '{$magazyn}' WHERE id_sklad={$id_sklad}");
}

function dodaj_sklad($id_sklad,$dod,$ile)
{   
$db_host = "localhost";
$db_name = "fabryka";
$db_user = "root";
$db_pass = "";


$conn = new mysqli($db_host, $db_user, $db_pass, $db_name);
// pobieramy odpowiedni produkt z bazy
    $wynik = $conn->query("SELECT * FROM `sklad` WHERE id_sklad={$id_sklad}");
    while($r = mysqli_fetch_array($wynik,MYSQLI_ASSOC)) 
    {   // przypisujemy ilość produktu do zmiennej ilosc
        $ilosc = $r['ilosc'];
    }
	$magazyn=$ilosc-($dod*$ile);
	$wynik2 = $conn->query("UPDATE `sklad` SET `ilosc` = '{$magazyn}' WHERE id_sklad={$id_sklad}");
}


function ile_do($miejsc)
{   
$db_host = "localhost";
$db_name = "fabryka";
$db_user = "root";
$db_pass = "";

$ilosci=0;
$conn = new mysqli($db_host, $db_user, $db_pass, $db_name);
// pobieramy odpowiedni produkt z bazy
    $wynik = $conn->query("SELECT * FROM `sprzedaz` HAVING miejscowosc='{$miejsc}'");
    while($r = mysqli_fetch_array($wynik,MYSQLI_ASSOC)) 
    {   // przypisujemy ilość produktu do zmiennej ilosc
       $ilosci = $ilosci+$r['ilosc'];
    }
	return $ilosci;
}
