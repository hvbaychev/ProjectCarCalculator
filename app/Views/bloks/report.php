<?php 

namespace App\Views\Bloks ;

require_once "/xampp/htdocs/proekt/CarCalculator/app/Controllers/controler.php" ;
use App\Controllers\Controler;
use App\Models\DB ;
$data = DB::getInstane();
$db = $data->getData();
$controller = new Controler();
$fuel = $controller->lastTime();
$average = $controller -> average();
$better = $controller -> better($db);
?>

<section id="report_last_period">
        <h3>Справка за последен период на зареждане</h3>
        <table>
            <tr>
                <th>Изминато разстояние</td>
                <td><?php echo $fuel->lastPeriodDistanceTraveled(); ?> километри</td>
            </tr>
            <tr>
                <th>Разход на гориво</td>
                <td><?php echo $fuel->lastPeriodFuelConsumption(); ?> литри / 100 километра</td>
            </tr>
            <tr>
                <th>Цена за разстояние</th>
                <td><?php echo $fuel->lastPeriodPricePerKm(); ?> лева / километър</th>
            </tr>
        </table>
    </section>
    <br>
    <hr />

    <section id="report_averages">
        <h3>Справка средни стойности</h3>
        <table>
            <tr>
                <th>Среден брой зареждания в месец</td>
                <td><?php echo $average->averageRefuelPerMonth(); ?> брой</td>
            </tr>
            <tr>
                <th>Средна цена на месец</td>
                <td><?php echo $average->averagePricePerMonth(); ?> лева</td>
            </tr>
            <tr>
                <th>Средно количество гориво на месец</th>
                <td><?php echo $average->averageQuantityPerMonth(); ?> литри</th>
            </tr>
            <tr>
                <th>Среден период на зареждане</td>
                <td><?php echo $average->averageDateDiff(); ?> дни</td>
            </tr>
            <tr>
                <th>Среден разход на гориво</th>
                <td><?php echo $average->averageFuelConsumption(); ?> литри/100 километра</th>
            </tr>
            <tr>
                <th>Средна цена за разстояние</th>
                <td><?php echo $average->averagePricePerKm(); ?> лева/километър</th>

            </tr>
        </table>
    </section>
    <br>
    <hr />

    <section id="report-best-option">
        <h3>Справка най-добра опция</h3>
        <form method="POST">
            <select name="gas_station" class="custom-select">
                <option value="">Без значение бензиностанция</option>
                <?php
                 $jsonDataCountOptionStation = file_get_contents('C:\xampp\htdocs\proekt\CarCalculator\app\Models\database\dataFile.json');
                $station = json_decode($jsonDataCountOptionStation, true);
                $existingStations = array();
                if (isset($station['refuel_events']) && !empty($station['refuel_events'])) {
                    foreach ($station['refuel_events'] as $refuel) {
                        $name = $refuel['gas_station_name'];
                        if (!in_array($name, $existingStations)) {
                            $existingStations[] = $name;
                ?>
                            <option value="<?php echo $name; ?>"><?php echo $name; ?></option>
                <?php
                        }
                    }
                }
                ?>
            </select>
            <select name="gas_station_product" class="custom-select">
                <option value="">Без значение марка гориво</option>
                <?php
                $jsonDataCountOptionFuel = file_get_contents('C:\xampp\htdocs\proekt\CarCalculator\app\Models\database\dataFile.json');
                $stationFuel = json_decode($jsonDataCountOptionFuel, true);
                $existingFuelTypes = array();
                if (isset($stationFuel['refuel_events']) && !empty($stationFuel['refuel_events'])) {
                    foreach ($stationFuel['refuel_events'] as $refuel) {
                        $fuelType = $refuel['gas_station_product'];
                        if (!in_array($fuelType, $existingFuelTypes)) {
                            $existingFuelTypes[] = $fuelType;
                ?>
                            <option value="<?php echo $fuelType; ?>"><?php echo $fuelType; ?></option>
                <?php
                        }
                    }
                }
                ?>
            </select>
            <select name="driving_type" class="custom-select">
                <option value="">Без значение вид на шофиране</option>
                <option value="city">Градско</option>
                <option value="intercity">Извънградско</option>
                <option value="mixed">Смесено</option>
            </select>
            <input type="submit" name="reportBtn" value="Преизчисли" class="custom-select" />
        </form>
        <table>
            <tr>
                <th>Среден разход на гориво</th>
                <td><?php echo $better->betterOptionAverageFuelConsumption($db); ?> литри/100 километра</th>
            </tr>
            <tr>
                <th>Средна цена за разстояние</th>
                <td><?php echo $better->betterOptionAveragePricePerKm($db); ?> лева/километър</th>
            </tr>
            <tr>
                <th>Най-нисък разход на гориво</th>
                <td><?php echo $better->getLowestFuelConsumption($db); ?> литри/100 километра</th>
            </tr>
            <tr>
                <th>Най-ниска цена за разстояние</th>
                <td><?php echo $better->lowestPricePerDistance($db); ?> лева/километър</th>
            </tr>
        </table>
        <br>
        <br>
    </section>
    <?php
    ob_end_flush();
    ?>
</body>

</html>