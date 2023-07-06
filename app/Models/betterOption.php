<?php

namespace App\Models;

use App\Models\DB;

$data = DB::getInstane();
$db = $data->getData();

class BetterOption{

    public $event = array();
    public $db;

    public function __construct($db)
    {
        $this->db = $db;
        $event = $this->db->getData();
        $this->event = json_decode(json_encode($event), true);
    }


    public function betterOptionAverageFuelConsumption()
    {
        if (isset($_POST['reportBtn'])) {
            $gasStation = $_POST['gas_station'];
            $gasStationProduct = $_POST['gas_station_product'];
            $drivingType = $_POST['driving_type'];
        } else {
            return 0;
        }

        if ($gasStation === null || $gasStationProduct === null || $drivingType === null) {
            return 0;
        }

        $event = $this->event;
        
        if (isset($event['refuel_events']) && count($event['refuel_events']) > 1) {
            $stationArray = [];
            $typeFuelArray = [];
            $priceFuelArray = [];
            $totalDistance = 0;
            $totalFuel = 0;
         
            foreach ($event['refuel_events'] as $value) {
                if ($value['gas_station_name'] === $gasStation && $value['gas_station_product'] === $gasStationProduct && $value['driving_type'] === $drivingType) {
                    $stationName = $value['gas_station_name'];

                    if (!array_key_exists($stationName, $stationArray)) {
                        $stationArray[$stationName] = [];
                    }
                    $stationArray[$stationName][] = $value['gas_station_name'];

                    $typeFuel = $value['gas_station_product'];

                    if (!array_key_exists($typeFuel, $typeFuelArray)) {
                        $typeFuelArray[$typeFuel] = [];
                    }
                    $typeFuelArray[$typeFuel][] = $value['gas_station_product'];

                    $fuelPrice = $value['total_price'] / $value['fuel_quantity'];

                    if (!array_key_exists($typeFuel, $priceFuelArray)) {
                        $priceFuelArray[$typeFuel] = [];
                    }
                    $priceFuelArray[$typeFuel][$stationName] = $fuelPrice;

                    $totalDistance += $value['distance'];
                    $totalFuel += $value['fuel_quantity'];
                   
                }
               
            }
            
            $averageFuelConsumption = ($totalFuel / $totalDistance) * 100;
            $numberFormat = number_format($averageFuelConsumption, 2);
            return $numberFormat;
        }
    }

    public function betterOptionAveragePricePerKm()
    {
        if (isset($_POST['reportBtn'])) {
            $gasStation = $_POST['gas_station'];
            $gasStationProduct = $_POST['gas_station_product'];
            $drivingType = $_POST['driving_type'];
        } else {
            return 0;
        }

        if ($gasStation === null || $gasStationProduct === null || $drivingType === null) {
            return 0;
        }

       // $jsonData = file_get_contents('C:\xampp\htdocs\proekt\CarCalculator\app\Models\database\dataFile.json');
       // $event = json_decode($jsonData, true);
        $event = $this->event;

        $fuelPrice = 0;
        $fuelAmount = 0;
        $totalKm = 0;
        $count = 0;

        foreach ($event['refuel_events'] as $value) {
            if ($value['gas_station_name'] === $gasStation && $value['gas_station_product'] === $gasStationProduct && $value['driving_type'] === $drivingType) {
                $fuelPrice += $value['total_price'];
                $fuelAmount += $value['fuel_quantity'];
                $totalKm += $value['total_odo'];
                $count++;
            }
        }

        if ($count > 0) {
            $pricePerKm = ($fuelAmount * $fuelPrice) / $totalKm;
            $numberFormat = number_format($pricePerKm, 2);
            return $numberFormat;
        } else {
            return 0;
        }
    }

    public function getLowestFuelConsumption()
    {
        //$jsonData = file_get_contents('C:\xampp\htdocs\proekt\CarCalculator\app\Models\database\dataFile.json');
       // $event = json_decode($jsonData, true);
        $event = $this->event;
        $lowestFuelConsumption = null;

        foreach ($event['refuel_events'] as $value) {
            $fuelQuantity = $value['fuel_quantity'];
            $distance = $value['total_odo'];
            $fuelConsumption = ($fuelQuantity / $distance) * 100;

            if ($lowestFuelConsumption === null || $fuelConsumption < $lowestFuelConsumption) {
                $lowestFuelConsumption = $fuelConsumption;
            }
        }

        return number_format($lowestFuelConsumption, 2);
    }

    public function lowestPricePerDistance()
    {
        if (isset($_POST['reportBtn'])) {
            $gasStation = $_POST['gas_station'];
            $gasStationProduct = $_POST['gas_station_product'];
            $drivingType = $_POST['driving_type'];
        } else {
            return 0;
        }

        if ($gasStation === null || $gasStationProduct === null || $drivingType === null) {
            return 0;
        }
        $event = $this->event;
       // $jsonData = file_get_contents('C:\xampp\htdocs\proekt\CarCalculator\app\Models\database\dataFile.json');
        //$event = json_decode($jsonData, true);
        $lowestPrice = PHP_FLOAT_MAX;

        foreach ($event['refuel_events'] as $value) {
            if ($value['gas_station_name'] === $gasStation && $value['gas_station_product'] === $gasStationProduct && $value['driving_type'] === $drivingType) {
                $pricePerKm = $value['total_price'] / $value['total_odo'];
                if ($pricePerKm < $lowestPrice) {
                    $lowestPrice = $pricePerKm;
                }
            }
        }

        $numberFormat = number_format($lowestPrice, 2);
        return $numberFormat;
    }
}
