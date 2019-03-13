<?php 
/*
 * dodaje nowy produkt do asortymentu sklepu
 */
 $db_host = "localhost";
$db_name = "fabryka";
$db_user = "root";
$db_pass = "";


$conn = new mysqli($db_host, $db_user, $db_pass, $db_name);

     // sprawdzamy, czy formularz został wysłany
    if (isset($_GET['wyslano']) && $_GET['wyslano']=="tak")
    {   // sprawdzamy, czy pola są wypełnione
        if(isset($_POST['nazwa']) && $_POST['nazwa']!="" 
                && isset($_POST['cena']) && $_POST['cena']!="" 
                && isset($_POST['ilosc']) && $_POST['ilosc']!="" 
                && isset($_POST['opis']) && $_POST['opis']!="" )
        { 
            // wszystko jest poprawnie wypełnione, można dodawać lekcję do bazy
            if($conn->query("INSERT INTO `product` (nazwa, cena, ilosc, opis) VALUES ('{$_POST['nazwa']}',{$_POST['cena']},{$_POST['ilosc']},'{$_POST['opis']}' ")===TRUE)
            {
                // dodawanie sie powiodło, robimy przekierowanie
                header("Location: index.php?v=tresc/p_zarzadzanie/p_panel&prawa=tresc/p_zarzadzanie/produkty/p_lista_produktow&dodano=tak");
                return;
            }
        }
        else
        {   // nie wypełniono wszystkich pól, komunikat o błędzie
            komunikat("Wypełnij wszystkie pola","danger");
        }
    }
?>

<h3>Dodawanie nowego produktu</h3>
<br>
<form action="index.php?v=tresc/p_zarzadzanie/p_panel&prawa=tresc/p_zarzadzanie/produkty/p_dodaj_nowy_produkt&wyslano=tak" method="post" accept-charset="utf-8">
  <div class="form-group">
    <label>Nazwa produktu</label>
    <input type="nazwa" class="form-control" id="exampleInputEmail1" placeholder="" name="nazwa" value="">
  </div>
  <div class="form-group">
    <label>Cena produktu</label>
    <input type="cena" class="form-control" id="exampleInputEmail1" placeholder="" name="cena" value="">
  </div>
  <div class="form-group">
    <label>Ilość</label>
    <input type="ilosc" class="form-control" id="exampleInputEmail1" placeholder="" name="ilosc" value="">
  </div>
  <div class="form-group ">
    <label>Opis produktu</label>
    <textarea class="form-control" rows="5" name="opis"></textarea>
  </div>
    <button type="submit" class="btn btn-default"><b>Dodaj produkt</b></button> 
</form>