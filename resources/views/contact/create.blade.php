<x-app-layout>
    <div class="container">
        <div class="row">
            <div class="base contact contact_create">
                <div class="head">
                    <h2 class="contact_header">お問い合わせフォーム</h2>
                </div>
            
                <form class="main_form" method="post" action="{{ url('/contact/add') }}">
                @csrf
                    <p class="explanation">以下の内容で送信してよろしいですか？</p>
                    <div class="form-group">
                        <div class="form_item">
                            <p class="form_item_label">お名前(ニックネーム可) :</p>
                            <input type="hidden" name="name" value="{{ $name }}"> 
                            <div class="content_right">
                                <p class="form_content">{{ $name }}</p>
                            </div>
                        </div>
                        <div class="form_item">
                            <p class="form_item_label">メールアドレス :</p>
                            <input type="hidden" name="email" value="{{ $email }}">
                            <div class="content_right">
                                <p class="form_content">{{ $email }}</p>
                            </div>
                        </div>
                        <div class="form_item">
                            <p class="form_item_label">件名 :</p>
                            <input type="hidden" name="subject" value="{{ $subject }}">
                            <div class="content_right">
                                <p class="form_content">{{ $subject }}</p>
                            </div>
                        </div>
                        <div class="form_item">
                            <p class="form_item_label msg">メッセージ本文 :</p>
                            <input type="hidden" name="message" value="{{ $message }}">
                            <div class="content_right">
                                <p class="form_content">{{ $message }}</p>
                            </div>
                        </div>
                        <div class="button">
                            <button class="main_button return" type="button" onclick="history.back()">入力画面に戻る</button><br>
                            <button class="main_button col-1-4" type="submit" value="submit">送信する</button>
                        </div> 
                    </div>
                </form> 

            </div>
        </div>
    </div>
</x-app-layout>