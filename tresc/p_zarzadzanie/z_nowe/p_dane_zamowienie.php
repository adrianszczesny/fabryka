<?php
/*
 * Skrypt wyświetla dane zamówienie (szczegóły) i pozwala nim zarządzać
 * tzn. zmieniać ilośc produktu.
 * Wyświetla także przyciski, które umożliwiaja zatwierdzenie lub anulowanie zamówienia
 */
 $db_host = "localhost";
$db_name = "fabryka";
$db_user = "root";
$db_pass = "";


$conn = new mysqli($db_host, $db_user, $db_pass, $db_name);
// jeśli nie zalogowano na pracownika to przerywamy skrypt
if ($_SESSION['user']!=1)
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
  
// zmiana ilości produktów w zamowieniu
    if (isset($_GET['zmiana']) && $_GET['zmiana']=="tak")
    {   // musimy zmienić każdą linijkę, więc musimy przejśc przez każdy produkt w petli
        $wynik = $conn->query("SELECT * FROM sprzedaz WHERE id_zamowienia={$_GET['id_zamowienia']}");
        while($gg = mysqli_fetch_array($wynik,MYSQLI_ASSOC))
        {  
            $indeks = 'ilosc'.$gg['id_sprzedazy']; // indeks pola ze zmiennej $_POST
            $nazwa_zmiennej = $_POST[$indeks]; //przypisujemy, aby było wygodniej
            // zapytanie do bazy zmieniające ilość produktu
            $zapytanie = "UPDATE `sprzedaz` SET `ilosc` = '{$nazwa_zmiennej}' WHERE `id_sprzedazy`='{$gg['id_sprzedazy']}'";
            $idzapytania = $conn->query($zapytanie) or die ("blee e e e e e ");

			$indeks2 = 'idWORKER'.$gg['id_sprzedazy']; // indeks pola ze zmiennej $_POST
            $nazwa_zmiennej2 = $_POST[$indeks2]; //przypisujemy, aby było wygodniej
            // zapytanie do bazy zmieniające ilość produktu
            $zapytanie2 = "UPDATE `sprzedaz` SET `idWORKER` = '{$nazwa_zmiennej2}' WHERE `id_sprzedazy`='{$gg['id_sprzedazy']}'";
            $idzapytania2 = $conn->query($zapytanie2) or die ("blee e e e e e ");
            // przekierowanie do tej samej strony, ale bez zmieniania danych
            // zrobione jest to dla bezpieczeństwa, by omyłkowe odświeżenie strony nic nie zepsuło
            header("Location: index.php?v=tresc/p_zarzadzanie/p_panel&prawa=tresc/p_zarzadzanie/z_moje/p_dane_zamowienie&id_zamowienia={$_GET['id_zamowienia']}&akcja=zarzadzaj");
        }
    }
    
// tabelka z produkatmi w tym zamówieniu
?>
<h2>Zamówienie #<?=$_GET['id_zamowienia']?> <br> <small><?=$tytul?> </small></h2>
<?=zamowienie_komunikat("nowy", "btn-md")?>
<hr>
<form action="index.php?v=tresc/p_zarzadzanie/p_panel&prawa=tresc/p_zarzadzanie/z_moje/p_dane_zamowienie&id_zamowienia=<?=$_GET['id_zamowienia']?>&akcja=zarzadzaj&zmiana=tak" method="post" accept-charset="utf-8">
 <table class="table">
  <thead>
    <tr>
      <th>Nazwa</th>
      <th>Cena jednostkowa</th>
      <th>Ilość</th>
      <th>Iloczyn ceny</th>
	  <th>pracownik</th>
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
    $wynik = $conn->query("SELECT `product`.`nazwa`, `product`.cena, `sprzedaz`.ilosc, `sprzedaz`.id_sprzedazy, product.id_produktu, `sprzedaz`.idWORKER FROM sprzedaz INNER JOIN product ON product.id_produktu = sprzedaz.id_produktu WHERE id_zamowienia={$_GET['id_zamowienia']}");
    $razem = 0;
    $wystarcza_towaru = TRUE;
    while($r = mysqli_fetch_array($wynik,MYSQLI_ASSOC))
    {
        // wiersz tabeli z danymi
        // na czerwono, jeśli nie ma towaru
        if (!czy_starcza_towaru($r['id_produktu'], $r['ilosc']))
        {
            echo "<tr class='danger'>";
            $wystarcza_towaru = FALSE;
        }
        else // w przeciwnym wypadku wyświetlamy normalnie
        {
            echo "<tr>";
        }
        echo "<td>{$r['nazwa']}</td>";
        echo "<td>{$r['cena']} zł</td>";
        echo '<td> <input type="ilosc" style="width:60px;" class="form-control" id="exampleInputEmail1" placeholder="" name="ilosc'.$r['id_sprzedazy'].'" value="'.$r['ilosc'].'"> </td>';
        echo "<td>".$r['ilosc']*$r['cena']." zł</td>";
		echo '<td> <input type="idWORKER" style="width:60px;" class="form-control" id="exampleInputEmail1" placeholder="" name="idWORKER'.$r['id_sprzedazy'].'" value="'.$r['idWORKER'].'"> </td>';
        echo "</tr>";
        $razem += $r['ilosc']*$r['cena'];
    }
    echo '</tbody></table>';
    echo '<button style="float:right;" type="submit" class="btn btn-default"><b>Zatwierdź zmiany</b></button></form> ';
    echo "<h4>Razem: {$razem} zł</h4>";
    // przycisk do zatwierdzenia zmian
    echo '<hr>';
    // jeśli wystarcza towaru, wyświetlamy jedne przyciski
    // stworzenie linków
        $link_nie = "?v=tresc/p_zarzadzanie/p_panel&prawa=tresc/p_zarzadzanie/z_moje/p_zamowienia_przetwarzane";
                
    if ($przycisk && $wystarcza_towaru)
    {
        echo "<a href='{$link_nie}' class='btn btn-info '>Powrót</a>";
    }
    // jeśli nie wystarcza towaru, wyświetlamy inne przyciski
    else if($przycisk && $wystarcza_towaru==FALSE)
    {
        komunikat("Nie wystarcza towarów zaznaczonych na czerowono. Zmniejsz ich ilość lub odrzuć zamówienie", "danger");
        echo "<a href='{$link_nie}' class='btn btn-info'>Powrót</a>";
    }
?>