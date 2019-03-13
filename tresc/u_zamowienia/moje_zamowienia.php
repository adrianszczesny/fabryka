<?php
// Wyświetla wszystkie zamówienia danego użytkowninka

// sprawdza, czy zalogowano, jeśli nie to błąd
if (!$_SESSION['user'])
{
    komunikat("Zaloguj sie!");
    return;
}

?>
<div class="row">
    <div class="col-md-12">
<h2>Moje zamówienia</h2>
<hr>
 <table class="table">
  <thead>
    <tr>
      <th>#id zamówienia</th>
      <th>Data</th>
      <th>Cena</th>
      <th>Stan</th>
    </tr>
  </thead>
    <tbody>     
<?php
$db_host = "localhost";
$db_name = "fabryka";
$db_user = "root";
$db_pass = "";


$conn = new mysqli($db_host, $db_user, $db_pass, $db_name);

    // odpowiednie zapytanie do bazy o zamówienia danego użytkownika
    $wynik = $conn->query("SELECT * FROM sprzedaz GROUP BY id_zamowienia HAVING id_uzytkownika={$_SESSION['user']}");
    while($r = mysqli_fetch_array($wynik, MYSQLI_ASSOC))
    {   // wyświetlenie tabelki z wszystkimi zamówieniami
        $cena = cena_zamowienia($r['id_zamowienia'], $_SESSION['user']); // podliczenie ceny danego zamówienia
        echo '<tr>';
        echo "<td><a href='?v=tresc/u_zamowienia/dane_zamowienie&id_zamowienia={$r['id_zamowienia']}&potwierdzenie={$r['potwierdzenie']}'>{$r['id_zamowienia']}</a></td>";
        echo "<td>{$r['data']}</td>";
        echo "<td>{$cena} zł</td>";
        echo "<td>".zamowienie_komunikat($r['potwierdzenie'])."</td>";
    }
?>
</div>       
</div>