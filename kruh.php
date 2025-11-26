<?php
//VSTUP
$r = 20;

if ($r > 0) {
$S = pi() * $r^2;
$o = 2 * pi() * $r;

//VÝSTUP
echo "obsah kruhu je:" . $S . "cm^2\n";
echo "obvod kruhu je:" . $o .  "cm";

} else {
    //VÝSTUP - chyba
    echo "Pozor, nelze zadat záporné číslo.";
}

?>