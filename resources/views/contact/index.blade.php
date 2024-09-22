<x-app-layout>
    <div class="container">
        <div class="row">
            <div class="base contact">
                <div class="head">
                    <h2 class="contact_header">お問い合わせフォーム</h2>
                </div>
                
                <form class="main_form" method="post" action="{{ url('/contact/create') }}">
                @csrf
                    <p class="explanation">
                        このサイト内の不明点、改善してほしい点などがありましたら、<br>
                        下記のフォームよりお気軽にお問い合せください。
                    </p>
                    <div class="form-group">
                        <div class="form_item">
                            <p class="form_item_label">お名前(ニックネーム可)&nbsp;&nbsp;<span class="badge bg-danger">必須</span></p>
                            <input type="text" name="name" class="form_item_input" placeholder="例）山田太郎" required>
                        </div>
                        <div class="form_item">
                            <p class="form_item_label">メールアドレス&nbsp;&nbsp;<span class="badge bg-danger">必須</span></p>
                            <input type="email" name="email" class="form_item_input" placeholder="例）example@gmail.com" required>
                        </div>
                        <div class="form_item">
                            <p class="form_item_label">件名&nbsp;&nbsp;<span class="badge bg-secondary">任意</span></p>
                            <input type="text" name="subject" class="form_item_input" placeholder="例）〇〇について">
                        </div>
                        <div class="form_item">
                            <p class="form_item_label msg">メッセージ本文&nbsp;&nbsp;<span class="badge bg-danger">必須</span></p>
                            <textarea name="message" class="form_item_textarea" placeholder="例）〇〇を改善してほしい。"required></textarea>
                        </div>
                        <div class="button">
                            <button class="main_button col-1-4" type="submit" value="submit">確認画面へ進む</button>
                        </div> 
                    </div>
                </form> 

            </div>
        </div>
    </div>
</x-app-layout>