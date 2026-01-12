<?php

class Person {
    public $jmeno;
    public $prijmeni;

    public function __construct($jmeno, $prijmeni) {
        $this->jmeno = $jmeno;
        $this->prijmeni = $prijmeni;
    }

    public function celeJmeno() {
        return $this->jmeno . " " . $this->prijmeni;
    }
}
?>