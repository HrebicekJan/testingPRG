<h1>Error handling</h1>

<?php

// Nedostek v peněžence
class NedostatekPenezException extends Exception
{
    public function __construct($zustatek, $vyber)
    {
        $zprava = "Nedostatek peněz! Zůstatek: $zustatek Kč, požadovaný výběr: $vyber Kč.";
        parent::__construct($zprava);
    }
}

// Bankomat
function vyberZuctu($zustatek, $castka)
{
    if ($castka > $zustatek) {
        // Vyhození vlastní výjimky
        throw new NedostatekPenezException($zustatek, $castka);
    }

    return $zustatek - $castka;
}

// Peněženka a výběr
$zustatek = 1000;
$vyber = 1500;

try {
    $novyZustatek = vyberZuctu($zustatek, $vyber);
    echo "Výběr proběhl úspěšně. Nový zůstatek: $novyZustatek Kč";
} catch (NedostatekPenezException $e) {
    echo "<h3 style='color:red;'>CHYBA 💩</h3>";
    echo $e->getMessage();
    echo "<br>Soubor: " . $e->getFile();
    echo "<br>Řádek: " . $e->getLine();
}

?>
