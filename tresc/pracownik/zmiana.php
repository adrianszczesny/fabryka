<?php
/*
 * Wyświetla listę nowych zamówień. Pracownik może zająć się jednym z nich
 */
// 
// jeśli nie zalogowano na pracownika to przerywamy skrypt
?>
<h2>Twoja zmiana </h2>
<hr>
 <table class="table">
  <thead>
    <tr>
      <th>Numer Brygady</th>
      <th>Linia</th>
	  <th>Zmiana</th>
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

 $wynik = $conn->query("SELECT * FROM `worker` WHERE idWORKER={$_SESSION['worker']} ");
 $r = mysqli_fetch_array($wynik, MYSQLI_ASSOC);
 
    // odpowiednie zapytanie do bazy o zamówienia danego użytkownikapotwierdzenie='now
    $wynik2 = $conn->query("SELECT * FROM `group` WHERE idGROUP={$r['idGROUP']} ");
    while($r2 = mysqli_fetch_array($wynik2, MYSQLI_ASSOC))
    {   // wyświetlenie tabelki z wszystkimi zamówieniami
		$link1= "?v=tresc/pracownik/p_godz&id_zmiany={$r2['zmiana']}";
        echo '<tr>';
        echo "<td>{$r2['idGROUP']}</a></td>";
        echo "<td>{$r2['idLINE']}</td>";
		echo "<td><a href='{$link1}'>{$r2['zmiana']}</td>";
	}
?>
    </tbody>
 </table>