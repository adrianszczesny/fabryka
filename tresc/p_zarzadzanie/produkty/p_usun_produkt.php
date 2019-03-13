<?php
/*
 * Plik usuwający dany produkt z bazy, podany przez ID
 */
 $db_host = "localhost";
$db_name = "fabryka";
$db_user = "root";
$db_pass = "";


$conn = new mysqli($db_host, $db_user, $db_pass, $db_name);
    // sprawdzamy, czy to aby na pewno pracownik
    if ($_SESSION['user']!=1) // jeśli to nie pracownik, przerywamy skrpyt
    {
        komunikat("Dostęp tylko dla pracownika");
        return;
    }
    // sprawdzamy czy istnieje odpowiennna zmienna GET. Jeśli nie to komunikat o bledzie i return
    if (!isset($_GET['id_produktu']) || $_GET['id_produktu']=="")
    {
        komunikat("Nie podano id produktu!");
        return;
    }

    $id_produktu = $_GET['id_produktu']; // przypisanie dla wygody
        
    // sprawdzamy, czy został naciśnięty przycisk tak
    if (isset($_GET['wyslano']) && $_GET['wyslano']=="tak")
    {   
        $zapytanie = "DELETE FROM product WHERE `id_produktu`={$id_produktu}";
        $idzapytania = $conn->query($zapytanie) or die("Bleee");
        // jeśli się wszystko powiodło, przekierowywujemy
        header("Location: index.php?v=tresc/p_zarzadzanie/p_panel&prawa=tresc/p_zarzadzanie/produkty/p_lista_produktow&usunieto=tak");
        return;
    }
?>
<h3>Czy chcesz usunąć produkt #<?=$_GET['id_produktu']?></h3>
<a href="?v=tresc/p_zarzadzanie/p_panel&prawa=tresc/p_zarzadzanie/produkty/p_usun_produkt&id_produktu=<?=$_GET['id_produktu']?>&wyslano=tak" class="btn btn-success" style="margin-right:20px;">Tak, usuń </a>
<a href="?v=tresc/p_zarzadzanie/p_panel&prawa=tresc/p_zarzadzanie/produkty/p_lista_produktow&usunieto=anulowano&id_produktu=<?=$_GET['id_produktu']?>" class="btn btn-danger ">Nie, nie rób tego!</a>
