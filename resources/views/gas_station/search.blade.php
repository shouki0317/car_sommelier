<x-app-layout>
    <div class="container">
        <div class="row">
            <div class="col-8">

                <!-- ガソリンスタンド検索 -->
                <div class="base gs_search">
                    <div class="head">
                        <h2 class="gs_search_header">ガソリンスタンド検索</h2>
                    </div>

                    <form method="get" action="{{ url('/gas_station/search2') }}">
                    @csrf
                        <div class="search_inner">
                            <h3>位置情報を取得する</h3>
                            <div class="geo_location">
                                <p id="address" class="address">ここに住所が表示されます</p>
                                <input type="hidden" name="pref1" id="pref1">
                                <input type="hidden" name="city1" id="city1">
                                <button class="gl_button" type="button" id="get-gps">位置情報取得</button>
                            </div>
                        </div>

                        <div class="search_inner">
                            <h3>都道府県 / 市区町村を選択する</h3>
                            <label class="selectbox-003">
                                <select name="pref2" id="pref"></select>
                                <select name="city2" id="city">
                                <option value="">市区町村で絞り込む</option>
                                </select>
                            </label>
                        </div>

                        <p class="explanation">※どちらも入力された場合は、「都道府県 / 市区町村を選択する」が優先されます。</p>

                        @if (isset($gs_search_error))
                            <p class="gs_search_error">※位置情報を取得するか、「都道府県 / 市区町村」を選択してください。</p>
                        @endif

                        <div class="button">
                            <button class="main_button col-1-4" type="submit" value="submit">Search</button>
                        </div>  
                    </form>
                </div>


                <!-- 近隣のガソリンスタンド店舗 -->
                <div class="base gas_station">
                    <div class="head gas_station_head">
                        <h2 class="gas_station_header">ガソリンスタンド店舗検索結果</h2>
                        <div class="total">
                            <p>店舗数 : {{ $gs_result->total() }}件</p>
                        </div>
                    </div>

                    @if ($gs_result->total() === 0)
                        <p class="gas_station_name">検索結果はありません。</p>
                    @endif

                    <div class="gas_station_result">
                        @foreach( $gs_result as $gs)
                            <div class="gas_station_group">
                                <div class="icon">
                                    @if ($gs->self === "セルフ")
                                    <div class="self">
                                        <p class="self1">セルフ</p>
                                    </div>
                                    @endif
                                    @if ($gs->self === "フルサービス")
                                    <div class="full_service">
                                        <p class="full_service1">フル</p>
                                        <p class="full_service2">サービス</p>
                                    </div>
                                    @endif
                                    @if ($gs->self === "")
                                    <div class="unknown">
                                        <p class="unknown1">不明</p>  
                                    </div>
                                    @endif
                                </div>
                                <div class="contents">
                                    <a href="{{ route('gas_station.detail', ['id' => $gs->id ]) }}">{{ $gs->store_name }}</a>
                                    <p class="gas_station_address">{{ $gs->address }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="pagenate">
                        {{ $gs_result->appends(['pref1' => $pref, 'city1' => $city])->links() }}
                    </div>
                </div>

            </div>

                
            <div class="col-4">
                <!-- 燃料の全国平均価格 -->
                <div class="head price_head">
                    <h2 class="price_header">現在の全国平均価格</h2>
                </div>
                <div class="base price">
                    <div class="row">
                        <div class="col-6 tl-1">
                            <p><span class="fuel_name fuel_name1">レギュラー</span></p>
                            <p><span class="fuel_name fuel_name2">ハイオク</span></p>
                            <p><span class="fuel_name fuel_name3">軽油</span></p>
                            <p><span class="fuel_name fuel_name4">灯油</span></p>
                        </div>
                        <div class="col-6 tr-1">
                            <p>{{ $tables->regular }}円</p>
                            <p>{{ $tables->high_octane }}円</p>
                            <p>{{ $tables->diesel }}円</p>
                            <p>{{ $tables->kerosene }}円</p>
                        </div>
                        <div class="tr">
                            <p class="date">※{{ $tables->date }}</p>
                        </div>
                    </div>
                </div>
                

                <!-- Twitter -->
                <div class="head t_head">
                    <h2 class="price_header">Twitter</h2>
                </div>
                <div class="twitter">
                    <div class="timeline">
                        <a class="twitter-timeline" data-height="700" href="https://twitter.com/eneos_enekey?ref_src=twsrc%5Etfw">Tweets by eneos_enekey</a>
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>