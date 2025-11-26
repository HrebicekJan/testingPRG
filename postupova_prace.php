<?php

// uživatel si zadá číslo, který chce
if ($_SERVER["REQUEST_METHOD"] === "POST")    
 $cislo = (int) $_POST['cislo'];

// absolutní hodnota pokud $cislo < 0
if ($cislo < 0) {
    echo "Absolutní hodnota čísla je: " . abs($cislo);
}

// faktorial
elseif ($cislo >= 0 && $cislo < 15) {
    $faktorial = 1;
    for ($i = 1; $i <= $cislo; $i++) {
        $faktorial *= $i;
    }
    echo "Faktoriál čísla $cislo je: " . $faktorial;
}

// zjistit, jestli je prvočíslo když $cislo >= 15
else {
    $jePrvocislo = true;

    if ($cislo < 2) {
        $jePrvocislo = false;
    } else {
        for ($i = 2; $i < $cislo; $i++) {
            if ($cislo % $i === 0) {
                $jePrvocislo = false;
                break;
            }
        }
    }

    if ($jePrvocislo) {
        echo "Číslo $cislo je prvočíslo.";
    } else {
        echo "Číslo $cislo není prvočíslo.";
    }
}

?>

<!-- TADY JE HTML! TADY JE HTML! TADY JE HTML! TADY JE HTML! TADY JE HTML! TADY JE HTML! TADY JE HTML! -->

<html lang="cs">
<head>
    <meta charset="UTF-8">
    <title>Zpracování čísla</title>
</head>
<body>

<h2>Zadej celé číslo:</h2>

<form method="post">
    <input type="number" name="cislo" required>
    <input type="submit" value="Zpracovat">
</form>
