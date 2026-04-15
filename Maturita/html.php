<?php
/// Webový design ///
// Trénujte tvorbu a stylování textů, listů, tabulek, formulářů a dalších prvků pomocí HTML a CSS
// Také se zaměřte na layout a základní design meny a obsahu.
// Důležité jsou CSS koncepty jako Box model, Flexbox a Position.
// Zadání může být formou obrázku designu nebo popisu.

/// Ukázkové řešení ///
// Vytvořte tabulku transakcí pro administraci banky
// Tabulka by měla mít sloupce: ID, Datum, Typ transakce (příchozí, odchozí), Částka
// Nad tabulkou by měl být formulář jakožto filtr pro zobrazení transakcí podle data a typu
// Funkčnost filtru neimplementujeme! Pouze statický HTML/CSS kód
// Tabulka bude mít označený řádek hlavičky tučně a s lehkým pozadím
// Také bude provzdušněná paddingem s collapsovanými buňkami a tenkým okrajem
// Řádek po najetí (hover) změní barvu pozadí na světle šedou.

/// Řešení: ///
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Tabulka transakcí</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            padding: 10px;
            text-align: left;
            border: 1px solid #ddd;
        }

        th {
            background-color: #f2f2f2;
            font-weight: bold;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        tr:hover {
            background-color: #e0e0e0;
        }
    </style>
</head>

<body>
    <h1>Tabulka transakcí</h1>
    <form method="GET" action="">
        <label for="date">Datum:</label>
        <input type="date" id="date" name="date">
        <label for="type">Typ transakce:</label>
        <select id="type" name="type">
            <option value="">Vše</option>
            <option value="incoming">Příchozí</option>
            <option value="outgoing">Odchozí</option>
        </select>
        <input type="submit" value="Filtruj">
    </form>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Datum</th>
                <th>Typ transakce</th>
                <th>Částka</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>1</td>
                <td>2023-10-01</td>
                <td>Příchozí</td>
                <td>1000 Kč</td>
            </tr>
            <tr>
                <td>2</td>
                <td>2023-10-02</td>
                <td>Odchozí</td>
                <td>-500 Kč</td>
            </tr>
            <!-- Další řádky ... -->
        </tbody>
    </table>
</body>
</html>


<?php
/// Příklad 1. ///
// Vytvořte jednoduchou HTML stránku s formulářem pro zadání jména a e-mailu
// Po odeslání formuláře vypište zadané údaje na stránku
// Formulář vycentrujte na stránce a odělte vstupy tak aby vizuálně nesplívaly.
?>

<?php
$name = "";
$email = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $email = $_POST["email"];
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Formulář</title>
    <style>
        body {
            font-family: Arial;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            border: 1px solid #ddd;
            padding: 20px;
            border-radius: 8px;
            width: 300px;
        }

        input {
            width: 100%;
            padding: 8px;
            margin: 8px 0;
        }

        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }

        .result {
            margin-top: 15px;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Kontaktní formulář</h2>
    <form method="POST">
        <input type="text" name="name" placeholder="Jméno" required>
        <input type="email" name="email" placeholder="E-mail" required>
        <input type="submit" value="Odeslat">
    </form>

    <?php if ($name && $email): ?>
        <div class="result">
            <p><strong>Jméno:</strong> <?= htmlspecialchars($name) ?></p>
            <p><strong>E-mail:</strong> <?= htmlspecialchars($email) ?></p>
        </div>
    <?php endif; ?>
</div>

</body>
</html>

/// Příklad 2. ///
// Sestavte layout pro jednoduchou webovou stránku
// Stránka by měla mít hlavičku, menu, hlavní obsah a patičku
// Tlačítka meny budou rovnoměrně rozložena a budou mít hover efekt
// Hlavní obsah bude mít dvě sekce vedle sebe (obrázek 30% a text 70%)
// Patička bude mít tmavé pozadí a bílý text
// Všechny prvky budou mít padding a margin pro lepší vzhled
// Použijte Flexbox pro rozložení prvků podle potřeby

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Layout stránky</title>
    <style>
        body {
            margin: 0;
            font-family: Arial;
        }

        header {
            background: #4CAF50;
            color: white;
            padding: 20px;
            text-align: center;
        }

        nav {
            display: flex;
            background: #333;
        }

        nav a {
            flex: 1;
            padding: 15px;
            color: white;
            text-align: center;
            text-decoration: none;
        }

        nav a:hover {
            background: #555;
        }

        .content {
            display: flex;
            padding: 20px;
            gap: 20px;
        }

        .image {
            flex: 3;
        }

        .image img {
            width: 100%;
        }

        .text {
            flex: 7;
        }

        footer {
            background: #222;
            color: white;
            text-align: center;
            padding: 15px;
        }
    </style>
</head>

<body>

<header>
    <h1>Moje stránka</h1>
</header>

<nav>
    <a href="#">Domů</a>
    <a href="#">O nás</a>
    <a href="#">Služby</a>
    <a href="#">Kontakt</a>
</nav>

<div class="content">
    <div class="image">
        <img src="https://via.placeholder.com/300" alt="Obrázek">
    </div>
    <div class="text">
        <h2>Hlavní obsah</h2>
        <p>
            Toto je ukázkový text hlavního obsahu stránky.
            Flexbox zajišťuje rozložení 30% obrázek a 70% text.
        </p>
    </div>
</div>

<footer>
    <p>&copy; 2026 Moje stránka</p>
</footer>

</body>
</html>

/// Příklad 3. ///
// Na stránce budou poznámky z literatury
// Nastyluje rozbalovací summarizaci pro každou knihu s listem důležitých informací a shrnutím knihy
// Všechny knihy budou mít stejný formát a budou se rozbalovat po kliknutí (<details> a <summary>)

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Literatura</title>
    <style>
        body {
            font-family: Arial;
            margin: 20px;
        }

        details {
            border: 1px solid #ddd;
            border-radius: 5px;
            padding: 10px;
            margin-bottom: 10px;
        }

        summary {
            font-weight: bold;
            cursor: pointer;
        }

        ul {
            margin-top: 10px;
        }
    </style>
</head>

<body>

<h1>Poznámky z literatury</h1>

<details>
    <summary>Romeo a Julie</summary>
    <ul>
        <li><strong>Autor:</strong> William Shakespeare</li>
        <li><strong>Žánr:</strong> Drama</li>
        <li><strong>Rok vydání:</strong> 1597</li>
        <li><strong>Postavy:</strong> Romeo, Julie</li>
        <li><strong>Témata:</strong> Láska, nenávist, osud</li>
        <li><strong>Citát:</strong> "Láska je jako víno..."</li>
    </ul>

    <p>
        Romeo a Julie je tragédie o dvou mladých milencích,
        jejichž láska končí tragicky kvůli sporům rodin.
    </p>
</details>

<details>
    <summary>Malý princ</summary>
    <ul>
        <li><strong>Autor:</strong> Antoine de Saint-Exupéry</li>
        <li><strong>Žánr:</strong> Pohádka</li>
        <li><strong>Rok vydání:</strong> 1943</li>
        <li><strong>Témata:</strong> Přátelství, láska, smysl života</li>
    </ul>

    <p>
        Příběh o malém chlapci z jiné planety, který poznává svět a lidské hodnoty.
    </p>
</details>

</body>
</html>

// Příklad Obsahu:
// Romeo a Julie
// - Autor: William Shakespeare
// - Žánr: Drama
// - Rok vydání: 1597
// - Hlavní postavy: Romeo, Julie
// - Důležitá témata: Láska, nenávist, osud
// - Citát: "Láska je jako víno, čím déle zraje, tím je lepší."
//  Shrnutí
//      Romeo a Julie je tragédie o dvou mladých milencích, jejichž láska je odsouzena k neúspěchu kvůli rodinným sporům. Jejich smrt nakonec smíří jejich rodiny.
//      Hlavními tématy jsou láska, nenávist a osud. Příběh ukazuje, jak moc může láska ovlivnit životy jednotlivců a jak tragické následky mohou mít rodinné spory.


