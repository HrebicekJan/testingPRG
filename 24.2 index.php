<?php
require_once ("Moje/24.2 Datetime.php");

function my_autoload($class) {

require "Moje\\" . $class . ".php";

var_dump($class);
}
spl_autoload_register("my_autoload");


$var = new MyLib\DateTime();
$phpdate = new DateTime();

var_dump($var);
var_dump($phpdate);

?>