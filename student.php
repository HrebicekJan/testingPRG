<?php
include_once("Person.php");

class Student extends Person {
    public $oblibeny_predmet;

    public function __construct($jmeno, $prijmeni, $oblibeny_predmet) {
        parent::__construct($jmeno, $prijmeni);
        $this->oblibeny_predmet = $oblibeny_predmet;
    }

    public function predstavSe() {
        echo $this->celeJmeno() . 
             " – oblíbený předmět: " . 
             $this->oblibeny_predmet . "<br>";
    }
}
