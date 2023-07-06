<?php

namespace App\Models;

class Change
{

    public function editRow($editing_id, $event)
    {
        if (isset($_POST['editBtn'])) {
            $newData = [
                'date' => $_POST['date'],
                'distance' => $_POST['distance'],
                'total_odo' => $_POST['total_odo'],
                'fuel_quantity' => $_POST['fuel_quantity'],
                'fuel_amount' => $_POST['fuel_amount'],
                'total_price' => $_POST['total_price'],
                'gas_station_name' => $_POST['gas_station_name'],
                'gas_station_product' => $_POST['gas_station_product'],
                'driving_type' => $_POST['driving_type']
            ];
            $data = json_decode(file_get_contents('C:\xampp\htdocs\proekt\CarCalculator\app\Models\database\dataFile.json'), true);
            $data['refuel_events'][$editing_id] = $newData;
            file_put_contents('C:\xampp\htdocs\proekt\CarCalculator\app\Models\database\dataFile.json', json_encode($data));
            header("Location: view.php");
        }
    }

    public function deleteRow($index)
    {
        $data = json_decode(file_get_contents('C:\xampp\htdocs\proekt\CarCalculator\app\Models\database\dataFile.json', true));
        unset($data->refuel_events->$index);
        file_put_contents('C:\xampp\htdocs\proekt\CarCalculator\app\Models\database\dataFile.json', json_encode($data));
    }
}
