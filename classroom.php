<?php

class Classroom {
    public $rocnik;
    public $tridni_ucitel; // objekt Teacher
    public $zaci;          // pole Studentů

    public function __construct($rocnik, $tridni_ucitel) {
        $this->rocnik = $rocnik;
        $this->tridni_ucitel = $tridni_ucitel;
        $this->zaci = [];
    }

    public function zapisStudenta($student) {
        $this->zaci[] = $student;
    }

    public function vypisInfo() {
        echo "<br>Třída {$this->rocnik}. ročníku<br>";
        $this->tridni_ucitel->predstavSe();
        echo "Počet žáků: " . count($this->zaci) . "<br><br>";
    }
}
