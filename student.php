<?php

class Student {
    public $jmeno;
    public $prijmeni;
    public $oblibeny_predmet;

    public function __construct($jmeno, $prijmeni, $oblibeny_predmet) {
        $this->jmeno = $jmeno;
        $this->prijmeni = $prijmeni;
        $this->oblibeny_predmet = $oblibeny_predmet;
    }

    // metoda navíc
    public function predstavSe() {
        echo "{$this->jmeno} {$this->prijmeni} - oblíbený předmět: {$this->oblibeny_predmet}<br>";
    }
}
