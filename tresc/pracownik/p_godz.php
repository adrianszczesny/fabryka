<?php
/*
 * Wyświetla listę nowych zamówień. Pracownik może zająć się jednym z nich
 */
// 
// jeśli nie zalogowano na pracownika to przerywamy skrypt
if (!$_SESSION['worker'])
{
    return;
}
?>
<h2>Twoja zmiana </h2>
<hr>
 <table class="table">
  <thead>
    <tr>
      <th>Numer zmiany</th>
	  <th>Poczatek pracy</th>
	  <th>Koniec pracy</th>
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

	$wynik = $conn->query("SELECT * FROM `zmiana` WHERE id_zmiany={$_GET['id_zmiany']} ");
    while($r = mysqli_fetch_array($wynik, MYSQLI_ASSOC))
    {   // wyświetlenie tabelki z wszystkimi zamówieniami
        echo '<tr>';
        echo "<td>{$r['id_zmiany']}</td>";
        echo "<td>{$r['start']}</td>";
		echo "<td>{$r['koniec']}</td>";
		echo "</tr>";
    }
?>
    </tbody>
 </table>