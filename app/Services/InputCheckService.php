<?php

namespace App\Services;

//必ずファイル名と合わせる。
class InputCheckService 
{
    public static function input_check($request, $new_scores){
        
        // 総走行距離の確認
        $form_check["distance"] = preg_match('/[1-9]|[1-9][0-9][0-9][0-9]/', $request->distance);
        
        // 給油金額の確認
        $form_check["money"] = preg_match('/[1-9]|[1-9][0-9][0-9][0-9][0-9]/', $request->money);
        
        // 給油量の確認
        $form_check["refueling_amount"] = preg_match('/^([1-9]\d*|0)(\.\d+)?$/', $request->refueling_amount);

        // その他の確認
        if ($form_check["distance"] === 1 && $form_check["money"] === 1 && $form_check["refueling_amount"] === 1) {
            
            // 給油量が99.99L以下であることの確認
            if ($request->refueling_amount > 99.99) {
                $form_check["refueling_amount_error"] = 0;
            } else {
                $form_check["refueling_amount_error"] = 1;
            }

            // 燃料価格が1km/L以上であることの確認
            $fuel_price = $request->money / $request->refueling_amount;
            if ($fuel_price <= 1) {
                $form_check["fuel_price_error"] = 0;
            } else {
                $form_check["fuel_price_error"] = 1;
            }

            if (isset($new_scores->distance)) {
                // 燃費が0～100の間であることの確認
                $fuel_consumption = ($request->distance - $new_scores->distance) / $request->refueling_amount;
                if ($fuel_consumption <= 0 || $fuel_consumption >= 100) {
                    $form_check["fuel_consumption_error"] = 0;
                } else {
                    $form_check["fuel_consumption_error"] = 1;
                }
            } else {
                $form_check["fuel_consumption_error"] = 1;
            }

        } else {
            $form_check["refueling_amount_error"] = 1;
            $form_check["fuel_price_error"] = 1;
            $form_check["fuel_consumption_error"] = 1;
        }

        return $form_check;
    }
}

?>