<?php

namespace App\Models;

require_once "db.php";

class Car
{
    public $brand;
    public $model;
    public $year;
    public $capTank;
    public $typeFuel;

    public function __construct()
    {
        $db = DB::getInstane();
        $data = $db->getData();
        $this->brand = isset($data->carInfo->brand) ? $data->carInfo->brand : null;
        $this->model = isset($data->carInfo->model) ? $data->carInfo->model : null;
        $this->year = isset($data->carInfo->year) ? $data->carInfo->year : null;
        $this->capTank = isset($data->carInfo->reservoir_volume) ? $data->carInfo->reservoir_volume : null;
        $this->typeFuel = isset($data->carInfo->fuel_type) ? $data->carInfo->fuel_type : null;
    }

    public function getBrand()
    {
        return $this->brand;
    }
    public function getModel()
    {
        return $this->model;
    }
    public function getYear()
    {
        return $this->year;
    }
    public function getCapTank()
    {
        return $this->capTank;
    }
    public function getTypeFuel()
    {
        return $this->typeFuel;
    }
}
