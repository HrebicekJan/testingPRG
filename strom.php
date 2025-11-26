<?php

///     Najdi problém/y a doplň     ///
// Chceme troj-úhelník obrácený špičkou DOLŮ !!!
# # # #
# # #
# #
#
$znakPixelu = '#';
$vyska = 10;
for ($radky = 0; $radky < $vyska; $radky++) {
    // Bude víc a víc znaku na řáešk podle toho kolikátý řádek toe
    $kolikZnakuNaRadek = $radky + 1;
    for ($linka = $vyska+1; $linka > $kolikZnakuNaRadek; $linka--) {
        // Na kazdem probehne cyklu pro vypsání znaků zasebou
        echo $znakPixelu . " ";
    };
    echo "<br>";
}
?>