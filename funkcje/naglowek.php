<?php
    /*
     * Plik zawiera nagłówekv (górną belkę) strony wyświetlany na każdej podstronie
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
            <a class="navbar-brand" href="index.php">HOME</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav navbar-right">
			<?php
				w_pokaz_koszyk_dropdown();  
        // jeśli zalogowano
		
            if ($_SESSION['user']==1) 
            {   // jeśli klient, to przyciski dla klienta
                
				standardowy_przycisk("?v=tresc/p_zarzadzanie/p_panel", "Zarządzanie zamówieniami");
            }
            else if ($_SESSION['user']!=1) 
            {   // jeśli pracownik to przyciski dla pracownika
				standardowy_przycisk("?v=tresc/u_zamowienia/moje_zamowienia", "Moje zamówienia");
            }
            // przyciski dla wszystkich
            standardowy_przycisk("index.php", "Witaj <b>{$_SESSION['user']}</b>", 0);
            standardowy_przycisk("logout.php", "Wyloguj");
			?>
            </ul>
        </div>
    </div>
</nav>


