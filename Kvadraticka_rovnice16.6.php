<?php

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['a'], $_POST['b'], $_POST['c'])) {
    $a = $_POST['a'];
    $b = $_POST['b'];
    $c = $_POST['c'];

    // Kontrola, zda A není nula (nulou dělit nelze přece :DDDDDD)
    if ($a == 0) {
        echo "Toto není kvadratická rovnice (a nesmí být 0).";
        exit;
    }

    $D = $b * $b - 4 * $a * $c;

    echo "<h3>Výpočet kvadratické rovnice: {$a}x² + {$b}x + {$c} = 0</h3>";
    echo "Diskriminant (D) = $D<br><br>";

    if ($D > 0) {
        $Dsqrt = sqrt($D);
        $X1 = (-$b + $Dsqrt) / (2 * $a);
        $X2 = (-$b - $Dsqrt) / (2 * $a);
        echo "Rovnice má <strong>dvě reálná řešení</strong>:<br>";
        echo "x₁ = $X1<br>";
        echo "x₂ = $X2";
    } elseif ($D == 0) {
        $X = -$b / (2 * $a);
        echo "Rovnice má <strong>jedno reálné řešení</strong>:<br>";
        echo "x = $X";
    } else {
        echo "Rovnice <strong>nemá reálné řešení</strong>.";
    }
}
?>

<!DOCTYPE html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <title>Kvadratická rovnice</title>
</head>
<body>
    <h2>Zadej koeficienty kvadratické rovnice (ax² + bx + c = 0):</h2>
    <form method="post">
        <label for="a">a:</label>
        <input type="number" step="any" name="a" id="a" required><br><br>

        <label for="b">b:</label>
        <input type="number" step="any" name="b" id="b" required><br><br>

        <label for="c">c:</label>
        <input type="number" step="any" name="c" id="c" required><br><br>

        <input type="submit" value="Vypočítej">
    </form>
</body>
</html>
