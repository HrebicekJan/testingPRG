<?php

// třída pro kočku
class Cat{
    public $age;
    public $name;

    public function __construct($name, $age) {
        $this->name = $name;
        if ($age < 0) {
            echo "Nelze zadat negativní věk!";
            $age = 0;
        }
    }

    public function identifikuj(){
        echo "toto je kočka ". $this->name;
        echo " a má " . $this->age . " let <br>";

    }
} 



//instance objektu

$jorje = new Cat();
$jorje->age = 11;
$jorje->name = "Jorje";
$jorje->identify();

?>