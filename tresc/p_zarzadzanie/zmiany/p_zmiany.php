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
<h2>Brygady</h2>
<hr>
 <table class="table">
  <thead>
    <tr>
      <th>Numer Brygady</th>
      <th>Zmiana</th>
      <th>Linia</th>
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
    $wynik = $conn->query("SELECT * FROM `group` ");
    while($r = mysqli_fetch_array($wynik, MYSQLI_ASSOC))
    {   // wyświetlenie tabelki z wszystkimi zamówieniami
        $link1= "?v=tresc/p_zarzadzanie/p_panel&prawa=tresc/p_zarzadzanie/zmiany/p_zarzadzaj&idGROUP={$r['idGROUP']}";
        echo '<tr>';
        echo "<td><a href='{$link1}'>{$r['idGROUP']}</a></td>";
		echo "<td>{$r['zmiana']} </td>";
        echo "<td>{$r['idLINE']}</td>";
        echo "<td><a href='{$link1}&akcja=wez' class='btn btn-default btn-sm'>Zarzadzaj</a></td>";
        echo "</tr>";
    }
?>
    </tbody>
 </table>