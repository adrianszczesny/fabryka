<?php 
ob_start();
session_start();
require_once 'dbconnect.php';
require_once("funkcje/f_include.php");
require_once("funkcje/f_komunikaty.php");
require_once("funkcje/f_przyciski.php");
require_once("funkcje/f_produkty.php");
require_once("funkcje/f_koszyk.php");
require_once("funkcje/f_panel_pracownika.php");
    
if($_SESSION['worker']){
	header("Location: headw.php");
	}

if (!isset($_SESSION['user'])) {
    header("Location: kto.php");
    exit;
}

$res = $conn->query("SELECT * FROM users WHERE id=" . $_SESSION['user']);
$userRow = mysqli_fetch_array($res, MYSQLI_ASSOC);

?>

<!DOCTYPE html>
<html>
<?php 
    // dołączenie <head> witryny
    include("funkcje/head.php");
?>  
    <body>     
        <div class="container">       
        <?php 
            // dołączenie nagłowka strony (górny pasek widoczny na każdej podstronie)
            include ("funkcje/naglowek.php");
            // dołączamy plik z daną podstroną
            dolacz_plik("v", "tresc/strona_glowna");
        ?>
        </div>    
        
        <!-- Dołączenie skryptów z bootstrapa i jQuery -->
        <script src="bootstrap/js/jquery.min.js"></script>
        <script src="bootstrap/js/bootstrap.js"></script>
        <script src="bootstrap/js/jquery.validate.js"></script>
        <script src="bootstrap/js/walidacja.js"></script>
    </body>
</html>