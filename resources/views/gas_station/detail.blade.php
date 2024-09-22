<x-app-layout>
    <div class="container">
        <div class="row">
            <div class="col-8">

                <!-- 近隣のガソリンスタンド店舗 -->
                <div class="base gas_station">
                    <div class="head">
                        <h2 class="gas_station_header">ガソリンスタンド店舗検索詳細</h2>
                    </div>

                    <div class="gas_station_detail">
                        <div class="detail_top">
                            <div class="detail_icon">
                                @if ($details->self === "セルフ")
                                <div class="self">
                                    <p class="self1">セルフ</p>
                                </div>
                                @endif
                                @if ($details->self === "フルサービス")
                                <div class="full_service">
                                    <p class="full_service1">フル</p>
                                    <p class="full_service2">サービス</p>
                                </div>
                                @endif
                                @if ($details->self === "")
                                <div class="unknown">
                                    <p class="unknown1">不明</p>  
                                </div>
                                @endif
                            </div>

                            <div class="store_name_group">
                                <p class="store_name">{{ $details->store_name }}</p>
                                <p class="address">{{ $details->address }}</p>
                            </div>
                            
                        </div>

                        

                        <div class="main_info">
                            <div class="info">
                                <p class="title"><i class="fa-regular fa-clock"></i>&nbsp;営業時間</p>
                                <p class="inside1">{{ $details->business_hours }}</p>
                            </div>
                        
                            <div class="info">
                                <p class="title"><i class="fa-solid fa-phone"></i>&nbsp;電話番号</p>
                                <p class="inside2">{{ $details->tel }}</p>
                            </div>
                       
                            <div class="info">
                                <p class="title"><i class="fa-solid fa-person-circle-check"></i>&nbsp;営業タイプ</p>
                                <p class="inside3">{{ $details->self }}</p>
                            </div>
                       
                            <div class="info">
                                <p class="title"><i class="fa-solid fa-triangle-exclamation"></i>&nbsp;定休日</p>
                                <p class="inside4">{{ $details->holiday }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="button">
                        <button class="detail_return_btn" type="button" onclick="history.back()">一覧に戻る</button>
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