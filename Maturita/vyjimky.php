<?php
/// Ošetřování chyb ///
//    Trénujte try-catch bloky, throw, a vlastní výjimky (dědíme objekt Exception)

/// Ukázkové řešení: ///
// Vytvočte funkci co se pokusí zapsat do souboru, pokud soubor neexistuje, vyhoďte výjimku.
// Pokud dojde k chybě, zachyťte ji v try-catch bloku a vypište chybovou hlášku.
// Vytvořte vlastní výjimku FileNotFoundException, která vypíše "File not found: <název souboru>".

// Vlastní vyjímka
class FileNotFoundException extends Exception {
    public function __construct($file) {
        parent::__construct("File not found: " . $file);
    }
}

// Funkce pro zápis do souboru
function writeToFile($filename, $content) {
    if (!file_exists($filename)) {
        throw new FileNotFoundException($filename);
    }
    file_put_contents($filename, $content);
}

// Použití funkce a ošetření výjimky
try {
    writeToFile("test.txt", "Hello, World!");
} catch (Exception $e) {
    echo $e->getMessage();
}
?>

<?php
/// Příklad 1. ///
// Vytvořte funkci, která dělá dělení dvou čísel a ošetřuje chybu dělení nulou.
// Pokud dojde k pokusu dělení nulou, vyhoďte výjimku a zachyťte ji v try-catch bloku.
// Vytvořte vlastní výjimku DivisionByZeroException, která vypíše "Dělení nulou není povoleno".

//Vyjimka
class DivisionByZeroException extends Exception {
    public function __construct() {
        parent::__construct("Dělení nulou není povoleno");
    }
}

// Funkce pro dělení
function divide($a, $b) {
    if ($b == 0) {
        throw new DivisionByZeroException();
    }

    return $a / $b;
}

// Použití
try {
    echo divide(10, 2) . "<br>";
    echo divide(10, 0) . "<br>"; // chyba
} catch (Exception $e) {
    echo "Chyba: " . $e->getMessage();
}
?>
<?php
/// Příklad 2. ///
// Vytvořte funkci, která validuje emailovou adresu.
// Pokud je email neplatný, vyhoďte výjimku a zachyťte ji v try-catch bloku.
// Pro připomenutí tvar emailu je vždy uživatel + zavináč + doména (email@domain.com)
// Vytvořte vlastní výjimku InvalidEmailException, která vypíše "Neplatná emailová adresa".

//vyjimka
class InvalidEmailException extends Exception {
    public function __construct() {
        parent::__construct("Neplatná emailová adresa");
    }
}

// Funkce pro validaci emailu
function validateEmail($email) {
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        throw new InvalidEmailException();
    }

    return true;
}

// Použití
try {
    $email = "testemail.com";

    if (validateEmail($email)) {
        echo "Email je v pořádku";
    }

} catch (Exception $e) {
    echo "Chyba: " . $e->getMessage();
}
?>