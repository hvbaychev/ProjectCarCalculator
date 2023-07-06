<?php

namespace App\Controllers;

require_once "/xampp/htdocs/proekt/CarCalculator/app/Models/db.php";
require_once "/xampp/htdocs/proekt/CarCalculator/app/Models/betterOption.php";
require_once "/xampp/htdocs/proekt/CarCalculator/app/Models/car.php";
require_once "/xampp/htdocs/proekt/CarCalculator/app/Models/change.php";
require_once "/xampp/htdocs/proekt/CarCalculator/app/Models/fuel.php";
require_once "/xampp/htdocs/proekt/CarCalculator/app/Models/lastTime.php";
require_once "/xampp/htdocs/proekt/CarCalculator/app/Models/averegePerMonth.php";

use App\Models\DB;
use App\Views\View;
use App\Models\AveregePerMonth;
use App\Models\betterOption;
use App\Models\Car;
use App\Models\Change;
use App\Models\Fuel;
use App\Models\lastTime;

class Controler
{
    public $view;
    public $event;
    public $models = [];
    public $change;
    public $lastTime;
    public $average;
    public $better;
    public $fuel;

    public function __construct()
    {
        $db = DB::getInstane();
        $this->change = new Change($db);
        $this->lastTime = new LastTime($db);
        $this->average = new AveregePerMonth($db);
        $this->better = new BetterOption($db);
        $this->fuel = new Fuel($db);
    }

    public function getModels($key = ''): mixed
    {
        return  $this->$key ?? null;
    }

    public function Change()
    {
        return $this->change;
    }

    public function lastTime()
    {
        return $this->lastTime;
    }

    public function Average()
    {
        return $this->average;
    }

    public function Better()
    {
        return $this->better;
    }

    public function Fuel()
    {
        return $this->fuel;
    }
}
