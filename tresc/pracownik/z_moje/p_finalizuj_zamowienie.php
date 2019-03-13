<?php
/*
 * Skrypt, ktory sprawdza parę rzeczy i finaluzje zamówienie
 *  w zależności od podanej zmiennej albo wszystko idzie pomyślnie (tak)
 *  albo wszystko jest blokowane (zablokuj)
 * 
 * Przesyłane dane w GET
 * $_GET['id_zamowienia']
 * $_GET['akcja'] =  tak - potwierdzenie i zatwierdzenie zamowienia
 *                    zablokuj - odrzucenie zamowienia( nadanie mu rangi blocked)
 */
 $db_host = "localhost";
$db_name = "fabryka";
$db_user = "root";
$db_pass = "";


$conn = new mysqli($db_host, $db_user, $db_pass, $db_name);
// jeśli nie zalogowano na pracownika to przerywamy skrypt
if (!$_SESSION['worker'])
{
    return;
}
// sprwadzamy czy podano id zamowienia
if (!isset($_GET['id_zamowienia']) || $_GET['id_zamowienia']=="")
{
    komunikat("Brak podanego id");
    return;
}
// sprawdzamy, czy podano "akcje"
if (!isset($_GET['akcja']) || $_GET['akcja']=="")
{
    komunikat("Brak wybranej akcji");
    return;
}

// zablokowanie zamówienia
if($_GET['akcja']=="zablokuj")
{
    // blokowanie zamówienia
    // nic w bazie z produkatmi nie zmieniamy
    // zamówieniu nadajemy rangę "blocked"

    $zapytanie = "UPDATE `sprzedaz` SET `potwierdzenie` = 'blocked' WHERE `id_zamowienia`='{$_GET['id_zamowienia']}'";
    $idzapytania = $conn->query($zapytanie) or die ("Nie da rady anulowac zamowienia. Blad bazy");
    
    // przekierowanie na stronę z komunikatami
    header("Location: headw.php?v=tresc/pracownik/zadania&prawa=tresc/pracownik/z_stare/p_dane_zamowienie&stan=blocked&id_zamowienia={$_GET['id_zamowienia']}&komunikat=tak");
    return;
    
}

// prawidłowe sfinalizowanie zamówienia
// najpierw zmieniamy ilość produktów w magazynie (tabela produkty)
// następnie zmieniamy status zamówienia 
if($_GET['akcja']=="tak")
{
    // TRASAKCJA!!! - start
    $conn->query("START TRANSACTION");
 
    // aktualizacja ilości produktu w bazie
    // przechodzimy przez każdy wpis w ZAMÓWIENIU
    $wynik = $conn->query("SELECT * FROM sprzedaz WHERE id_zamowienia={$_GET['id_zamowienia']}");
    while($gg = mysqli_fetch_array($wynik,MYSQLI_ASSOC))
    {   // następnie aktualizujemy każdy wpis  w tabeli PRODUKTY (w magazynie)
        // obliczenie nowej ilości
        $ilosc_w_magazynie = sprawdz_ilosc_produktu_w_bazie($gg['id_produktu']); // pobranie ilości produktu w bazie
        $nowa_ilosc_produktu = $ilosc_w_magazynie-$gg['ilosc']; // obliczenie nowej ilości w bazie
        if ($nowa_ilosc_produktu<0) // jeśli nowa ilość jest na minusie (choć nie powinno tak być), to przerywamy
        {
            komunikat("Wystąpił błąd, nie ma tylu produktów w magazynie. Skrypt przerwany, transakcja nie przebiegła pomyślnie, zmiany nie zostały zapisane", "danger");
            return;
        }
        // jeśli wszystko idzie zgodnie z planem, zmieniamy ilość produktu naszego w magazynie
        $zapytanie = "UPDATE `product` SET `ilosc` = '{$nowa_ilosc_produktu}' WHERE `id_produktu`='{$gg['id_produktu']}'";
        $idzapytania = $conn->query($zapytanie) or die ("Nie da rady zmienic ilosci. Blad bazy");
    }
    
    // nadanie zamówieniu rangi "tak", bo udało się je poprawnie zfinalozować
    $zapytanie = "UPDATE `sprzedaz` SET `potwierdzenie` = 'tak' WHERE `id_zamowienia`='{$_GET['id_zamowienia']}'";
    $idzapytania = $conn->query($zapytanie) or die ("Nie da rady przeniesc zamowienia. Blad bazy");
    
    // TRASAKCJA!!! - stop
   $conn->query("COMMIT");
    
    // przekierowanie na stronę z komunikatami
    header("Location: headw.php?v=tresc/pracownik/zadania&prawa=tresc/pracownik/z_stare/p_dane_zamowienie&stan=tak&id_zamowienia={$_GET['id_zamowienia']}&komunikat=tak");
    return;
}