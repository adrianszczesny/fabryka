<?php
/*
 *  funkcje wyświetlające produkty
 */
 require_once 'dbconnect.php';

// wyświetla widget (kafelek) z produktem 
function w_produkt_kafelek($id)
{
$db_host = "localhost";
$db_name = "fabryka";
$db_user = "root";
$db_pass = "";


$conn = new mysqli($db_host, $db_user, $db_pass, $db_name);

    $zapytanie = "SELECT * FROM `product` WHERE id_produktu={$id}";
    $folder_obrazkow='img/produkty';
    $height = 120;
    echo '<div class="thumbnail">'
          .'<div class="caption" style="text-align: center;">'
          .'';
    $wynik = $conn->query($zapytanie);
    while($r = mysqli_fetch_array($wynik, MYSQLI_ASSOC)) 
    {
        echo "<a href='?v=tresc/karta_produktu/karta_produktu&id_produktu={$r['id_produktu']}'>";
        echo "<img src='{$folder_obrazkow}/{$r['obrazek']}' style ='height:{$height}px; ' >";
        echo "{$r['nazwa']}</a><br>";
        echo "{$r['cena']} zł/szt<br>";
        echo "<a class='btn btn-default btn-sm'"
            . "href='?v=tresc/koszyk/dodaj_do_koszyka&id_produktu={$r['id_produktu']}'>" 
            . "Dodaj do koszyka</a>";
    }
     
    echo '</div>'
          .'</div>';
}


// wyświetla wszystkie prdukty (kafelki)  z kategorii $id_kategorii
// jeśli $id_kategorii jest równe 0, wyświetla wszystko
// $cena_min i max to zakres cenowy. 0 oznacza brak zakresu
// $liczba_na_strone - liczba produktów na stronie, 0 oznacza wszystkie
// $strona numer aktualnej strony, 0 oznacza brak paginacji
function w_produkty_kafelki()
{
	$db_host = "localhost";
$db_name = "fabryka";
$db_user = "root";
$db_pass = "";


$conn = new mysqli($db_host, $db_user, $db_pass, $db_name);
    // jeżeli $id_kategorii jest rowne 0, wyświetlamy wszystko
         
    // kilka zmiennych "globalnych"
    $folder_obrazkow='img/produkty';
    $height = 120; // wysykosc zdjecia
    $col_md = 3; // szerokość "kafelka" z produktem

	$res = $conn->query("SELECT * FROM product");

	// zapytanie do bazy danych
    $i = 0; // potrzeba zmienna $i, by sprawdzac, co ile "przełamać" linię
    while($r =mysqli_fetch_array($res, MYSQLI_ASSOC)) 
    {   // rozmiarówka kafelka
        echo '<div id="kafel" class="col-md-'.$col_md.'">';
        // rozpoczenie miniatury
        echo '<div class="thumbnail">'
        .'<div class="caption" style="text-align: center;">';
        
        // linki do karty produktu
        echo "<a href='?v=tresc/karta_produktu/karta_produktu&id_produktu={$r['id_produktu']}'>";
        echo "<img src='{$folder_obrazkow}/{$r['obrazek']}' style ='height:{$height}px; ' >";
        echo "{$r['nazwa']}</a><br>";
        echo "{$r['cena']} zł<br>";
        echo "<a class='btn btn-default btn-sm'"
            . "href='?v=tresc/koszyk/dodaj_do_koszyka&id_produktu={$r['id_produktu']}'>" 
            . "Dodaj do koszyka</a>"; // przycisk do dodawania do koszyka
        echo '</div>';
        $i++;  
         
        echo '</div>' // to te divy, co mogą robić problemy
             .'</div>';
    }
    
    echo '</div>';// ten div musi być, bo paginacja się źle wyświetla bez niego
    
}

// zwraca liczbę produktów w sklepie/magazynie (liczbę wpisów, a nei ilość danego produktu)
function liczba_produktow()
{	
$db_host = "localhost";
$db_name = "fabryka";
$db_user = "root";
$db_pass = "";


$conn = new mysqli($db_host, $db_user, $db_pass, $db_name);

    $wynik = $conn->query("SELECT * FROM product");
    $liczba = mysql_num_rows($wynik);
    return $liczba;
}

// zwraca nazwę kategorii produktu
function nazwa_kategorii($id_kategorii)
{
    $wynik = mysql_query("SELECT nazwa FROM kategorie WHERE id_kategorii={$id_kategorii}");
    while($r = mysql_fetch_assoc($wynik)) 
    {
        return $r['nazwa'];
    }
}

//wyświetla karuzelę z promocjami jak w lydlu i w biedronce
function karuzela()
{
echo '<div id="myCarousel" class="carousel slide" data-ride="carousel">
  <!-- Indicators -->
  <ol class="carousel-indicators">
    <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
    <li data-target="#myCarousel" data-slide-to="1"></li>
    <li data-target="#myCarousel" data-slide-to="2"></li>
    <li data-target="#myCarousel" data-slide-to="3"></li>
  </ol>

  <!-- Wrapper for slides -->
  <div class="carousel-inner" role="listbox">
    <div class="item active">
      <a href="index.php?v=tresc/karta_produktu/karta_produktu&id_produktu=20"><img src="img/karuzela/ritter5.jpg" width="800px" height="600px" alt="Classic"></a>
      <div class="carousel-caption">
        <h3></h3>
        <p></p>
      </div>
    </div>

    <div class="item">
      <a href="index.php?v=tresc/karta_produktu/karta_produktu&id_produktu=15"><img src="img/karuzela/ritter6.jpg" width="800px" height="600px" alt="New"></a>
      <div class="carousel-caption">
        <h3></h3>
        <p></p>
      </div>
    </div>

    <div class="item">
      <a href="index.php?v=tresc/karta_produktu/karta_produktu&id_produktu=30"><img src="img/karuzela/ritter3.jpg" width="800px" height="600px" alt="sklep"></a>
      <div class="carousel-caption">
        <h3></h3>
        <p></p>
      </div>
    </div>

    <div class="item">
      <a href="index.php?v=tresc/karta_produktu/karta_produktu&id_produktu=36"><img src="img/karuzela/ritter4.jpg" width="800px" height="600px" alt="Fabryka"></a>
      <div class="carousel-caption">
        <h3></h3>
        <p></p>
      </div>
    </div>
  </div>

  <!-- Left and right controls -->
  <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
    <span class="sr-only">Poprzedni</span>
  </a>
  <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
    <span class="sr-only">Następny</span>
  </a>
</div>';
}