<?php

// třída classroom
class classroom{
    public $pocet_zaku;
    public $tridni_ucitel;
    public $rocnik;

    public function __construct($rocnik, $tridni_ucitel, $pocet_zaku) {
        $this->pocet_zaku = $pocet_zaku;
        if ($pocet_zaku <= 0) {
            echo "Nelze zadat negativní počet žáků";
            $pocet_zaku = 0;
        }
        $this->rocnik = $rocnik;
        if ($rocnik > 4) {
            echo "ročník nemůže být vyšší než 4. ročník";
            $rocnik = 0;
        }
        $this->tridni_ucitel = $tridni_ucitel;
    }

    public function identify(){
        echo "trida pro " . $this->rocnik . ". rocnik má " . $this->pocet_zaku . " žáků a třídní učitel je " . $this->tridni_ucitel . "<br>";
    }
}

//třída žáci
class zaci{
    public $jmeno;
    public $prijmeni;
    public $oblibeny_predmet;

    public function __construct($jmeno, $prijmeni, $oblibeny_predmet) {
        $this->jmeno = $jmeno;
        $this->prijmeni = $prijmeni;
        $this->oblibeny_predmet = $oblibeny_predmet;
    }

    public function identify(){
        echo "V této třídě je " . $this->jmeno . " " . $this->prijmeni . " a jeho oblíbený předmět je " . $this->oblibeny_predmet;
    }
}

//call
$classroom = new classroom(4, "Seggy", 25);
$classroom->identify();
$zaci = new zaci("Pavel", "Wisman", "Hardware");
$zaci->identify()


?>