<?php

namespace App\Models;

class Fuel
{
    public $dateRefuel;
    public $eventDistance;
    public $globalDistance;
    public $fuelLiters;
    public $fuelPrice;
    public $totalAmount;
    public $fuelBrand;
    public $gasStation;
    public $drivingType;

    public function input()
    {
        if (isset($_POST['saveBtn'])) {
            $this->dateRefuel = $_POST['date'];
            $this->eventDistance = $_POST['distance'];
            $this->globalDistance = $_POST['total_odo'];
            $this->fuelLiters = $_POST['fuel_quantity'];
            $this->fuelPrice = $_POST['fuel_amount'];
            $this->totalAmount = $_POST['total_price'];
            $this->gasStation = $_POST['gas_station_name'];
            $this->fuelBrand = $_POST['gas_station_product'];
            $this->drivingType = $_POST['driving_type'];

            $data = array(
                'date' => $this->dateRefuel,
                'distance' => $this->eventDistance,
                'total_odo' => $this->globalDistance,
                'fuel_quantity' => $this->fuelLiters,
                'fuel_amount' => $this->fuelPrice,
                'total_price' => $this->totalAmount,
                'gas_station_name' => $this->gasStation,
                'gas_station_product' => $this->fuelBrand,
                'driving_type' => $this->drivingType
            );

            $this->sendData($data);
        }
    }

    public function sendData($data)
    {

        $existingData = file_get_contents('C:\xampp\htdocs\proekt\CarCalculator\app\Models\database\dataFile.json');
        $dataArray = json_decode($existingData, true);

        if (!isset($dataArray['refuel_events'])) {
            $dataArray['refuel_events'] = array();
        }

        $dataArray['refuel_events'][] = $data;

        $jsonData = json_encode($dataArray);
        file_put_contents('C:\xampp\htdocs\proekt\CarCalculator\app\Models\database\dataFile.json', $jsonData);
    }
}
