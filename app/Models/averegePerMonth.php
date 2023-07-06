<?php

namespace App\Models;

use App\Models\lastTime;

class AveregePerMonth extends lastTime
{

    public $event = array();
    public $db;

    public function __construct($db)
    {
        $this->db = $db;
        $event = $this->db->getData();
        $this->event = json_decode(json_encode($event), true);
    }

    public function averageRefuelPerMonth()
    {
        $event = $this->event;

        if (isset($event['refuel_events']) && count($event['refuel_events']) > 0) {
            $refuel_events = $event['refuel_events'];
            $refuel_counts = array();
            foreach ($refuel_events as $event) {
                $date = strtotime($event['date']);
                $monthYear = date('m-Y', $date);
                if (array_key_exists($monthYear, $refuel_counts)) {
                    $refuel_counts[$monthYear] += 1;
                } else {
                    $refuel_counts[$monthYear] = 1;
                }
            }
            $num_months = count($refuel_counts);
            if ($num_months > 0) {
                $avg_refuels_per_month = array_sum($refuel_counts) / $num_months;
                return $avg_refuels_per_month;
            } else {
                return 0;
            }
        }
    }

    public function averageFuelConsumption()
    {
        $event = $this->event;

        if (isset($event['refuel_events']) && count($event['refuel_events']) > 0) {
            $totalKilometer = 0;
            $totalFuel = 0;
            foreach ($event['refuel_events'] as $value) {
                $totalKilometer += $value['total_odo'];
                $totalFuel += $value['fuel_quantity'];
            }

            if ($totalKilometer === 0) {
                return 0;
            } else {
                $fuelConsumption = ($totalFuel / $totalKilometer) * 100;
                $number_format = number_format($fuelConsumption, 2);
                return $number_format;
            }
        }
    }

    public function averagePricePerKm()
    {
        $event = $this->event;

        if (isset($event['refuel_events']) && count($event['refuel_events']) > 0) {
            $totalKm = $this->lastTimeRefuel();
            $totalRefuelLiters = $this->totalRefuel();
            $price = 0;
            foreach ($event['refuel_events'] as $value) {
                $price += $value['fuel_amount'];
            }
            $price = $price / count($event['refuel_events']);
            if ($totalKm === 0) {
                return 0;
            } else {
                $pricePerKm = ($totalRefuelLiters * $price) / $totalKm;
                $number_format = number_format($pricePerKm, 2);
                return $number_format;
            }
        }
    }

    public function averagePricePerMonth()
    {
        $event = $this->event;

        if (isset($event['refuel_events']) && count($event['refuel_events']) > 0) {

            $sum = 0;
            foreach ($event['refuel_events'] as $value) {
                $sum += $value['total_price'];
            }

            $finalSum = $sum / count($event['refuel_events']);
            $number_format = number_format($finalSum, 2);
            return $number_format;
        }
    }

    public function averageQuantityPerMonth()
    {
        $event = $this->event;

        if (isset($event['refuel_events']) && count($event['refuel_events']) > 0) {
            $quantity = 0;
            $refuelCounts = array();
            foreach ($event['refuel_events'] as $value) {
                $date = strtotime($value['date']);
                $monthYear = date('m-Y', $date);
                if (array_key_exists($monthYear, $refuelCounts)) {
                    $refuelCounts[$monthYear]['quantity'] += $value['fuel_quantity'];
                    $refuelCounts[$monthYear]['count']++;
                } else {
                    $refuelCounts[$monthYear] = array('quantity' => $value['fuel_quantity'], 'count' => 1);
                }
            }
            $finalQuantity = 0;
            foreach ($refuelCounts as $monthYear => $data) {
                if ($data['count'] > 1) {
                    $finalQuantity += $data['quantity'] / $data['count'];
                }
            }
            $finalQuantity = $finalQuantity / count($refuelCounts);
            $numberFormat = number_format($finalQuantity, 2);
            return $numberFormat;
        }
    }

    public function totalRefuel()
    {
        $event = $this->event;

        if (isset($event['refuel_events']) && count($event['refuel_events']) > 0) {
            $refuel = 0;
            foreach ($event['refuel_events'] as $value) {
                $refuel += $value['fuel_quantity'];
            }
            return $refuel;
        }
    }

    public function averageDateDiff()
    {
        $event = $this->event;
        
        if (isset($event['refuel_events']) && count($event['refuel_events']) > 1) {
            $dates = [];
            foreach ($event['refuel_events'] as $value) {
                $dates[] = $value['date'];
            }
            $periods = [];
            for ($i = 0; $i < count($dates) - 1; $i++) {
                for ($j = $i + 1; $j < count($dates); $j++) {
                    $date1 = new \DateTime($dates[$i]);
                    $date2 = new \DateTime($dates[$j]);
                    $interval = $date1->diff($date2);
                    $periods[] = $interval->format('%a');
                }
            }
            $averagePeriod = array_sum($periods) / count($periods);
            $numberFormat = number_format($averagePeriod, 0);

            return $numberFormat;
        }
    }
}
