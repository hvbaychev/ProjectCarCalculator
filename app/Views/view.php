<?php

namespace App\Views;

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../../public/style/style.css">
    <title>Document</title>
</head>

<body>
    <section id="menu"></section>
    <a id="button_id" class="loading" href="../../app/index.php">Начало</a> | <a class="enquiry" href="../../app/Views/report.php">Справка</a>
    </section>
    <hr />
    <?php

    require_once "bloks/refuel.php";
    require_once "bloks/refuelAdd.php";

    ?>
</body>

</html>