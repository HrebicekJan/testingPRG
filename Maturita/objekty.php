<?php
/// Objektové programování (OOP) ///

// Ukázkové řešení: //
// Vytvořte třídu "Auto" s vlastnostmi "značka", "barva" a "počet kol" (použijte zapouzdření a dodžujte zásady OOP)
// Vytvořte metodu "vypsatInfo", která vypíše informace o autě  
// Vytvořte meodu "zmenitBarvu", která změní barvu auta
// Vytvořte instanci třídy "Auto" a zavolejte metodu "vypsatInfo"

class Auto {
    // Vlastnosti
    private $znacka;
    private $barva;
    private $pocetKolu;

    /// Konstruktor - zavolaný při vytvoření instance
    function __construct($znacka, $barva, $pocetKolu)
    {
        // Sestavujeme zde objekt z příchozích hodnot
        $this->znacka = $znacka;
        $this->barva = $barva;
        $this->pocetKolu = $pocetKolu;
    }

    // Metoda pro změnu barvy
    public function zmenitBarvu($novaBarva) {
        $this->barva = $novaBarva;
    }

    // Metoda pro výpis informací
    public function vypsatInfo() {
        echo "~ $this->znacka <br>";
        echo "Barva: $this->barva <br>";
        echo "Počet kol: $this->pocetKolu";
    }
}

// Vytvoření objektu (instance)
$mojeAuto = new Auto("ŠKODA", "modrá", 4);
$mojeAuto->vypsatInfo();


/// Příklad 1. ///

class Film {
    private $nazev;
    private $rok;
    private $hodnoceni;

    function __construct($nazev, $rok, $hodnoceni) {
        $this->nazev = $nazev;
        $this->rok = $rok;
        $this->hodnoceni = $hodnoceni;
    }

    public function zmenitHodnoceni($noveHodnoceni) {
        $this->hodnoceni = $noveHodnoceni;
    }

    public function vypsatInfo() {
        echo "Film: $this->nazev <br>";
        echo "Rok: $this->rok <br>";
        echo "Hodnocení: $this->hodnoceni % <br>";
    }
}

$film = new Film("Inception", 2010, 90);
$film->vypsatInfo();

// Vytvořte třídu "Film" s vlastnostmi "název", "rok" a "hodnocení" (použijte zapouzdření a dodžujte zásady OOP)
// Vytvořte metodu "zmenitHodnoceni", která změní hodnocení filmu
// Vytvořte metodu "vypsatInfo", která vypíše informace o filmu
// Vytvořte instanci třídy "Film" a zavolejte metodu "vypsatInfo"



/// Příklad 2. ///

class Student {
    private $jmeno;
    private $prijmeni;
    private $znamky = [];

    function __construct($jmeno, $prijmeni) {
        $this->jmeno = $jmeno;
        $this->prijmeni = $prijmeni;
    }

    public function pridatZnamku($znamka) {
        $this->znamky[] = $znamka;
    }

    public function vypocitatPrumer() {
        if (count($this->znamky) == 0) return 0;

        $soucet = array_sum($this->znamky);
        $prumer = $soucet / count($this->znamky);

        echo "Průměr studenta $this->jmeno $this->prijmeni je: $prumer";
    }
}

$student = new Student("Jan", "Novák");
$student->pridatZnamku(1);
$student->pridatZnamku(2);
$student->pridatZnamku(3);
$student->vypocitatPrumer();

// Vytvořte třídu "Student" s vlastnostmi "jméno", "příjmení" a "známky" (použijte zapouzdření a dodžujte zásady OOP)
// Vytvořte metodu "pridatZnamku", která přidá známku do pole známek
// Vytvořte metodu "vypocitatPrumer", která vypočítá průměr známek
// Vytvořte instanci třídy "Student" a zavolejte metodu "vypocitatPrumer"



/// Příklad 3. ///

class Obdelnik {
    private $sirka;
    private $vyska;

    function __construct($sirka, $vyska) {
        $this->sirka = $sirka;
        $this->vyska = $vyska;
    }

    public function vypocitatObsah() {
        return $this->sirka * $this->vyska;
    }

    public function vypocitatObvod() {
        return 2 * ($this->sirka + $this->vyska);
    }
}

$obdelnik = new Obdelnik(5, 3);

echo "Obsah: " . $obdelnik->vypocitatObsah() . "<br>";
echo "Obvod: " . $obdelnik->vypocitatObvod();

// Vytvořte třídu "Obdelník" s vlastnostmi "šířka" a "výška" (použijte zapouzdření a dodžujte zásady OOP)
// Vytvořte metodu "vypocitatObsah", která vypočítá obsah obdélníku
// Vytvořte metodu "vypocitatObvod", která vypočítá obvod obdélníku
// Vytvořte instanci třídy "Obdelník" a zavolejte metodu "vypocitatObsah" a "vypocitatObvod"



/// Příklad 4. ///
// Vytvořte třídu "Kalkulacka" se statickou metodou "secti", která sečte dvě čísla
// Vytvořte statickou metodu "odecti", která odečte dvě čísla
// Zavolejte obě metody bez vytváření instance třídy

class Kalkulacka {

    public static function secti($a, $b) {
        return $a + $b;
    }

    public static function odecti($a, $b) {
        return $a - $b;
    }
}

echo Kalkulacka::secti(5, 3) . "<br>";
echo Kalkulacka::odecti(10, 4);

// Příklad 5. ///
// Třída "Ukol" bude reprezentovat připomínku z úkolovníku, který umožní pracovat s daty a statusem.
// Vlastnosti: datum vyřešení (DateTime), popis úkolu k připomenutí a status vyřešení.
// Metody:
// - kolikCasuZbyva() - vrátí počet dní do vyřešení úkolu
// - vypisStatus() - vypíše "Vyřešeno" pokud odpovídá status, jinak vypíše kolik zbívá dní.
// - vratDatumUdalosti() - vrátí datum konkrétní události
// - nastavitDatum($den, $mesic, $rok) - nastaví datum události podle zadaných promených
// - nastavitVyreseno() - nastaví status na true

class Ukol {
    private $datum;
    private $popis;
    private $vyreseno = false;

    function __construct($datum, $popis) {
        $this->datum = new DateTime($datum);
        $this->popis = $popis;
    }

    public function kolikCasuZbyva() {
        $dnes = new DateTime();
        $rozdil = $dnes->diff($this->datum);
        return (int)$rozdil->format("%r%a");
    }

    public function vypisStatus() {
        if ($this->vyreseno) {
            echo "Vyřešeno - $this->popis <br>";
        } else {
            echo "Zbývá " . $this->kolikCasuZbyva() . " dní do vyřešení úkolu - $this->popis <br>";
        }
    }

    public function vratDatumUdalosti() {
        return $this->datum;
    }

    public function nastavitDatum($den, $mesic, $rok) {
        $this->datum->setDate($rok, $mesic, $den);
    }

    public function nastavitVyreseno() {
        $this->vyreseno = true;
    }

    public function jeVyreseno() {
        return $this->vyreseno;
    }

    public function getPopis() {
        return $this->popis;
    }
}


// Příklad 6. ~ navazující na Příklad 5. ///
// Třída "Ukolovnik" bude reprezentovat úkolovník, který umožní spravovat více úkolů jako pole objektů.
// Metody:
// - pridatUkol($reminder) - přidá úkol (objekt Reminder) do úkolovníku
// - odstranitUkol($index) - odstraní úkol podle indexu z pole
// - vypsatUkoly($vyresene) - vypíše všechny úkoly, které jsou vyřešené (true) nebo nevyřešené (false) dle parametru

class Ukolovnik {
    private $ukoly = [];

    public function pridatUkol($ukol) {
        $this->ukoly[] = $ukol;
    }

    public function odstranitUkol($index) {
        if (isset($this->ukoly[$index])) {
            unset($this->ukoly[$index]);
            $this->ukoly = array_values($this->ukoly);
        }
    }

    public function vypsatUkoly($vyresene) {
        foreach ($this->ukoly as $ukol) {
            if ($ukol->jeVyreseno() == $vyresene) {
                $ukol->vypisStatus();
            }
        }
    }
}

/// Příklad 7. ///
// Příklad základní dědičnosti
// Vytvořte třídu "Zamestnanec" s vlastnostmi "jméno", "příjmení" a "plat"
// Vytvořte metodu "vypisInfo", která vypíše informace o zaměstnanci
// Vytvořte třídu "Manazer", která dědí z třídy "Zamestnanec" a přidá navíc vlastnost "oddělení"
// Vytvořte metodu "vypisInfo", která vypíše informace o manažerovi
// Vytvořte instanci třídy "Manazer" a zavolejte metodu "vypisInfo"

class Zamestnanec {
    protected $jmeno;
    protected $prijmeni;
    protected $plat;

    function __construct($jmeno, $prijmeni, $plat) {
        $this->jmeno = $jmeno;
        $this->prijmeni = $prijmeni;
        $this->plat = $plat;
    }

    public function vypisInfo() {
        echo "$this->jmeno $this->prijmeni - Plat: $this->plat Kč <br>";
    }
}

class Manazer extends Zamestnanec {
    private $oddeleni;

    function __construct($jmeno, $prijmeni, $plat, $oddeleni) {
        parent::__construct($jmeno, $prijmeni, $plat);
        $this->oddeleni = $oddeleni;
    }

    public function vypisInfo() {
        echo "Manažer: $this->jmeno $this->prijmeni <br>";
        echo "Oddělení: $this->oddeleni <br>";
        echo "Plat: $this->plat Kč <br>";
    }
}

$manazer = new Manazer("Petr", "Svoboda", 50000, "IT");
$manazer->vypisInfo();