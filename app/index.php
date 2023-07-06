<?php

namespace App\Models;

ob_start();

define('DS', DIRECTORY_SEPARATOR);
define('PATH_BASE', dirname(__DIR__));
define('PATH_APP', join(DS, [PATH_BASE, 'app']));
define('PATH_CONTROLLERS', join(DS, [PATH_APP, 'controllers']));
define('PATH_VIEWS', join(DS, [PATH_APP, 'views']));
define('PATH_MODELS', join(DS, [PATH_APP, 'models']));

require_once join(DS, [PATH_BASE, 'vendor', 'autoload.php']);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../public/style/style.css">
    <title>Document</title>
</head>

<body>
    <section id="menu"></section>
    <a id="button_id" class="loading" href="../app/Views/view.php">Зареждане</a> | <a class="enquiry" href="../app/Views/report.php">Справка</a>
    </section>
</body>

</html>

<?php
ob_end_flush();
?>