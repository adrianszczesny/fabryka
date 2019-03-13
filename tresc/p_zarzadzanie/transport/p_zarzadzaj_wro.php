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
$przycisk = TRUE;
// sprawdzamy, czy chchemy wykonać jakąś akcję. Jeśli nie ma zniennej akcja, to znaczy że nie. Więc tylko wyświetlamy

  
// zmiana ilości produktów w zamowieniu
    if (isset($_GET['zmian']) && $_GET['zmian']=="tak")
    {   // musimy zmienić każdą linijkę, więc musimy przejśc przez każdy produkt w petli
        $wynik = $conn->query("SELECT * FROM `sprzedaz` HAVING miejscowosc='Wroclaw' ");
        while($gg = mysqli_fetch_array($wynik,MYSQLI_ASSOC))
        {  
			$indeks = 'id_transport'.$gg['id_zamowienia']; // indeks pola ze zmiennej $_POST
            $ilosc = $_POST[$indeks]; //przypisujemy, aby było wygodniej
            // zapytanie do bazy zmieniające ilość produktu
            $zapytanie = "UPDATE `sprzedaz` SET `id_transport` = '{$ilosc}' WHERE `id_zamowienia`='{$gg['id_zamowienia']}'";
            $idzapytania = $conn->query($zapytanie) or die ("blee e e e e e ");

            // przekierowanie do tej samej strony, ale bez zmieniania danych
            // zrobione jest to dla bezpieczeństwa, by omyłkowe odświeżenie strony nic nie zepsuło
           header("Location: index.php?v=tresc/p_zarzadzanie/p_panel&prawa=tresc/p_zarzadzanie/transport/p_transport");
        }
    }
    
// tabelka z produkatmi w tym zamówieniu
?>
<h2>Dostawa</h2>
<hr>
<form action="index.php?v=tresc/p_zarzadzanie/p_panel&prawa=tresc/p_zarzadzanie/transport/p_zarzadzaj_wro&id_transport=<?=$_GET['id_transport']?>&akcja=zarzadzaj&zmian=tak" method="post" accept-charset="utf-8">
 <table class="table">
  <thead>
    <tr>
      <th>id_zamowienia</th>
      <th>Data</th>
	  <th>ilosc</th>
	  <th>id_transportu</th>
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
    $wynik = $conn->query("SELECT * FROM `sprzedaz` HAVING miejscowosc='Wroclaw' ");
    while($r = mysqli_fetch_array($wynik,MYSQLI_ASSOC))
    {
        // wiersz tabeli z danymi
        // na czerwono, jeśli nie ma towaru
		echo "<td>{$r['id_zamowienia']}</td>";
		echo "<td>{$r['data']}</td>";
		echo "<td>{$r['ilosc']}</td>";
        echo '<td> <input type="id_transport" style="width:60px;" class="form-control" id="exampleInputEmail1" placeholder="" name="id_transport'.$r['id_zamowienia'].'" value="'.$r['id_transport'].'"> </td>';
        echo "</tr>";
    }
    echo '</tbody></table>';
    echo '<button style="float:right;" type="submit" class="btn btn-default"><b>Zatwierdz ladunek</b></button></form> ';
    // przycisk do zatwierdzenia zmian
    echo '<hr>';
    // jeśli wystarcza towaru, wyświetlamy jedne przyciski
    // stworzenie linków
        $link_nie = "?v=tresc/p_zarzadzanie/p_panel&prawa=tresc/p_zarzadzanie/transport/p_transport";
                
    if ($przycisk )
    {
        echo "<a href='{$link_nie}' class='btn btn-info '>Powrót</a>";
    }
    // jeśli nie wystarcza towaru, wyświetlamy inne przyciski
?>