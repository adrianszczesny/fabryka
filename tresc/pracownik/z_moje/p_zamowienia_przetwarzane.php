<?php
/*
 * Wświetla listę zamówien przetwarzanych przez danego pracownika
 */
?>
<h2>Zamówienia przetwarzane teraz przeze mnie</h2>
<hr>
 <table class="table">
  <thead>
    <tr>
      <th>#id zamówienia</th>
      <th>Data zamówienia</th>
      <th>Stan</th>
      <th>Klient</th>
       <th></th>
    </tr>
  </thead>
    <tbody>     
<?php
$db_host = "localhost";
$db_name = "fabryka";
$db_user = "root";
$db_pass = "";


$conn = new mysqli($db_host, $db_user, $db_pass, $db_name);

    // odpowiednie zapytanie do bazy o zamówienia danego użytkownikapotwierdzenie='now
    $wynik = $conn->query("SELECT * FROM sprzedaz INNER JOIN users ON sprzedaz.id_uzytkownika = users.id GROUP BY id_zamowienia HAVING potwierdzenie='czeka' AND sprzedaz.idWORKER = {$_SESSION['worker']} ");
    while($r = mysqli_fetch_array($wynik,MYSQLI_ASSOC))
    {   // wyświetlenie tabelki z wszystkimi zamówieniami
        $link1= "?v=tresc/pracownik/zadania&prawa=tresc/pracownik/z_moje/p_dane_zamowienie&id_zamowienia={$r['id_zamowienia']}";
        echo '<tr>';
        echo "<td><a href='{$link1}&akcja=zarzadzaj'>{$r['id_zamowienia']}</a></td>";
        echo "<td>{$r['data']}</td>";
        echo "<td>".zamowienie_komunikat($r['potwierdzenie'])."</td>";
        echo "<td>{$r['username']} <i>({$r['email']})</i> </td>";
        echo "<td><a href='{$link1}&akcja=zarzadzaj' class='btn btn-default btn-sm'>Zarządzaj zamówieniem</a></td>";
        echo "</tr>";
    }
?>
    </tbody>
 </table>