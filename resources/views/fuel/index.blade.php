<x-app-layout>
    <div class="container">
        <div class="row">
            <div class="col-8">
                
                <!-- 燃費計算ツール -->
                <div class="base fuel_input">
                    <div class="head">
                        <h2 class="fuel_header">燃費計算ツール</h2>
                        <p class="login_now">{{ Auth::user()->email }}でログイン中 / 
                            <form method="post" action="{{ url('/fuel/logout') }}">
                            @csrf
                                <input type="hidden" value="{{ Auth::user()->id }}">
                                <button type="submit" class="logout_btn">ログアウトする</button>
                            </form>
                        </p>
                    </div>

                    <form class="main_form" method="post" action="{{ url('/fuel/') }}">
                    @csrf
                        <div class="fuel_input_head">
                            <p class="heading">給料は満タンとし、レシート等に記載の給油金額、給油量を入力してください。</p>
                            <p class="heading">総走行距離は車内メーターのオドメーター値を入力してください。</p>
                            <p class="heading">※燃費は2回目の入力より算出されます。</p>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-6">
                                    <div class="controls">
                                        <label for="date" class="label-date"><i class="fa fa-calendar"></i>&nbsp;&nbsp;給油日</label>
                                        <input type="date" id="date" class="floatLabel" name="date" value="<?php echo date('Y-m-d'); ?>">
                                    </div>      
                                    <div class="controls">
                                        <label for="distance"><i class="fa-solid fa-car-side"></i>&nbsp;&nbsp;総走行距離（㎞）</label>
                                        <input type="text" id="distance" class="floatLabel" name="distance" placeholder="例）12345" required maxlength="6">
                                    </div>       
                                </div>

                                <div class="col-6">
                                    <div class="controls">
                                        <label for="money"><i class="fa-solid fa-yen-sign"></i>&nbsp;&nbsp;給油金額（円）</label>
                                        <input type="text" id="money" class="floatLabel" name="money" placeholder="例）1234" required maxlength="5">
                                    </div>
                                    <div class="controls">
                                        <label for="refueling_amount"><i class="fa-solid fa-droplet"></i>&nbsp;&nbsp;給油量（L）</label>
                                        <input type="text" id="refueling_amount" class="floatLabel" name="refueling_amount" placeholder="例）12.34" required maxlength="5">
                                    </div>
                                </div>
                                
                                <!-- アカウントID -->
                                <input type="hidden" name="account_id" value="{{ Auth::user()->id }}">

                            </div>
                        </div>

                        @if (isset($form_check))
                        <div class="form_check">
                            @if ( $form_check["distance"] === 0 )
                                <p>※総走行距離は、半角数字で正しく入力してください。</p>
                            @endif
                            @if ( $form_check["money"] === 0 )
                                <p>※給油金額は、半角数字で正しく入力してください。</p>
                            @endif
                            @if ( $form_check["refueling_amount"] === 0 )
                                <p>※給油量は、半角数字で正しく入力してください。</p>
                            @endif
                            @if ( $form_check["refueling_amount_error"] === 0 )
                                <p>※給油量は、0.01～99.99Lの範囲内で入力してください。</p>
                            @endif
                            @if ( $form_check["fuel_price_error"] === 0 )
                                <p>※燃料価格が異常な値となってしまいます。給油金額または給油量を再度確認してください。</p>
                            @endif
                            @if ( $form_check["fuel_consumption_error"] === 0 )
                                <p>※燃費が異常な値となってしまいます。総走行距離または給油量を再度確認してください。</p>
                            @endif
                        </div>
                        @endif
                        
                        <div class="button">
                            <button class="main_button col-1-4" type="submit" value="submit">登録する</button>
                        </div>  
                    </form>
                </div>

                <!-- 最新のデータ -->
                <div class="base new_data_base">
                    <div class="head new_data_head">
                        <h2 class="new_data_header">最新のデータ</h2>
                        <div class="operation">
                        @if (isset($new_scores))
                            <form method="post" action="{{ url('/fuel/edit') }}">
                            @csrf
                                <button class="edit_icon">編集</button>
                            </form>
                            <form method="post" action="{{ url('/fuel/destroy') }}">
                            @csrf
                                <button class="delete_icon" onclick="return confirm('本当に削除してもよろしいですか？')">削除</button>
                            </form>
                        @endif
                        </div>
                    </div>
                    @if (isset($new_scores))
                        @if ($new_scores->fuel_consumption <= 0)
                        <p>※初回入力の燃費は計算されません。2回目の入力より算出されます。</p>
                        @endif
                    <div class="row fuel_consumption_data">
                        <div class="col-3 pl">
                            <div class="fuel_consumption ml">
                                @if ($new_scores->fuel_consumption > 0)
                                    <p class="data">{{ number_format($new_scores->fuel_consumption, 1) }}</p>
                                @else
                                    <p class="data">--.-</p>
                                @endif
                                <p class="unit">km/L</p>
                            </div>
                        </div>
                        <div class="col-9">
                            <div class="inner">
                                <p class="data_date">{{ $new_scores->date }}</p>
                                <div class="row">
                                    <div class="col-6">
                                        <div class="df">
                                            <div class="tl">
                                                <p class="data_list">給油金額</p>
                                            </div>
                                            <div class="tr">
                                                <p class="data_list">{{ $new_scores->money }} 円</p>
                                            </div>
                                        </div>

                                        <div class="df">
                                            <div class="tl">
                                                <p class="data_list">給油量</p>
                                            </div>
                                            <div class="tr">
                                                <p class="data_list">{{ number_format($new_scores->refueling_amount, 2) }} L</p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-6">
                                    <div class="df">
                                            <div class="tl">
                                                <p class="data_list">総走行距離</p>
                                            </div>
                                            <div class="tr">
                                                <p class="data_list">{{ $new_scores->distance }} km</p>
                                            </div>
                                        </div>

                                        <div class="df">
                                            <div class="tl">
                                                <p class="data_list">燃料価格</p>
                                            </div>
                                            <div class="tr">
                                                <p class="data_list">{{ $new_scores->fuel_price }} 円/L</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @else
                    <div class="no_data">
                        <p>データがありません。</p>
                    </div>
                    @endif
                </div>


                <!-- 過去のデータ -->
                <div class="base data">
                <div class="head">
                    <h2 class="old_data_header">過去のデータ</h2>
                </div>
                    @if (isset($old_score))
                    <div class="old_data">
                        @foreach($old_score as $score)
                        <div class="row fuel_consumption_data">
                            <div class="col-3 pl">
                                <div class="fuel_consumption ml">
                                    @if ($score->fuel_consumption > 0)
                                    <p class="data">{{ number_format($score->fuel_consumption, 1) }}</p>
                                    @else
                                    <p class="data">--.-</p>
                                    @endif
                                    <p class="unit">km/L</p>
                                </div>
                            </div>
                            
                            <div class="col-9">
                                <div class="inner">
                                    <p class="data_date">{{ $score->date }}</p>
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="df">
                                                <div class="tl">
                                                    <p class="data_list">給油金額</p>
                                                </div>
                                                <div class="tr">
                                                    <p class="data_list">{{ $score->money }} 円</p>
                                                </div>
                                            </div>

                                            <div class="df">
                                                <div class="tl">
                                                    <p class="data_list">給油量</p>
                                                </div>
                                                <div class="tr">
                                                    <p class="data_list">{{ number_format($score->refueling_amount, 2) }} L</p>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-6">
                                        <div class="df">
                                                <div class="tl">
                                                    <p class="data_list">総走行距離</p>
                                                </div>
                                                <div class="tr">
                                                    <p class="data_list">{{ $score->distance }} km</p>
                                                </div>
                                            </div>

                                            <div class="df">
                                                <div class="tl">
                                                    <p class="data_list">燃料価格</p>
                                                </div>
                                                <div class="tr">
                                                    <p class="data_list">{{ $score->fuel_price }} 円/L</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <div class="pagenate">
                        {{ $old_score->links() }}
                    </div>
                    @else
                    <div class="no_data">
                        <p>データがありません。</p>
                    </div>
                    @endif
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
                

                <!-- 燃費ランキング -->
                <div class="head lank_head">
                    <h2 class="rank_header">燃費ランキング（Top5）</h2>
                </div>
                <div class="rank">
                    @foreach($ranking as $rank)
                    <div class="row fuel_consumption_data">
                        <div class="col-3 pl">
                            <div class="fuel_consumption ml">
                                @if (isset($rank->fuel_consumption))
                                <p class="data">{{ number_format($rank->fuel_consumption, 1) }}</p>
                                @else
                                <p class="data">--.-</p>
                                @endif
                                <p class="unit">km/L</p>
                            </div>
                        </div>
                        
                        <div class="col-9">
                            <div class="inner">
                                <p class="data_date">{{ $rank->date }}</p>
                                    
                                <div class="df-1">
                                    <div class="tl">
                                        <p class="data_list">総走行距離</p>
                                    </div>
                                    <div class="tr">
                                        <p class="data_list">{{ $rank->distance }} km</p>
                                    </div>
                                </div>

                                <div class="df-2">
                                    <div class="tl">
                                        <p class="data_list">燃料価格</p>
                                    </div>
                                    <div class="tr">
                                        <p class="data_list">{{ $rank->fuel_price }} 円/L</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                    @if (!isset($new_scores))
                    <div class="row fuel_consumption_data">
                        <p class="no_data">データがありません。</p>
                    </div>
                    @endif
                </div>

                <!-- Twitter -->
                <div class="head t_head">
                    <h2 class="price_header">Twitter</h2>
                </div>
                <div class="twitter">
                    <div class="timeline">
                        <a class="twitter-timeline" data-height="700" href="https://twitter.com/e_nenpi?ref_src=twsrc%5Etfw">Tweets by e_nenpi</a>
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>