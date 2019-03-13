<?php
/*
 *  Skrypt wyświetla dane zamówienie (szczegóły)
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
// sprawdzamy, czy chchemy wykonać jakąś akcję. Jeśli nie ma zniennej akcja, to znaczy że nie. Więc tylko wyświetlamy
if (!isset($_GET['akcja']) || $_GET['akcja']=="")
{
    $tytul = "Tylko do odczytu";
    $przycisk=FALSE;
}
// w przeciwnym wypadku
else if (isset($_GET['akcja']) && $_GET['akcja']!="")
{
    $tytul = "Zarządzanie";
    $przycisk = TRUE;
}
    
// sprawdzamy, czy jest wysłane tak i dodajemy danego pracownika do zarządzania zamówieniem
if (isset($_GET['akcja']) && $_GET['akcja']=="wez")
{
    if (isset($_GET['potwierdzenie']) && $_GET['potwierdzenie']=="tak")
    {
        // dodajemy pracownika do tego zamowienia
        $zapytanie = "UPDATE `sprzedaz` SET `potwierdzenie` = 'czeka' WHERE `id_zamowienia`='{$_GET['id_zamowienia']}' AND `idWORKER`='{$_SESSION['worker']}' ";
        $idzapytania = $conn->query("UPDATE `sprzedaz` SET `potwierdzenie` = 'czeka' WHERE `id_zamowienia`='{$_GET['id_zamowienia']}'") or die ("blee");
        
        // wszystko sie udało, przekierowywujemy do strony
        header("Location: headw.php?v=tresc/pracownik/zadania&prawa=tresc/pracownik/z_moje/p_zamowienia_przetwarzane");
        return; // zatrzymanie skrypu, gdyby przekierowanie sie nie udalo
    }
}

// tabelka z produkatmi w tym zamówieniu
?>
<h2>Zamówienie #<?=$_GET['id_zamowienia']?> <br> <small><?=$tytul?> </small></h2>
<?=zamowienie_komunikat("nowy", "btn-md")?>
<hr>
 <table class="table">
  <thead>
    <tr>
      <th>Nazwa</th>
      <th>Ilość</th>
    </tr>
  </thead>
    <tbody>

<?php
$db_host = "localhost";
$db_name = "fabryka";
$db_user = "root";
$db_pass = "";


$conn = new mysqli($db_host, $db_user, $db_pass, $db_name);
    // odpowiednie zapytanie, by pobrać dane i je wyświetlić w tabeli
    $wynik = $conn->query("SELECT `product`.`nazwa`, `sprzedaz`.ilosc FROM sprzedaz INNER JOIN product ON product.id_produktu = sprzedaz.id_produktu WHERE id_zamowienia={$_GET['id_zamowienia']} AND idWORKER={$_SESSION['worker']}");
    $razem = 0;
    while($r = mysqli_fetch_array($wynik,MYSQLI_ASSOC))
    {
        // wiersz tabeli z danymi
        echo "<tr>";
        echo "<td>{$r['nazwa']}</td>";
        echo "<td>{$r['ilosc']}</td>";
        echo "</tr>";
    }
    echo '<hr>';
    if ($przycisk)
    {
        $link_tak="?v=tresc/pracownik/zadania"
                . "&prawa=tresc/pracownik/z_nowe/p_dane_zamowienie"
                . "&id_zamowienia={$_GET['id_zamowienia']}"
                . "&akcja=wez"
                . "&potwierdzenie=tak";
        $link_nie = "?v=tresc/pracownik/zadania&prawa=tresc/pracownik/z_nowe/p_nowe_zamowienia";
        echo "<h3>Czy chcesz zająć się zamówieniem #{$_GET['id_zamowienia']}?</h3>";
        echo "<a href='{$link_tak}' class='btn btn-success btn-lg' style='margin-right:20px;'>Tak</a>";
        echo "<a href='{$link_nie}' class='btn btn-danger btn-lg'>Nie</a>";
    }
    
?>