<?php
include_once("Person.php");

class Teacher extends Person {
    public $aprobace;

    public function __construct($jmeno, $prijmeni, $aprobace) {
        parent::__construct($jmeno, $prijmeni);
        $this->aprobace = $aprobace;
    }

    public function predstavSe() {
        echo "Třídní učitel: " . 
             $this->celeJmeno() . 
             " (" . $this->aprobace . ")<br>";
    }
}
