<?php
// [1] Vytvořit kontrolu velikosti souboru (př: max 1MB)
// [2] Omezit typ souboru který lze nahrát (př: only png)

$maxsize = 1 * 1024 * 1024;
$allowedTypes = ["png"];

// Pokud nahráváme
if (isset($_FILES["soubor"]))
{
    $type   = pathinfo($_FILES["soubor"]["name"], PATHINFO_EXTENSION); 
    $size   = $_FILES["soubor"]["size"];
    $lokace = $_FILES["soubor"]["tmp_name"];
    $nazev  = $_POST["nazev_souboru"];
    
    $uploads = __DIR__ . '\uploads\\';
    $new_file = $uploads . $nazev . ".$type";
    
    // Kontrola velikosti + typu (PNG)
    if ($size < $maxsize && in_array($type, $allowedTypes)) {
        move_uploaded_file($lokace, $new_file);
    }
    else {
        if ($size >= $maxsize) {
            echo "<strong>!!! soubor má víc jak 1MB !!!</strong><br>";
        }
        if (!in_array($type, $allowedTypes)) {
            echo "<strong>!!! povolen je pouze PNG soubor !!!</strong>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload</title>
</head>

<body>
    <form action="" method="post" enctype="multipart/form-data">

        <label for="nazev_souboru">Pojmenovaní</label>
        <input type="text" name="nazev_souboru">

        <label for="soubor">Nahraj fotku</label>
        <input type="file" accept="image/png" name="soubor">

        <input type="submit" value="Odeslat">

    </form>

    <h1>Nahrané</h1>
    <div style="display: flex; gap: 10px; flex-wrap: wrap;">
        <?php
        $files = scandir(__DIR__ . "/uploads");
        foreach ($files as $i => $file){
            if ($i < 2) continue;

            echo "<img style='border-radius: 3px; max-width: 30%' src='http://localhost/files/uploads/$file' />";
        }
        ?>
    </div>
</body>
</html>
