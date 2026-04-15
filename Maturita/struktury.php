<?php
/// Strukturované programování (základní syntax) ///
// Tato cvičení zahrnují algoritmizaci a strukturované programování.
// Práce s posloupnoustí kódu, větvení, funkce a kontrolou vstupů.

// Ukázkové řešení: //

// Validuj jméno a heslo příchozího formuláře s následujícími pravidly:
//  Hesla se musí shodovat a mít alespoň 8 znaků
//  Jméno musí mít alespoň 3 znaky a nesmí obsahovat mezery
//  Pokud je vše v pořádku, vypiš "OK" a přesměruj na jinou stránku
//  Pokud je něco špatně, vypiš chybovou hlášku
$username = "USER";
$pass = "PASS";
$passAgain = "PASS";

$isValid = true;

// Kontrola hesla
if (strlen($pass) < 8) {
    echo "Heslo musí mít alespoň 8 znaků.";
    $isValid = false;
} elseif (!str_contains($pass, '#')) {
    echo "Heslo musí obsahovat hashtag (#)";
    $isValid = false;
}

// Kontrola shody hesel
if ($pass !== $passAgain) {
    echo "Hesla se neshodují.";
    $isValid = false;
}

// Kontrola jména
if (strlen($username) < 3 || str_contains($username, ' ') !== false) {
    echo "Jméno musí mít alespoň 3 znaky a nesmí obsahovat mezery.";
    $isValid = false;
}

if (!$isValid) {
    echo "Omlouváme se, ale došlo k chybě při validaci.";
} else {
    echo "OK";
    die();
}





/// PŘÍKLAD 1. ///

// Vstupní číslo musí být validováno, zdali je celé číslo a dělitelné 3 nebo 6
// Vstupní proměná musí být číslo
// Číslo musí být větší než 0
// Číslo nesmí být dělitelná 3 nebo 6
// Pokud je číslo validní, vypiš "OK"
//  Pokud je něco špatně, vypiš chybovou hlášku
?>

<?php
$input = 10;

$isValid = true;

if (!is_numeric($input) || intval($input) != $input) {
    echo "Vstup musí být celé číslo.<br>";
    $isValid = false;
}

if ($input <= 0) {
    echo "Číslo musí být větší než 0.<br>";
    $isValid = false;
}

if ($input % 3 == 0 || $input % 6 == 0) {
    echo "Číslo nesmí být dělitelné 3 ani 6.<br>";
    $isValid = false;
}

if ($isValid) {
    echo "OK";
}
?>
<?php
/// PŘÍKLAD 2. ///

// Napiště program co bude převádět mezi různými metrickými jednotkami (litry, mililitry, decilitry, hektolitry)
// První proměná bude desetiné číslo
// Druhá proměná bude typ jednotky na vstupu (l, ml, dl, hl)
// Třetí proměná bude typ jednotky na výstupu (l, ml, dl, hl)
// Výstupem bude převedená hodnota a její jednotka  Např. 1.5 l = 1500 ml
// Validujte vstupy jesli odpovídají číselné hodnotě desetiného čísla a jestli je jednotka správná

$value = 1.5;
$from = "l";
$to = "ml";

$units = [
    "ml" => 1,
    "dl" => 100,
    "l"  => 1000,
    "hl" => 100000
];

if (!is_numeric($value)) {
    echo "Hodnota musí být číslo.";
    exit;
}

if (!isset($units[$from]) || !isset($units[$to])) {
    echo "Neplatná jednotka.";
    exit;
}

// převod na základní jednotku (ml)
$inMl = $value * $units[$from];

// převod na cílovou jednotku
$result = $inMl / $units[$to];

echo "$value $from = $result $to";
?>

<?php
/// PŘÍKLAD 3. ///

// Napište program, který bude kontrolovat, zda zadané číslo je prvočíslo
// Vstupní proměnná musí být celé číslo větší než 1
// Pokud není číslo dělitelné všemi čísli pod ním vypiš "Číslo je prvočíslo"
// Pokud není, vypiš "Číslo není prvočíslo"
// Pokud vstup není validní, vypiš chybovou hlášku

$n = 7;

if (!is_numeric($n) || intval($n) != $n || $n <= 1) {
    echo "Neplatný vstup.";
    exit;
}

$isPrime = true;

for ($i = 2; $i < $n; $i++) {
    if ($n % $i == 0) {
        $isPrime = false;
        break;
    }
}

if ($isPrime) {
    echo "Číslo je prvočíslo";
} else {
    echo "Číslo není prvočíslo";
}
?>

<?php
/// PŘÍKLAD 4. ///

// Vlak jezdí každou 45 minutu v hodině. Na základě vstupní hodnoty času určete, kolik minut zbývá od posledního a do následujícího vlaku 
// Vstupní proměná bude čas ve formátu HH:MM (24 hodinový formát)
// Pokud je čas validní, spočítek kolik minut zbývá do dalšího vlaku a o kolik minut ujel poslední vlak.
// Pokud čas není validní, vypiš chybovou hlášku

$time = "10:20";

if (!preg_match("/^\d{2}:\d{2}$/", $time)) {
    echo "Neplatný formát času.";
    exit;
}

list($h, $m) = explode(":", $time);

if ($h < 0 || $h > 23 || $m < 0 || $m > 59) {
    echo "Neplatný čas.";
    exit;
}

// interval vlaku
$interval = 45;

// kolik minut od posledního vlaku
$sinceLast = $m % $interval;

// kolik minut do dalšího vlaku
$toNext = $interval - $sinceLast;

if ($sinceLast == 0) {
    $toNext = 0;
}

echo "Od posledního vlaku: $sinceLast minut<br>";
echo "Do dalšího vlaku: $toNext minut";
?>

<?php
/// PŘÍKLAD 5. ///

// Vytvoř program, který spočítá kvadratickou rovnici
// Vstupní proměné budou a, b, c .. počítáme rovnici (ax² + b x + c = 0)
// Postup algortitmu:
//  1. Zjisti zda je vstupní proměná validní (a,b,c musí být číslo)
//  2. Zjisti zda je a != 0
//  3. Spočítej diskriminant (D = b² - 4ac)
//  4. Pokud je D > 0, vypočítej x1 a x2, jinak vypiš "Rovnice nemá reálné řešení"
// Matematické řešení:
//  x1,2 = (-b ± √(b² - 4ac)) / 2a 
//  x1 = (-b + √D) / 2a
//  x2 = (-b - √D) / 2a

$a = 1;
$b = -3;
$c = 2;

if (!is_numeric($a) || !is_numeric($b) || !is_numeric($c)) {
    echo "Neplatné vstupy.";
    exit;
}

if ($a == 0) {
    echo "a nesmí být 0.";
    exit;
}

$D = $b * $b - 4 * $a * $c;

if ($D < 0) {
    echo "Rovnice nemá reálné řešení.";
} else {
    $x1 = (-$b + sqrt($D)) / (2 * $a);
    $x2 = (-$b - sqrt($D)) / (2 * $a);

    echo "x1 = $x1<br>";
    echo "x2 = $x2";
}
?>

<?php
/// PŘÍKLAD 6. ///
// Vytvořte program, který bude zjišťovat slevu na jízdné podle věku a stavu studenta
// Vstupní proměnné budou věk (int) a stav studenta (bool)
// Podle následujících pravidel vypiš slevu:
//    0-6 let = 100% sleva
//    7-18 let = 50% sleva
//    18-26 let a zároveň student = 25% sleva
//    27-60 let = 0% sleva
//    60+ let = 50% sleva
// *validuj vstupy a pokud je věk menší než 0 nebo větší než 120, vypiš "Neplatný věk"

$vek = 20;
$student = true;

if (!is_numeric($vek) || $vek < 0 || $vek > 120) {
    echo "Neplatný věk";
    exit;
}

$sleva = 0;

if ($vek <= 6) {
    $sleva = 100;
} elseif ($vek <= 18) {
    $sleva = 50;
} elseif ($vek <= 26 && $student) {
    $sleva = 25;
} elseif ($vek <= 60) {
    $sleva = 0;
} else {
    $sleva = 50;
}

echo "Sleva: $sleva %";
?>