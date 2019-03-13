<?php
    /*
     * Plik zawiera nag³ówekv (górn¹ belkê) strony wyœwietlany na ka¿dej podstronie
     */
?><!-- Navigation Bar-->
<nav class="navbar navbar-default navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar"
                    aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="headw.php">HOME</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav navbar-right">
			<?php
			standardowy_przycisk("zadania.php", "Moje zadania");
            standardowy_przycisk("headw.php", "Witaj <b>{$_SESSION['worker']}</b>", 0);
            standardowy_przycisk("logout.php", "Wyloguj");
			?>
            </ul>
        </div>
    </div>
</nav>
