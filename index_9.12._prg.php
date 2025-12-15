<?php

include "classroom.php";
include "student.php";

// vytvoření třídy
$classroom = new Classroom(4, "Seggy");

// vytvoření žáků
$student1 = new Student("Pavel", "Wisman", "Hardware");
$student2 = new Student("Jan", "Novák", "Matematika");

// zápis žáků do třídy (zanoření objektu do objektu)
$classroom->zapisStudenta($student1);
$classroom->zapisStudenta($student2);

// scénář
$classroom->vypisInfo();

echo "Seznam žáků:<br>";
foreach ($classroom->zaci as $student) {
    $student->predstavSe();
}
