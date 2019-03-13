<?php
/*
 * Wyświetla listę nowych zamówień. Pracownik może zająć się jednym z nich
 */
// 
// jeśli nie zalogowano na pracownika to przerywamy skrypt
if ($_SESSION['user']!=1)
{
    return;
}
?>
<h2>Magazyn</h2>
<hr>
 <table class="table">
  <thead>
    <tr>
      <th>Nazwa skladnika</th>
      <th>ilosc</th>
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
    $wynik = $conn->query("SELECT * FROM `sklad` ");
    while($r = mysqli_fetch_array($wynik, MYSQLI_ASSOC))
    {   // wyświetlenie tabelki z wszystkimi zamówieniami
        $link1= "?v=tresc/p_zarzadzanie/p_panel&prawa=tresc/p_zarzadzanie/magazyn/p_zarzadzaj&id_sklad={$r['id_sklad']}";
        echo '<tr>';
        echo "<td><a href='{$link1}'>{$r['nazwa']}</a></td>";
		echo "<td>{$r['ilosc']} </td>";
        echo "<td><a href='{$link1}&akcja=wez' class='btn btn-default btn-sm'>Dostawa</a></td>";
        echo "</tr>";
    }
?>
    </tbody>
 </table>