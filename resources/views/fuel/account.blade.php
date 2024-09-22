<x-app-layout>
    <div class="container">
        <div class="row">
            <div class="base contact">
                <div class="head">
                    <h2 class="contact_header">燃費計算ツール</h2>
                </div>
                
                <form class="main_form" method="post" action="{{ url('fuel/account/create') }}">
                @csrf
                    <p class="explanation">アカウント作成</p>
                    <div class="form-group">
                        <div class="form_item">
                            <p class="form_item_label">メールアドレス（ID）&nbsp;&nbsp;<span class="badge bg-danger">必須</span></p>
                            <input type="email" name="email" class="form_item_input" required>
                        </div>
                        <div class="form_item">
                            <p class="form_item_label">パスワード（4～12文字）&nbsp;&nbsp;<span class="badge bg-danger">必須</span><br>※半角英数字のみ </p>
                            <input type="password" name="pass1" class="form_item_input" required>
                        </div>
                        <div class="form_item">
                            <p class="form_item_label">パスワード確認&nbsp;&nbsp;<span class="badge bg-danger">必須</span></p>
                            <input type="password" name="pass2" class="form_item_input" required>
                        </div>

                        @if (isset($account_duplication))
                            @if ($account_duplication === 0)
                            <div class="form_check">
                                <p>※既に登録されているEメールアドレスです。他のメールアドレスを使用してください。</p>
                            @endif

                            @if ($account_error === 0)
                            <div class="form_check">
                                <p>※パスワードが一致しません。入力し直してください。</p>
                            @endif

                            @if ($pass_length === 0)
                            <div class="form_check">
                                <p>※パスワードは4文字以上12文字以内、半角英数字のみです。</p>
                            @endif
                        @endif

                        <div class="button account">
                            <button class="main_button return" type="button" onclick="history.back()">戻る</button><br>
                            <button class="main_button" type="submit" value="submit">確認画面へ進む</button>
                        </div>
                        
                    </div>
                </form> 
            </div>
        </div>
    </div>
</x-app-layout>