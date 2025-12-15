<?php

class Classroom {
    public $rocnik;
    public $tridni_ucitel;
    public $zaci; // pole objektů Student

    public function __construct($rocnik, $tridni_ucitel) {
        $this->rocnik = $rocnik;
        $this->tridni_ucitel = $tridni_ucitel;
        $this->zaci = []; // výchozí hodnota – prázdné pole
    }

    // metoda navíc – přidání žáka do třídy
    public function zapisStudenta($student) {
        $this->zaci[] = $student;
    }

    public function vypisInfo() {
        echo "Třída {$this->rocnik}. ročníku<br>";
        echo "Třídní učitel: {$this->tridni_ucitel}<br>";
        echo "Počet žáků: " . count($this->zaci) . "<br><br>";
    }
}
