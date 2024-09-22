<x-app-layout>
    <div class="container">
        <div class="row">
            <div class="base contact contact_create">
                <div class="head">
                    <h2 class="contact_header">燃費計算ツール</h2>
                </div>
            
                <form class="main_form" method="post" action="{{ url('fuel/account/add') }}">
                @csrf
                    <p class="explanation">以下の内容で登録してよろしいですか？</p>
                    <div class="form-group">
                        <div class="form_item">
                            <p class="form_item_label">メールアドレス（ID） :</p>
                            <input type="hidden" name="email" value="{{ $email }}"> 
                            {{ $email }}
                        </div>
                        <div class="form_item">
                            <p class="form_item_label">パスワード :</p>
                            <input type="hidden" name="password" value="{{ $pass1 }}">
                            安全のため非表示にしています
                        </div>
                        
                        <div class="button account">
                            <button class="main_button return" type="button" onclick="history.back()">入力画面に戻る</button><br>
                            <button class="main_button col-1-4" type="submit" value="submit">登録する</button>
                        </div> 
                    </div>
                </form> 

            </div>
        </div>
    </div>
</x-app-layout>