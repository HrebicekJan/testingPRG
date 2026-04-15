<?php
/// Manipulace se soubory ///
//  Trénujte čtení, zapisování, a práci s řádky separátory v souborech ("\n"," \r\n", mezery - " ", atd.)

// Ukázkové řešení: //
// Vytvořte program, který načte soubor "znamky.csv"
// Vypočítejte průměr známek za každý řádek přidávajíc na konec řádku tento výsledny průměr (zaokrouhlený na 2 desetinná místa)

// Příklad vstupu (znamky.csv):
//      1;2;3;4;5;3
//      2;3;4;5;1;1;3
//      3;4;5;1;2
// Příklad výstupu (znamky.csv):
//      1;2;3;4;5;3 = 3
//      2;3;4;5;1;1;3 = 2.72
//      3;4;5;1;2 = 3

// Načteme a rozbijeme obsah souboru na jednotlivé řádky
$content = file_get_contents("znamky.csv");
$lines = explode("\n", $content);

// Vytvoříme prázdné pole pro uložení výstupu
$output = [];

foreach ($lines as $line) {
    // Rozdělíme každý řádek na jednotlivá čísla
    $numbers = explode(";", $line);

    // Vytvoříme pomocné proměnné pro výpočet průměru
    $sum = 0;
    $count = 0;

    foreach ($numbers as $number) {
        // Převedeme každou hodnotu na desetiné číslo a přičteme ji k součtu
        $sum += floatval($number);
        $count++;
    }

    // Vypočítáme průměr a přidáme ho na konec původního řádku
    $average = $sum / $count;
    $output[] = "$line = " . round($average, 2);
}

// Složení řádků výstupu do nového souboru
file_put_contents($file, implode("\n", $output));

?>

<?php
/// PŘÍKLAD 1. ///
// Sestavte program který bude číst soubor formátu CSV (Comma Separated Values) a vypíše jeho obsah do html tabulky (nebo pouze pod sebe).
// Vstupem programu bude název souboru, který bude obsahovat seznam produktů (id;name;type;price)
// Jednotlivé hodnoty budou odděleny středníkem a nové řádky budou odděleny znakem "\n" (Linux zakončení).
// Program načte soubor, a poté pro každý řádek vytvoří nový řádek v tabulce. (nezapomente na hlavičku tabulky)
// Pokud je soubor prázdný, program vypíše "Soubor je prázdný".
?>

<?php
$file = "produkty.csv";

if (!file_exists($file) || filesize($file) == 0) {
    echo "Soubor je prázdný";
    exit;
}

$content = file_get_contents($file);
$lines = explode("\n", trim($content));

echo "<table border='1' cellpadding='5'>";
echo "<tr>
        <th>ID</th>
        <th>Název</th>
        <th>Typ</th>
        <th>Cena</th>
      </tr>";

foreach ($lines as $line) {
    $data = explode(";", $line);

    echo "<tr>";
    foreach ($data as $value) {
        echo "<td>" . htmlspecialchars($value) . "</td>";
    }
    echo "</tr>";
}

echo "</table>";
?>

<?php
/// PŘÍKLAD 2. ///
// Najdi starší 18 leté osoby v souboru a ulož je do nového souboru.
// Vstupem programu bude název souboru, který bude obsahovat seznam jmen a věků. 
// Jednotlivá jména a věky budou oddělena čárkou a nové řádky budou odděleny znakem "\n" (Linux zakončení).
// Program načte soubor, a poté pro každou osobu zkontroluje, zda je starší 18 let. 
// Pokud ano, zapíše jejich jméno a věk do nového souboru, tentokrát se novým řádkem "\r\n" (Windows zakončení).
?>

<?php
$inputFile = "osoby.txt";
$outputFile = "dospeli.txt";

if (!file_exists($inputFile)) {
    echo "Vstupní soubor neexistuje.";
    exit;
}

$content = file_get_contents($inputFile);
$lines = explode("\n", trim($content));

$output = [];

foreach ($lines as $line) {
    $data = explode(",", $line);

    if (count($data) == 2) {
        $jmeno = trim($data[0]);
        $vek = (int)trim($data[1]);

        if ($vek > 18) {
            $output[] = "$jmeno,$vek";
        }
    }
}

// Uložení s Windows konci řádků
file_put_contents($outputFile, implode("\r\n", $output));

echo "Hotovo.";
?>
<?php
/// PŘÍKLAD 3. ///
// Vstup uživatele z formuláře budeme přidávat na konec souboru.
// Vytvořte formulář, který bude mít pole pro jméno a příjmení.
// Po odeslání formuláře pokud soubor neexistuje, vytvořte ho.
// Dále se jméno a příjmení přidá na konec souboru "uzivatele.txt".
// Nové řádky budou odděleny znakem "\n" (Linux zakončení) a jméno a příjmení budou odděleny mezerou (Jan Novák)
?>
<?php
$file = "uzivatele.txt";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $jmeno = trim($_POST["jmeno"]);
    $prijmeni = trim($_POST["prijmeni"]);

    if (!empty($jmeno) && !empty($prijmeni)) {

        $zaznam = $jmeno . " " . $prijmeni . "\n";

        // vytvoří soubor pokud neexistuje + přidá na konec
        file_put_contents($file, $zaznam, FILE_APPEND);

        echo "Uživatel uložen.<br>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Uživatelé</title>
</head>
<body>

<form method="POST">
    <input type="text" name="jmeno" placeholder="Jméno" required><br>
    <input type="text" name="prijmeni" placeholder="Příjmení" required><br>
    <input type="submit" value="Uložit">
</form>

</body>
</html>