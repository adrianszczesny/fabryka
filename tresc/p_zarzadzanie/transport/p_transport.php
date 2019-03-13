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
<h2>Ładunki</h2>
<hr>
 <table class="table">
  <thead>
    <tr>
      <th>Miejscowosc</th>
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
    	$many=ile_do('Wroclaw');
        $link1= "?v=tresc/p_zarzadzanie/p_panel&prawa=tresc/p_zarzadzanie/transport/p_zarzadzaj_wro";
        echo '<tr>';
        echo "<td><a href='{$link1}'>Wroclaw</a></td>";
		echo "<td>{$many} </td>";
        echo "<td><a href='{$link1}&akcja=wez' class='btn btn-default btn-sm'>Zobacz</a></td>";
        echo "</tr>";
    
?>
    </tbody>
 </table>