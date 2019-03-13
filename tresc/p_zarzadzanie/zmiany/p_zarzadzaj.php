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
if (!isset($_GET['idGROUP']) || $_GET['idGROUP']=="")
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
        $wynik = $conn->query("SELECT * FROM `group` WHERE idGROUP={$_GET['idGROUP']}");
        while($gg = mysqli_fetch_array($wynik,MYSQLI_ASSOC))
        {  
            $indeks = 'zmiana'.$gg['idGROUP']; // indeks pola ze zmiennej $_POST
            $nazwa_zmiennej = $_POST[$indeks]; //przypisujemy, aby było wygodniej
            // zapytanie do bazy zmieniające ilość produktu
            $zapytanie = "UPDATE `group` SET `zmiana` = '{$nazwa_zmiennej}' WHERE `idGROUP`='{$gg['idGROUP']}'";
            $idzapytania = $conn->query($zapytanie) or die ("blee e e e e e ");

			$indeks2 = 'idLINE'.$gg['idGROUP']; // indeks pola ze zmiennej $_POST
            $nazwa_zmiennej2 = $_POST[$indeks2]; //przypisujemy, aby było wygodniej
            // zapytanie do bazy zmieniające ilość produktu
            $zapytanie2 = "UPDATE `group` SET `idLINE` = '{$nazwa_zmiennej2}' WHERE `idGROUP`='{$gg['idGROUP']}'";
            $idzapytania2 = $conn->query($zapytanie2) or die ("blee e e e e e ");
            // przekierowanie do tej samej strony, ale bez zmieniania danych
            // zrobione jest to dla bezpieczeństwa, by omyłkowe odświeżenie strony nic nie zepsuło
            header("Location: index.php?v=tresc/p_zarzadzanie/p_panel&prawa=tresc/p_zarzadzanie/zmiany/p_zarzadzaj&idGROUP={$_GET['idGROUP']}&akcja=zarzadzaj");
        }
    }
    
// tabelka z produkatmi w tym zamówieniu
?>
<h2>Brygada nr <?=$_GET['idGROUP']?> <br> <small><?=$tytul?> </small></h2>
<hr>
<form action="index.php?v=tresc/p_zarzadzanie/p_panel&prawa=tresc/p_zarzadzanie/zmiany/p_zarzadzaj&idGROUP=<?=$_GET['idGROUP']?>&akcja=zarzadzaj&zmian=tak" method="post" accept-charset="utf-8">
 <table class="table">
  <thead>
    <tr>
      <th>Numer Brygady</th>
      <th>Zmiana</th>
      <th>Linia</th>
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
    $wynik = $conn->query("SELECT * FROM `group` WHERE idGROUP={$_GET['idGROUP']}");
    while($r = mysqli_fetch_array($wynik,MYSQLI_ASSOC))
    {
        // wiersz tabeli z danymi
        // na czerwono, jeśli nie ma towaru
		echo "<td>{$r['idGROUP']}</td>";
        echo '<td> <input type="zmiana" style="width:60px;" class="form-control" id="exampleInputEmail1" placeholder="" name="zmiana'.$r['idGROUP'].'" value="'.$r['zmiana'].'"> </td>';
		echo '<td> <input type="idLINE" style="width:60px;" class="form-control" id="exampleInputEmail1" placeholder="" name="idLINE'.$r['idGROUP'].'" value="'.$r['idLINE'].'"> </td>';
        echo "</tr>";
    }
    echo '</tbody></table>';
    echo '<button style="float:right;" type="submit" class="btn btn-default"><b>Zatwierdź zmiany</b></button></form> ';
    // przycisk do zatwierdzenia zmian
    echo '<hr>';
    // jeśli wystarcza towaru, wyświetlamy jedne przyciski
    // stworzenie linków
        $link_nie = "?v=tresc/p_zarzadzanie/p_panel&prawa=tresc/p_zarzadzanie/zmiany/p_zmiany";
                
    if ($przycisk )
    {
        echo "<a href='{$link_nie}' class='btn btn-info '>Powrót</a>";
    }
    // jeśli nie wystarcza towaru, wyświetlamy inne przyciski
?>