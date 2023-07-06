<?php

namespace App\Views\Bloks;

use App\Controllers\Controler;

require_once "/xampp/htdocs/proekt/CarCalculator/app/Controllers/controler.php";

$controller = new Controler();
$fuel = $controller->change->editRow('', '');
$fuel1 = $controller->fuel->input();
$fuel2 = $controller->change();

?>
<section id="refuel">
    <td class="white-text">
        <table class="centered-table">

            <tr>
                <th>Дата</th>
                <th>Изминато разстояние</th>
                <th>Общи километри</th>
                <th>Заредени литри</th>
                <th>Цена на литър</th>
                <th>Обща сума</th>
                <th>Бензиностанция</th>
                <th>Марка гориво</th>
                <th>Вид на шофиране</th>
                <th>Действие</th>
            </tr>
            <?php
            if (isset($_GET['remove'])) {
                // Do deletion
                $id = $_GET['remove'];
                echo 'Record with id ' . $id . ' is deleted!';
                echo $fuel2->deleteRow($id);
            }



            $jsonData = file_get_contents('C:\xampp\htdocs\proekt\CarCalculator\app\Models\database\dataFile.json');
            $data = json_decode($jsonData, true);
            if (isset($data['refuel_events']) && !empty($data['refuel_events'])) {
                //$index = 1;
                foreach ($data['refuel_events'] as $index => $event) {
            ?>
                    <tr>
                        <td><?php echo $event['date']; ?></td>
                        <td><?php echo $event['distance']; ?></td>
                        <td><?php echo $event['total_odo']; ?></td>
                        <td><?php echo $event['fuel_quantity']; ?></td>
                        <td><?php echo $event['fuel_amount']; ?></td>
                        <td><?php echo $event['total_price']; ?></td>
                        <td><?php echo $event['gas_station_name']; ?></td>
                        <td><?php echo $event['gas_station_product']; ?></td>
                        <td><?php echo $event['driving_type']; ?></td>
                        <td>
                            <a class="edit-link" href="?edit=<?php echo $index; ?>">Редактирай</a>|
                            <a class="delete-link" href="?remove=<?php echo $index; ?>" onclick="return confirm('Сигурни ли сте че желаете да изтриете записа?') === true">Изтрий</a>
                        </td>
                    </tr>
            <?php
                }
            }
            ?>
        </table>
</section>
<hr />