<?php
/*
 *  wyświetla kartę produktu. ID produktu jest podawane przez pasek adresu
 */
 $db_host = "localhost";
$db_name = "fabryka";
$db_user = "root";
$db_pass = "";


$conn = new mysqli($db_host, $db_user, $db_pass, $db_name);

    // komunikat po dodaniu produktu do koszyka
    if (isset($_GET['dodano_do_koszyka']) && $_GET['dodano_do_koszyka']=="tak")
    {
        komunikat ("Produkt został pomyślnie dodany do koszyka.", "success");
    }
    else if (isset($_GET['dodano_do_koszyka']) && $_GET['dodano_do_koszyka']=="nie")
    {
        komunikat ("Przedmiot nie może zostać dodany do koszyka. (Nie ma więcej w magazynie)", "warning");
    }

    // sprawdzamy, czy podano id_produktu. Jeśli nie to wywalamy komunikat o błędzie
    if (!isset($_GET['id_produktu']) && $_GET['id_produktu']=="")
    {
        komunikat("Nie podano poprawnego ID produktu, wróć do strony głównej.", "info");
        return;
    }
    // zmienne globalne
    $id = $_GET['id_produktu'];
    $folder_obrazkow='img/produkty';
    
    // wyświetlamy dany produkt
    $wynik = $conn->query("SELECT * FROM `product` WHERE id_produktu={$id}");
    while($r = mysqli_fetch_array($wynik,MYSQLI_ASSOC)) 
    {
        echo "<div class='row'>"
                . "<div class='thumbnail'>"
                    . "<h2>{$r['nazwa']}</h2>"
                . "</div>"
             . "</div>";
                    
        echo "<div class='row'>"
                . "<div class='col-md-4 thumbnail'>"
                     . "<img src='{$folder_obrazkow}/{$r['obrazek']}' width='280'><br>"
                . "</div>"
                . "<div id='karta_kafel' class='col-md-6'>"
                     . "Cena: <b>{$r['cena']} zł</b><br>"
                     . "Ilość: <i>{$r['ilosc']}</i><br>"
                     . "<hr>Opis: {$r['opis']}<br>"
                . "</div>"
                . "<div id='karta_kafel' class='col-md-2 thumbnail'>"
                      . "<a class='btn btn-default' href='?v=tresc/koszyk/dodaj_do_koszyka&id_produktu={$r['id_produktu']}'>Dodaj do koszyka</a>"
                . "</div>"
            . "</div>";                     
    }  
?>