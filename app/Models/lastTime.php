<?php

namespace App\Models;

class LastTime
{

    public $db;
    public $event = array();

    public function __construct($db)
    {
        $this->db = $db;
        $event = $this->db->getData();
        $this->event = json_decode(json_encode($event), true);
    }

    public function lastTimeRefuel()
    {
        $event = $this->event;

        if (isset($event['refuel_events']) && count($event['refuel_events']) > 0) {
            $lastEvent = end($event['refuel_events']);
            $lastDistance = $lastEvent['distance'];
            return $lastDistance;
            print_r($lastDistance);
        } else {
            return 0;
        }
    }

    public function lastPeriodDistanceTraveled()
    {
        $event = $this->event;

        if (isset($event['refuel_events']) && count($event['refuel_events']) > 0) {
            $lastDistanceTravel = end($event['refuel_events']);
            return $lastDistanceTravel['distance'];
        }
    }

    public function lastPeriodFuelConsumption()
    {
        $event = $this->event;

        if (isset($event['refuel_events']) && count($event['refuel_events']) > 0) {
            $lastRefLiter = end($event['refuel_events']);
            $lastLiters = $lastRefLiter['fuel_quantity'];
            $distance = $this->lastPeriodDistanceTraveled();
            if ($distance === 0) {
                return 0;
            } else {
                $fuelCon = ($lastLiters / $distance) * 100;
                $numberFormat = number_format($fuelCon, 2);
                return $numberFormat;
            }
        }
    }

    public function lastPeriodPricePerKm()
    {
        $event = $this->event;

        if (isset($event['refuel_events']) && count($event['refuel_events']) > 0) {
            $totalKm = $this->lastPeriodDistanceTraveled();
            $refuelLiters = end($event['refuel_events']);
            $totalRefuelLiters = $refuelLiters['fuel_quantity'];
            $price = end($event['refuel_events']);
            $lastPrice = $price['total_price'];
            $lastPricePerKm = ($totalRefuelLiters * $lastPrice) / $totalKm;
            $numberFormat = number_format($lastPricePerKm, 2);
            return $numberFormat;
        }
    }

    
}
