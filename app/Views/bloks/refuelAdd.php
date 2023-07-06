<?php

namespace App\Views\Bloks;
require_once "/xampp/htdocs/proekt/CarCalculator/app/Controllers/controler.php" ;
use App\Controllers\Controler ;

$controller = new Controler();
$fuel = $controller ->change->editRow('','') ;


?>
<section id="refuel_add">
    <form method="POST">
        <input type="hidden" name="edit" value="<?= $editing_id; ?>" />
        <table border="0">
            <tr>
                <th>Дата</th>
                <td><input type="date" name="date" placeholder="Дата" /></th>
            </tr>
            <tr>
                <th>Изминато разстояние</th>
                <td><input type="number" name="distance" step="0.01" max="99999999999999999.99" placeholder="километри" value="<?= $event['distance']; ?>" /></td>

            </tr>
            <tr>
                <th>Общо изминато разстояние</th>
                <td><input type="number" name="total_odo" step="0.01" max="999999999999999.99" placeholder="километри" value="<?= $event['total_odo']; ?>" /></th>
            </tr>
            <tr>
                <th>Заредени литри</th>
                <td><input type="number" name="fuel_quantity" step="0.01" max="999999999999999.99" placeholder="литри" value="<?= $event['fuel_quantity']; ?>" /></th>
            </tr>
            <tr>
                <th>Цена на литър</th>
                <td><input type="number" name="fuel_amount" step="0.01" max="999999999999999.99" placeholder="цена" value="<?= $event['fuel_amount']; ?>" /></th>
            </tr>
            <tr>
                <th>Обща сума</th>
                <td><input type="number" name="total_price" step="0.01" max="99999999999999.99" placeholder="Обща сума" value="<?= $event['total_price']; ?>" /></th>
            </tr>
            <tr>
                <th>Марка гориво</th>
                <td>
                    <select name="gas_station_product">

                        <option value="Motion95">OMV Maxx Motion 95</option>
                        <option value="Motion100">OMV Maxx Motion 100</option>
                        <option value="V-PowerAddBlue">SHELL V-Power Add Blue</option>
                        <option value="V-Power">SHELL V-Power</option>
                        <option value="DoubleFiltered">EKO Double Filtered</option>
                        <option value="Ekonomy">EKO Ekonomy</option>
                        <option value="ProForce">PETROL Pro Force</option>
                        <option value="GreenForce">PETROL Green Force</option>
                        <option value="Opti">GAZPROM Opti</option>
                        <option value="UnleadedOpti">GAZPROM Unleaded Opti</option>
                        <option value="Ecto">LUKOIL Ecto</option>
                        <option value="Ecto100">LUKOIL Ecto 100</option>
                    </select>
                </td>
            </tr>
            <tr>
                <th>Бензиностанция</th>
                <td>
                    <select name="gas_station_name">
                        <option value="omv">OMV</option>
                        <option value="shell">SHELL</option>
                        <option value="EKO">EKO</option>
                        <option value="PETROL">PETROL</option>
                        <option value="GAZPROM">GAZPROM</option>
                        <option value="LUKOIL">LUKOIL</option>
                    </select>
                </td>
            </tr>
            <tr>
                <th>Вид на шофиране</th>
                <td>
                    <select name="driving_type">
                        <option value=""><?= $event['driving_type']; ?></option>
                        <option value="city">Градско</option>
                        <option value="intercity">Извънградско</option>
                        <option value="mixed">Смесено</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td colspan="2" align="right">
                    <?php
                    if (isset($_GET['edit'])) {
                        echo '<input type="submit" name="editBtn" value="Редактирай" class="custom-select" />';
                    } else {
                        echo '<input type="submit" name="saveBtn" value="Запис" class="custom-select" />';
                    }
                    ?>
                </td>
            </tr>
        </table>
    </form>
</section>

<hr />
