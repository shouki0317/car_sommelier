<x-app-layout>
    <div class="container">

        <div class="row login_page">
            <div class="col-8">
                
                <!-- 燃費計算ツール -->
                <div class="base fuel_input">
                    <div class="head">
                        <h2 class="fuel_header">燃費計算ツール</h2>
                        <p class="login_now">未ログイン</p>
                    </div>

                    <form class="main_form" method="post" action="{{ url('/fuel/login') }}">
                    @csrf
                        <div class="fuel_input_head">
                            <p class="heading">燃費計算ツールにログイン</p>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="controls">
                                    <label for="email" class="label-date">ログインID（Eメールアドレス)</label>
                                    <input type="email" id="email" class="floatLabel" name="email" required style="width: 60%;">
                                </div>      
                                <div class="controls">
                                    <label for="password">パスワード</label>
                                    <input type="password" id="password" class="floatLabel" name="password" required style="width: 60%;">
                                </div>       
                            </div>
                        </div>

                        @if ($errors->has('email'))
                        <div class="form_check">
                            <p>{{ $errors->first('email') }}</p>
                        </div>
                        @endif
                        
                        <div class="button">
                            <button class="main_button col-1-4" type="submit" value="submit">ログイン</button>
                            <p class="account">アカウントをお持ちでない場合は<a href="/fuel/account">こちら</a></p>
                        </div>  
                    </form>
                </div>

                <!-- 最新のデータ -->
                <div class="base new_data_base">
                <div class="head new_data_head">
                    <h2 class="new_data_header">最新のデータ</h2>
                </div>
                    <div class="row fuel_consumption_data">
                        <p>ログインすると、ここに最新のデータが表示されます。</p>
                    </div>
                </div>


                <!-- 過去のデータ -->
                <div class="base data">
                <div class="head">
                    <h2 class="old_data_header">過去のデータ</h2>
                </div>
                    <div class="old_data">
                        <div class="row fuel_consumption_data">
                            <p>ログインすると、ここに過去のデータが表示されます。</p>
                        </div>
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
                

                <!-- 燃費ランキング -->
                <div class="head lank_head">
                    <h2 class="rank_header">燃費ランキング（Top5）</h2>
                </div>
                <div class="rank">
                    <div class="row fuel_consumption_data">
                        <p>ログインすると、ここに燃費ランキングが表示されます。</p>
                    </div>
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