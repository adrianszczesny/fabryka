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
if (!isset($_GET['id_sklad']) || $_GET['id_sklad']=="")
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
    if (isset($_GET['zmian']) && $_GET['zmian']=="tak")
    {   // musimy zmienić każdą linijkę, więc musimy przejśc przez każdy produkt w petli
        $wynik = $conn->query("SELECT * FROM `sklad` WHERE id_sklad={$_GET['id_sklad']}");
        while($gg = mysqli_fetch_array($wynik,MYSQLI_ASSOC))
        {  
			$idsk= $_GET['id_sklad'];
			$indeks = 'ilosc'.$gg['id_sklad']; // indeks pola ze zmiennej $_POST
            $ilosc = $_POST[$indeks]; //przypisujemy, aby było wygodniej
			$nazwa_zmiennej = dostawa($idsk,$ilosc);
            // zapytanie do bazy zmieniające ilość produktu
           // $zapytanie = "UPDATE `sklad` SET `ilosc` = '{$nazwa_zmiennej}' WHERE `id_sklad`='{$gg['id_sklad']}'";
            //$idzapytania = $conn->query($zapytanie) or die ("blee e e e e e ");

            // przekierowanie do tej samej strony, ale bez zmieniania danych
            // zrobione jest to dla bezpieczeństwa, by omyłkowe odświeżenie strony nic nie zepsuło
           header("Location: index.php?v=tresc/p_zarzadzanie/p_panel&prawa=tresc/p_zarzadzanie/magazyn/p_sklad");
        }
    }
    
// tabelka z produkatmi w tym zamówieniu
?>
<h2>Dostawa</h2>
<hr>
<form action="index.php?v=tresc/p_zarzadzanie/p_panel&prawa=tresc/p_zarzadzanie/magazyn/p_zarzadzaj&id_sklad=<?=$_GET['id_sklad']?>&akcja=zarzadzaj&zmian=tak" method="post" accept-charset="utf-8">
 <table class="table">
  <thead>
    <tr>
      <th>Nazwa produktu</th>
      <th>Ilosc dostawy</th>
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
    $wynik = $conn->query("SELECT * FROM `sklad` WHERE id_sklad={$_GET['id_sklad']}");
    while($r = mysqli_fetch_array($wynik,MYSQLI_ASSOC))
    {
        // wiersz tabeli z danymi
        // na czerwono, jeśli nie ma towaru
		echo "<td>{$r['nazwa']}</td>";
        echo '<td> <input type="ilosc" style="width:60px;" class="form-control" id="exampleInputEmail1" placeholder="" name="ilosc'.$r['id_sklad'].'" value="'.$r['ilosc'].'"> </td>';
        echo "</tr>";
    }
    echo '</tbody></table>';
    echo '<button style="float:right;" type="submit" class="btn btn-default"><b>Zatwierdź dostawe</b></button></form> ';
    // przycisk do zatwierdzenia zmian
    echo '<hr>';
    // jeśli wystarcza towaru, wyświetlamy jedne przyciski
    // stworzenie linków
        $link_nie = "?v=tresc/p_zarzadzanie/p_panel&prawa=tresc/p_zarzadzanie/magazyn/p_sklad";
                
    if ($przycisk )
    {
        echo "<a href='{$link_nie}' class='btn btn-info '>Powrót</a>";
    }
    // jeśli nie wystarcza towaru, wyświetlamy inne przyciski
?>