<?php

$a = 2;
$b = 6;
$c = -20;

$D = $b * $b - 4 * $a * $c;
$Dsqrt=sqrt($D);

if ($D==0) {
    echo "Rovnice má 1 řešení";
}

if ($D>0) {
    echo "Rovnice má dva různé realné kořeny";
}

if ($D<0) {
    echo "Rovnice nemá řešení";
}

$X1=(-$b+$Dsqrt)/(2*$a);
$X2=(-$b-$Dsqrt)/(2*$a);

echo "<br>X1 se rovná $X1";
echo "<br> X2 se rovná $X2";

?>