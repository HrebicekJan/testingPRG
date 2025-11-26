<?php
 $datum = date("H:i-d/m/Y") . date(" - l");
 ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<style>
    p {
        display: flex;
        justify-content: center;
        align-items: center;
        width: 500px;;
        height: 100px;;
        margin: 150px;;
        border: 5px solid red;
        border-radius: 10px;
        text-align: center;
    }


</style>

<body>

<p>
    Dnes je <?php echo $datum; ?>
</p>

</body>
</html>