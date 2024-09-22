<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Price;
use App\Models\FuelConsumption;
use Illuminate\Support\Facades\DB;

use App\Services\FuelConsumptionService;
use App\Services\FuelPriceService;
use App\Services\InputCheckService;
use Illuminate\Support\Facades\Auth;

class FuelController extends Controller
{
    public function top(Request $request) 
    {
        // エロクアント
        // ログイン情報のidを入手
        if (Auth::id() !== null) {
            $account_id = Auth::id();

            // 現在の全国平均価格入手
            $tables = Price::orderBy('id', 'desc')->first();

            // 最新のデータ入手
            $new_scores = FuelConsumption::where('account_id', '=', $account_id)->orderBy('id', 'desc')->first();

            // 過去のデータ入手
            $fuel_consumption_id = FuelConsumption::where('account_id', '=', $account_id)->orderBy('id', 'desc')->first('id');
            if (isset($fuel_consumption_id["id"])) {
            $old_score = FuelConsumption::where('account_id', '=', $account_id)->orderBy('id', 'desc')->where('id', '<', $fuel_consumption_id["id"])->paginate(10);
            $sort = $request->sort;
            }

            // ランキング入手
            $ranking = FuelConsumption::where('account_id', '=', $account_id)->orderBy('fuel_consumption', 'desc')->take(5)->get();
            if (isset($fuel_consumption_id["id"])) {
                return view('fuel.index', compact('tables', 'new_scores', 'old_score', 'sort', 'ranking'));
            } else {
                return view('fuel.index', compact('tables', 'new_scores', 'ranking'));
            }

        } else {
            // ログイン情報がなければログイン画面へ遷移
            header("Location:./fuel/login");
            exit;
        }
    }


    public function add(Request $request) 
    {
        // ログイン情報のidを入手
        if (Auth::id() !== null) {
            $account_id = Auth::id();

            // 最新のデータ入手
            $new_scores = FuelConsumption::where('account_id', '=', $account_id)->orderBy('id', 'desc')->first();
            
            // 入力された値のチェック
            $form_check = InputCheckService::input_check($request, $new_scores);

            if ($form_check["distance"] === 0 || $form_check["money"] === 0 || $form_check["refueling_amount"] === 0  || $form_check["refueling_amount_error"] === 0 || $form_check["fuel_price_error"] === 0 || $form_check["fuel_consumption_error"] === 0) {

                // 現在の全国平均価格入手
                $tables = Price::orderBy('id', 'desc')->first();

                // 過去のデータ入手
                $fuel_consumption_id = FuelConsumption::where('account_id', '=', $account_id)->orderBy('id', 'desc')->first('id');
                if (isset($fuel_consumption_id["id"])) {
                $old_score = FuelConsumption::where('account_id', '=', $account_id)->orderBy('id', 'desc')->where('id', '<', $fuel_consumption_id["id"])->paginate(10);
                $sort = $request->sort;
                }

                // ランキング入手
                $ranking = FuelConsumption::where('account_id', '=', $account_id)->orderBy('fuel_consumption', 'desc')->take(5)->get();

                if (isset($fuel_consumption_id["id"])) {
                    return view('fuel.index', compact('form_check', 'tables', 'new_scores', 'old_score', 'sort', 'ranking'));
                } else {
                    return view('fuel.index', compact('form_check', 'tables', 'new_scores', 'ranking'));
                }
            }

            $post = new FuelConsumption();
            $post->date = $request->date;
            $post->distance = $request->distance;
            $post->money = $request->money;
            $post->refueling_amount = $request->refueling_amount;
            $post->account_id = $request->account_id;

            // 燃料価格登録
            $post->fuel_price = FuelPriceService::fuel_price($request->money, $request->refueling_amount);

            // 最新の燃費登録
            $scores = FuelConsumption::where('account_id', '=', $account_id)->orderBy('id', 'desc')->first();
            if (isset($scores["distance"])) {
            $post->fuel_consumption = FuelConsumptionService::fuel_consumption($scores["distance"], $request->distance, $request->refueling_amount);
            }

            // データ登録
            $post->save();

            // 二重送信防止
            header("Location:./fuel");
            exit;   

        } else {
            // ログイン情報がなければログイン画面へ遷移
            header("Location:./fuel/login");
            exit;
        }
    }


    public function edit() 
    {
        // ログイン情報のidを入手
        if (Auth::id() !== null) {
            $account_id = Auth::id();

            // 最新の値入手
            $new_score = FuelConsumption::where('account_id', '=', $account_id)->orderBy('id', 'desc')->first();

            // 現在の全国平均価格入手
            $tables = Price::orderBy('id', 'desc')->first();

            // 過去のデータ入手
            $fuel_consumption_id = FuelConsumption::where('account_id', '=', $account_id)->orderBy('id', 'desc')->first('id');
            if (isset($fuel_consumption_id["id"])) {
            $old_score = FuelConsumption::where('account_id', '=', $account_id)->orderBy('id', 'desc')->where('id', '<', $fuel_consumption_id["id"])->take(10)->get();
            }

            // ランキング入手
            $ranking = FuelConsumption::where('account_id', '=', $account_id)->orderBy('fuel_consumption', 'desc')->take(5)->get();

            if (isset($fuel_consumption_id["id"])) {
                return view('fuel.edit', compact('tables', 'new_score', 'old_score', 'ranking'));
            } else {
                return view('fuel.edit', compact('tables', 'new_score', 'ranking'));
            }

        } else {
            // ログイン情報がなければログイン画面へ遷移
            header("Location:./fuel/login");
            exit;
        }
    }

    public function update(Request $request) 
    {
        // ログイン情報のidを入手
        if (Auth::id() !== null) {
            $account_id = Auth::id();

            // 最新のデータ入手
            $new_scores = FuelConsumption::where('account_id', '=', $account_id)->orderBy('id', 'desc')->take(2)->get();

            // 入力された値のチェック
            if (isset($new_scores[1])) {
                $form_check = InputCheckService::input_check($request, $new_scores[1]);
            } else {
                // 過去のデータが無い場合
                $new_scores[1] = 0;
                $form_check = InputCheckService::input_check($request, $new_scores[1]);
            }
            

            if ($form_check["distance"] === 0 || $form_check["money"] === 0 || $form_check["refueling_amount"] === 0  || $form_check["refueling_amount_error"] === 0 || $form_check["fuel_price_error"] === 0 || $form_check["fuel_consumption_error"] === 0) {

                // 現在の全国平均価格入手
                $tables = Price::orderBy('id', 'desc')->first();

                // 最新のデータ入手
                $new_scores = FuelConsumption::where('account_id', '=', $account_id)->orderBy('id', 'desc')->first();

                // 過去のデータ入手
                $fuel_consumption_id = FuelConsumption::where('account_id', '=', $account_id)->orderBy('id', 'desc')->first('id');
                if (isset($fuel_consumption_id["id"])) {
                $old_score = FuelConsumption::where('account_id', '=', $account_id)->orderBy('id', 'desc')->where('id', '<', $fuel_consumption_id["id"])->get();
                }

                // ランキング入手
                $ranking = FuelConsumption::where('account_id', '=', $account_id)->orderBy('fuel_consumption', 'desc')->take(5)->get();

                if (isset($fuel_consumption_id["id"])) {
                    return view('fuel.edit', compact('form_check', 'tables', 'new_scores', 'old_score', 'ranking'));
                } else {
                    return view('fuel.edit', compact('form_check', 'tables', 'new_scores', 'ranking'));
                }
            }

            $post = FuelConsumption::find($request->id);
            $post->date = $request->date;
            $post->distance = $request->distance;
            $post->money = $request->money;
            $post->refueling_amount = $request->refueling_amount;

            // 燃料価格登録
            $post->fuel_price = FuelPriceService::fuel_price($request->money, $request->refueling_amount);

            // 最新の燃費登録
            $scores = FuelConsumption::where('account_id', '=', $account_id)->orderBy('id', 'desc')->take(2)->get();
            if (isset($scores[1])) {
                $post->fuel_consumption = FuelConsumptionService::fuel_consumption($scores[1]["distance"], $request->distance, $request->refueling_amount);
            } else {
                $post->fuel_consumption = null;
            }

            // データ登録
            $post->save();

            // 二重送信防止
            header("Location:/fuel");
            exit;   
        
        } else {
            // ログイン情報がなければログイン画面へ遷移
            header("Location:./fuel/login");
            exit;
        }
    }

    public function destroy() 
    {
        // ログイン情報のidを入手
        if (Auth::id() !== null) {
            $account_id = Auth::id();

            $fuel_data = FuelConsumption::where('account_id', '=', $account_id)->orderBy('id', 'desc')->first();
            $fuel_data->delete();

            header("Location:/fuel");
            exit;   

        } else {
            // ログイン情報がなければログイン画面へ遷移
            header("Location:./fuel/login");
            exit;
        }
    }
}