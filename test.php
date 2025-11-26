<?php
$cisla = [2, 4, 5, 1, 8, 6];
$nejmensi = 10;
for ($i = 0; $i < count($cisla); $i++){
    $aktualni_prvek = $cisla[$i];
    if ($aktualni_prvek < $nejmensi){
        $nejmensi = $aktualni_prvek;
    }
}
echo $nejmensi;
?>