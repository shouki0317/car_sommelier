<?php

namespace App\Services;

//必ずファイル名と合わせる。
class FuelConsumptionService  
{
    public static function fuel_consumption($distance_old, $distance_new, $refueling_amount){

        $fuel_consumption = ( $distance_new - $distance_old ) / $refueling_amount;
        $fuel_consumption = round( $fuel_consumption, 1);

        return $fuel_consumption;
    }
}

?>