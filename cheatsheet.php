<?php

    /// PROMĚNNÉ ///

$cislo = 999;
$text = "Hello world";
$desetina = 3.14;
$pole = [2, 3, 4, 6, 8];
$objekt = new Ucitel("Wisman", ["HW", "OS"])

// Pravdivostní
$je_student = true; // | true || false | (Boolean)

    /// PODMÍNKY ///

// Podmínkové operátory
$otazka = ($cislo == 100)
$otazka = ($cislo >= 100)

if (OTAZKA) {
    // Pokud je OTAZKA pravda (true)
} else {
    //Pokud je OTAZKA nepravda (false)
}

            /// Matematické operátory ///
// Počítání s čísly
$vysledek = $cele + 5; //  + - * - 
$zbytek = 13 % 5; // znak modulo -> zbytek po deleni
$v = 3 + 6 - ($cislo * 3) / $desetine;
$v = pow($zaklad, $mocnina); //+ Mocnina
$squareRoot = sqrt($zaklad); //+ Druhá odmocnina
// Zaokrouhlujeme round(), zaokr. nahoru ceil() a dolu floor()
// Modifikace proměnné [ +=  -=  /=  *= ]
$desetine += 10.2; // přičte a uloží
$desetine /= 2; // vydělí a uloží
$desetine++; $desetine--; // Přídá / Odebere pouze jedničku

            /// Manipulace s řetězci ///

$jmeno = "Pavle"; // Uvozovky dvojího typu ( " / ' )
$jmeno = 'Pavle';
$pozdrav = "Hello" . "World" . "<br>"; // Skládání tečkou (A . B)
// Skládání s proměnou
$pozdrav = "Ahoj, jak se máš " . $jmeno;
//+ Vložená proměnná (! pozor funguje pouze u dvojtých uvozovek)
$pozdrav = "Ahoj, jmenuji se $jmeno. Je mi $vek,";

// Modifikace proměnné [ .= ]
$pozdrav .= " bydlím na moravě a tancuju polku.";

        /// Cyklusy ///

// For       // čísla 0 - 10
for ($i = 0; $i < 11; $i++) {
    echo "[$i] ";
}


        /// FUNKCE ///

function naDruhou($a) {
    $vysledekk = $a * $a;
    return $vysledekk;
}

// Zavolání funkce (CALL)
$p = naDruhou(5);

echo $p;







?>