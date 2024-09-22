<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\GsData;
use App\Models\Price;

class GasStationController extends Controller
{
    // private $name = 'aaa';

    // public function getName($end_str)
    // {
    //     return $this->name . $end_str;
    // }  

    // メソッド
    public function top(Request $request) 
    {
        // 現在の全国平均価格入手
        $tables = Price::orderBy('id', 'desc')->first();

    return view('gas_station.index', compact('tables'));
    }

    public function search(Request $request) 
    {
        // 現在の全国平均価格入手
        $tables = Price::orderBy('id', 'desc')->first();

        // 全て入力されていない状態でSearchされた場合
        if ($request->pref1 === null && $request->city1 === null && $request->pref2 === null && $request->city2 === null) {
                $gs_search_error = 0; 

            return view('gas_station.index', compact('tables', 'gs_search_error'));
        } else {

            // 「都道府県 / 市区町村」が入力されている場合
            if ($request->pref2 !== null && $request->city2 !== null) {
                $gs_result = GsData::where('address', 'like', '%'.$request->pref2.$request->city2.'%')->paginate(10);
                $pref = $request->pref2;
                $city = $request->city2;
                $sort = $request->sort;
                
                return view('gas_station.search', compact('tables', 'gs_result', 'sort', 'pref', 'city'));
            }

            // 都道府県は入力されているが、市区町村は入力されていない場合
            if ($request->pref2 !== null && $request->city2 === null) {
                $gs_search_error = 0; 

                return view('gas_station.index', compact('tables', 'gs_search_error'));
            }

            // 「都道府県 / 市区町村」が入力されておらず、位置情報は取得されている場合
            if ($request->pref1 !== null && $request->city1 !== null) {
                $gs_result = GsData::where('address', 'like', '%'.$request->pref1.$request->city1.'%')->paginate(10);
                $pref = $request->pref1;
                $city = $request->city1;
                $sort = $request->sort;

                return view('gas_station.search', compact('tables', 'gs_result', 'sort', 'pref', 'city'));
            }
        }
    }


    public function search2(Request $request) 
    {
        // 現在の全国平均価格入手
        $tables = Price::orderBy('id', 'desc')->first();

        // 全て入力されていない状態でSearchされた場合
        if ($request->pref1 === null && $request->city1 === null && $request->pref2 === null && $request->city2 === null) {
                $gs_search_error = 0;
            return view('gas_station.index', compact('tables', 'gs_search_error'));
        } else {

            // 「都道府県 / 市区町村」が入力されている場合
            if ($request->pref2 !== null && $request->city2 !== null) {
                $gs_result = GsData::where('address', 'like', '%'.$request->pref2.$request->city2.'%')->paginate(10);
                $pref = $request->pref2;
                $city = $request->city2;
                $sort = $request->sort;

                return view('gas_station.search', compact('tables', 'gs_result', 'sort', 'pref', 'city'));
            }

            // 都道府県は入力されているが、市区町村は入力されていない場合
            if ($request->pref2 !== null && $request->city2 === null) {
                $gs_search_error = 0;

                return view('gas_station.index', compact('tables', 'gs_search_error'));
            }

            // 「都道府県 / 市区町村」が入力されておらず、位置情報は取得されている場合
            if ($request->pref1 !== null && $request->city1 !== null) {
                $gs_result = GsData::where('address', 'like', '%'.$request->pref1.$request->city1.'%')->paginate(10);
                $pref = $request->pref1;
                $city = $request->city1;
                $sort = $request->sort;

                return view('gas_station.search', compact('tables', 'gs_result', 'sort', 'pref', 'city'));
            }
        }
    }


    public function detail(Request $request) 
    {
        // 現在の全国平均価格入手
        $tables = Price::orderBy('id', 'desc')->first();

        // 店舗情報
        $id = $request->id;
        $details = GsData::find($id);

        return view('gas_station.detail', compact('tables', 'details'));
    }
}