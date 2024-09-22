<?php

namespace App\Services;

//必ずファイル名と合わせる。
class FuelPriceService 
{
    public static function fuel_price($money, $refueling_amount){
        // 燃料価格計算

        $fuel_price = $money / $refueling_amount;
        $fuel_price = floor($fuel_price);

        return $fuel_price;
    }
}

?>