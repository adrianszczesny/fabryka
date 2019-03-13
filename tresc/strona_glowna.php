<?php 
/*
 * wyświetla logo z promocjami.liste produktów, itepe
 */
?>
<div class="row">
    <div class="col-md-12">
        <div class="thumbnail">
        <?php
            karuzela();
        ?>
        </div>
    </div>
  </div> 
<div class="row">
<?php 

// Wyświetla treśc głównej strony z produktami i kategoriami
?>
    </div>  
<div class="row">
<div class="col-md-10">
       <?php
       include("tresc/lista_produktow/lista.php");
       ?>
    <?php
    echo '<br><br>';
   
    // dodanie przykładowych danych do koszyka
    // dodaj_do_koszyka(2);
    // dodaj_do_koszyka(4);
    
    //echo "<hr>Liczba rzeczy w koszyku: ";
    //echo sprawdz_liczbe_w_koszyku();
    ?>
</div> 
</div>