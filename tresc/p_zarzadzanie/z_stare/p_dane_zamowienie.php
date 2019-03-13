<?php
/*
 * Skrypt wyświetla dane zamówienie (szczegóły), tylko do odczytu
 */

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

// tabelka z produkatmi w tym zamówieniu
?>

<h2>Zamówienie #<?=$_GET['id_zamowienia']?> <br></h2>
<?=zamowienie_komunikat($_GET['stan'], "btn-md")?>
<hr>
 <table class="table">
  <thead>
    <tr>
      <th>Nazwa</th>
      <th>Cena jednostkowa</th>
      <th>Ilość</th>
      <th>Iloczyn ceny</th>
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
    $wynik = $conn->query("SELECT `product`.`nazwa`, `product`.cena, `sprzedaz`.ilosc FROM sprzedaz INNER JOIN product ON product.id_produktu = sprzedaz.id_produktu WHERE id_zamowienia={$_GET['id_zamowienia']}");
    $razem = 0;
    while($r = mysqli_fetch_array($wynik,MYSQLI_ASSOC))
    {
        // wiersz tabeli z danymi
        echo "<tr>";
        echo "<td>{$r['nazwa']}</td>";
        echo "<td>{$r['cena']} zł</td>";
        echo "<td>{$r['ilosc']}</td>";
        echo "<td>".$r['ilosc']*$r['cena']." zł</td>";
        echo "</tr>";
        $razem += $r['ilosc']*$r['cena'];
    }
    echo '</tbody></table>';
    echo "<h4>Razem: {$razem} zł</h4>";
?>