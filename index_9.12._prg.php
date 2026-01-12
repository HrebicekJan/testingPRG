<?php

include_once("Person.php");
include_once("Student.php");
include_once("Teacher.php");
include_once("Classroom.php");

// učitel
$teacher = new Teacher("Seggy", "Seggytý", "IT");

// třída
$classroom = new Classroom(4, $teacher);

// studenti
$student1 = new Student("Wavel", "Pisman", "Hardware");
$student2 = new Student("Jan", "Novák", "Matematika");

// zápis studentů
$classroom->zapisStudenta($student1);
$classroom->zapisStudenta($student2);

// scénář
$classroom->vypisInfo();

echo "Seznam žáků:<br>";
foreach ($classroom->zaci as $student) {
    $student->predstavSe();
}
