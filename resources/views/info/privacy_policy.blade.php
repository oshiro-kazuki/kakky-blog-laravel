<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{config('const.APP_NAME')}} : プライバシーポリシー</title>

        <!-- fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@200;600&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

        <!-- style -->
        <link rel="stylesheet" href="{{ asset('css/common/reset.css') }}">
        <link rel="stylesheet" href="{{ asset('css/common/header.css') }}">
        <link rel="stylesheet" href="{{ asset('css/common/footer.css') }}">
        <link rel="stylesheet" href="{{ asset('css/info/privacy_policy.css') }}">
    </head>
    <body>
        @include('include.common.header')
        <main>
            <h1>プライバシーポリシー</h1>
            <article>
                <section>
                    <h3>コメント・お問い合わせ</h3>
                    <ul>
                        <li>コメント及びお問い合わせについて自動スパム検出サービスを通じて確認を行う場合があります。</li>
                        <li>お客様がこのサイトにコメントまたはお問い合せを行う際、コメント及びお問い合せフォームに表示されているデータ、そしてスパム検出に役立てるための IP アドレスとブラウザーユーザーエージェント文字列を収集します。</li>
                        <li>メールアドレスから作成される匿名化された (「ハッシュ」とも呼ばれる) 文字列は、お客様が Gravatar サービスを使用中かどうか確認するため同サービスに提供されることがあります。同サービスのプライバシーポリシーは<a href="https://stg.kakky-blog.com/info/privacy_policy" class="text_link">https://kakky-blog.com/info/privacy_policy</a>にあります。コメントが承認されると、プロフィール画像がコメントとともに一般公開されます。</li>
                    </ul>
                </section>
                <section>
                    <h3>Cookie</h3>
                    <p>当サイトでは以下の目的のため、クッキーを使用しています。</p>
                    <ul>
                        <li>当サイトのアクセス状況を分析し、当サービスを改善するため。</li>
                        <li>Googleなどの第三者配信事業者が Cookie を使用して、お客様がそのウェブサイトや他のウェブサイトに過去にアクセスした際の情報に基づいて広告を配信するため。</li>
                        <li>Google が広告 Cookie を使用することにより、お客様がそのサイトや他のサイトにアクセスした際の情報に基づいて、Google やそのパートナーが適切な広告をお客様に表示するため。</li>
                        <li>第三者配信事業者や広告ネットワークの配信する広告をサイトに掲載するため。</li>
                        <li>対象となる第三者配信事業者や広告ネットワークの適切なウェブサイトへのリンクを掲載するため。</li>
                    </ul>
                    <p>Googleを含む第三者配信事業者によるパーソナライズド広告の掲載で使用するクッキーの使用を以下URLより無効化することが可能です。<br><a href="http://www.aboutads.info" class="text_link text_link_line">http://www.aboutads.info</a><br> クッキーを使用することで当サイトはお客様のコンピュータを識別できるようになりますが、お客様個人を特定できるものではありません。また、ブラウザの設定によりクッキーの受け取りを拒否することができますが、当サイトが提供するサービスを一部利用できなくなる場合があります。</p>
                </section>
                <section>
                    <h3>データの収集に使われる類似の技術について</h3>
                    <ul>
                        <li>Google アナリティクスを使用しています。</li>
                        <li>Google アナリティクスでデータが収集、処理される仕組みについて以下のURLを参照してください。</li>
                    </ul>
                    <p><a href="https://www.google.com/intl/ja/policies/privacy/partners/" class="text_link text_link_line">https://www.google.com/intl/ja/policies/privacy/partners/</a></p>
                </section>
                <section>
                    <h3>著作権・肖像権</h3>
                    <ul>
                        <li>当サイトのコンテンツ（写真や画像、文章など）の著作権及び肖像権につきましては、 原則として当社に帰属しており、無断転載することを禁止します。当サイトのコンテンツを利用したい場合は、別途お問い合わせください。</li>
                        <li>当サイトは著作権や肖像権の侵害を目的としたものではありません。著作権や肖像権に関して問題がございましたら、お問い合わせフォームよりご連絡ください。迅速に対応いたします。</li>
                    </ul>
                </section>
                <section>
                    <h3>リンク</h3>
                    <ul>
                        <li>当サイトは基本的にリンクフリーです。リンクを行う場合の許可や連絡は不要です。</li>
                        <li>インラインフレームの使用や画像の直リンクはご遠慮ください。</li>
                    </ul>
                </section>
                <section>
                    <h3>免責事項</h3>
                    <ul>
                        <li>当サイトからのリンクやバナーなどで移動したサイトで提供される情報、サービス等について一切の責任を負いません。</li>
                        <li>また当サイトのコンテンツ・情報について、できる限り正確な情報を提供するように努めておりますが、正確性や安全性を保証するものではありません。情報が古くなっていることもございます。</li>
                        <li>当サイトに掲載された内容によって生じた損害等の一切の責任を負いかねますのでご了承ください。</li>
                    </ul>
                </section>
            </article>
            @include('include.button.top_btn')
        </main>
        @include('include.common.footer')
        <script src="{{ asset('js/common/dom_operation.js') }}"></script>
        <script src="{{ asset('js/common/header.js') }}"></script>
        <script src="{{ asset('js/common/footer.js') }}"></script>
    </body>
</html>
