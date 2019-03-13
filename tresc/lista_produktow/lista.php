<?php
require_once 'dbconnect.php';
/*
 * wyświetla listę produktów, które należą do danych kryteriów 
 * (wybranych w pliku kategorie.php i przesłane przez pasek adresu)
 */

// jeśli jakie kolwiek kryterium jest rowne 0, wyświetlamy wszystko bez filtrowania
// przypisanie wartosci domyslnych

// NUMEROWANIE STRON OD 1
// zmienne "huby"

// wyswietlenie tabeli z produktami
// funkcja, która pobiera przefiltrowane dane i wyświetla listę produktów w zależności od podanych danych
w_produkty_kafelki(); 
?>