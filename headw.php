<?php 
ob_start();
session_start();
require_once 'dbconnect.php';
require_once("funkcje/f_include.php");
require_once("funkcje/f_komunikaty.php");
    // f_przyciski zawiera funkcje wyœwietlajace przyciski
require_once("funkcje/f_przyciski.php");
require_once("funkcje/f_panel_pracownika.php");
    

if (!isset($_SESSION['worker'])) {
    header("Location: kto.php");
    exit;
}
?>
<?
<?php
$db_host = "localhost";
$db_name = "fabryka";
$db_user = "root";
$db_pass = "";


$conn = new mysqli($db_host, $db_user, $db_pass, $db_name);
    // odpowiednie zapytanie, by pobraæ dane i je wyœwietliæ w tabeli
    $wynik = $conn->query("SELECT worker.idGROUP FROM `worker` WHERE idWORKER={$_SESSION['worker']}");
?>
<!DOCTYPE html>
<html>
<style>
#containr{
    text-align: center;
  display: inline-block;
  position: absolute;
  top: 20%;
  left: 40%;
}
</style>
<?php 
    // do³¹czenie <head> witryny
    include("funkcje/head.php");
?>  
    <body>     
        <div class="container">       
        <?php 
            // do³¹czenie nag³owka strony (górny pasek widoczny na ka¿dej podstronie)
            include ("funkcje/naglowekw.php");
			dolacz_plik("v", "tresc/strona_glownaw");
        ?>
        </div>
        <!-- Do³¹czenie skryptów z bootstrapa i jQuery -->
        <script src="bootstrap/js/jquery.min.js"></script>
        <script src="bootstrap/js/bootstrap.js"></script>
        <script src="bootstrap/js/jquery.validate.js"></script>
        <script src="bootstrap/js/walidacja.js"></script>
    </body>
</html>