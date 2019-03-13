<div class="row">
<h1>Panel pracownika</h1>
<div id="z_panel_menu_lewe" class="col-md-3">
    <ul class="nav nav-pills nav-stacked thumbnail">
        <?php
        // $plik to adres do tego pliku. Zrobiono dla wygody
        $plik = "?v=tresc/pracownik/zadania";
        $lox = "tresc/pracownik/";
        // przyciski do podstron
        standardowy_przycisk("{$plik}&prawa={$lox}z_nowe/p_nowe_zamowienia", "Zadania");
        standardowy_przycisk("{$plik}&prawa={$lox}z_moje/p_zamowienia_przetwarzane", "Zadania przetwarzane");
        standardowy_przycisk("{$plik}&prawa={$lox}z_stare/p_zamowienia_archiwalne", "Zadania wykonane");
       ?>
    </ul>
</div>
<div id="z_panel_tresc_prawa" class="col-md-9">
    <div class="thumbnail">
    <?php
    // dołączmy plik z $_GET['prawa']
	dolacz_plik("prawa", "{$lox}z_nowe/p_nowe_zamowienia"); 
    ?>
    </div>
</div>
</div>