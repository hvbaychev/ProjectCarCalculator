<?php

namespace App\Models;

class DB
{

    private static $instance;
    private $event;
    private function __construct()
    {
        $this->event = json_decode(file_get_contents('C:\xampp\htdocs\proekt\CarCalculator\app\Models\database\dataFile.json', true));
    }

    public static function getInstane()
    {
        if (!Self::$instance) {
            Self::$instance = new DB;
        }
        return Self::$instance;
    }

    public function setData($event)
    {
        $this->event = $event;
    }

    public  function getData()
    {
        return $this->event;
    }

    public function saveData()
    {
        return $this->event;
    }

    public function deleteData()
    {
        return $this->event;
    }
}
