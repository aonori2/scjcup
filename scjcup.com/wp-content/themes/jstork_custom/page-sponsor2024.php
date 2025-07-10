<?php
// デフォルトの年を設定
$default_year = wp_get_year();
$tournament = $_REQUEST['y'] ?? '';
if (!preg_match('/^\d+$/', $tournament) || $tournament > $default_year) {
    $tournament = $default_year;
}

?>
<?php get_header(); ?>
<div class="mian-image-area">
    <img class="main-img" src="<?=get_stylesheet_directory_uri(); ?>/img/S__2285785.jpg">
</div>
<main class="container py-5">
            <section>
                <h5 class="text-center font-bold title">協賛企業ご紹介</h5>
                <div class="px-3 py-2">
                    <!-- しまむら -->
                    <div class="my-5">
                        <p class="overview-box-2-title font-bold mb-3"><a href="https://www.shimamura.gr.jp/shimamura/?corp=3">株式会社しまむら</a></p>
                        <a href="https://www.shimamura.gr.jp/shimamura/?corp=3"><img class="team-img" src="<?=get_stylesheet_directory_uri(); ?>/img/sponsorship/shimamura_11.jpg"></a>
                    </div>

                    <!-- ジェイコム埼玉・東日本 -->
                    <div class="my-5">
                        <p class="overview-box-2-title font-bold my-2"><a href="https://www.footballpark.jp/">株式会社ジェイコム埼玉・東日本</a></p>
                        <a href="https://www.footballpark.jp/"><img class="sponsorship-img" src="<?=get_stylesheet_directory_uri(); ?>/img/sponsorship/Jcom_logo.jpg"></a>
                    </div>

                    <!-- フットボールパーク -->
                    <div class="my-5">
                        <p class="overview-box-2-title font-bold my-2"><a href="https://www.jcom.co.jp/">有限会社弘武堂スポーツ（フットボールパーク）</a></p>
                        <a href="https://www.jcom.co.jp/"><img class="sponsorship-img" src="<?=get_stylesheet_directory_uri(); ?>/img/sponsorship/footballpark.jpg"></a>
                    </div>

                    <!-- アサヒ飲料株式会社 -->
                    <div class="my-5">
                        <p class="overview-box-2-title font-bold my-2"><a href="https://sp.asahiinryo.co.jp">アサヒ飲料株式会社</a></p>
                        <a href="https://sp.asahiinryo.co.jp"><img class="sponsorship-img my-2" src="<?=get_stylesheet_directory_uri(); ?>/img/sponsorship/asahi.jpg"></a>
                    </div>

                    <!-- 浦和レッドダイヤモンズ株式会社 -->
                    <div class="my-5">
                        <p class="overview-box-2-title font-bold my-2"><a href="https://www.urawa-reds.co.jp">浦和レッドダイヤモンズ株式会社</a></p>
                        <a href="https://www.urawa-reds.co.jp"><img class="sponsorship-img mt-5" src="<?=get_stylesheet_directory_uri(); ?>/img/sponsorship/reds_logo_2.png"></a>
                    </div>

                    <!-- エヌ・ティ・ティ・スポーツコミュニティ株式会社 -->
                    <div class="my-5">
                        <p class="overview-box-2-title font-bold my-2"><a href="https://www.ardija.co.jp">エヌ・ティ・ティ・スポーツコミュニティ<br>株式会社</a></p>
                        <a href="https://www.ardija.co.jp"><img class="sponsorship-img my-3" src="<?=get_stylesheet_directory_uri(); ?>/img/sponsorship/Ardj_logo_4c.png"></a>
                    </div>

                    <!-- 株式会社イシクラ -->
                    <div class="my-5">
                        <p class="overview-box-2-title font-bold my-2"><a href="https://www.ishikura.co.jp/">株式会社イシクラ</a></p>
                        <a href="https://www.ishikura.co.jp/"><img class="sponsorship-img mt-2" src="<?=get_stylesheet_directory_uri(); ?>/img/sponsorship/Ishikura_logo_RGB.gif"></a>
                    </div>

                    <!-- Jrユースサッカークラブ与野 -->
                    <div class="my-5">
                        <p class="overview-box-2-title font-bold my-2"><a href="https://sc.footballnavi.jp/clubyono/">Jrユースサッカークラブ与野</a></p>
                        <a href="https://sc.footballnavi.jp/clubyono/"><img class="sponsorship-img mt-3" src="<?=get_stylesheet_directory_uri(); ?>/img/sponsorship/LOGO_club_yono.PNG"></a>
                    </div>

                    <!-- 特定非営利活動法人スポーツエクスパンド -->
                    <div class="my-5">
                        <p class="overview-box-2-title font-bold my-2"><a href="https://www.sportsexpand.org/">特定非営利活動法人スポーツエクスパンド</a></p>
                        <a href="https://www.sportsexpand.org/"><img class="sponsorship-img mt-3" src="<?=get_stylesheet_directory_uri(); ?>/img/sponsorship/npo_sportsexpand.jpg"></a>
                    </div>

                    <!-- 株式会社スポーツエクスパンド -->
                    <div class="my-5">
                        <p class="overview-box-2-title font-bold my-2"><a href="https://www.sportsexpand.jp/">株式会社スポーツエクスパンド</a></p>
                        <a href="https://www.sportsexpand.jp/"><img class="sponsorship-img mt-3" src="<?=get_stylesheet_directory_uri(); ?>/img/sponsorship/sportsexpand_inc.jpg"></a>
                    </div>

                    <!-- ユナイテッドスポーツブランズジャパン株式会社 -->
                    <div class="my-5">
                        <p class="overview-box-2-title font-bold my-2"><a href="https://uhlsport.jp">ユナイテッドスポーツブランズジャパン<br>株式会社</a></p>
                        <!-- <img class="sponsorship-img" src="<?=get_stylesheet_directory_uri(); ?>/img/sponsorship/shimamura.jpeg"> -->
                    </div>
                    
                    <p class="font-bold text-center sponsorship-sub-title my-5">大会公式LINE協賛</p>

                    <div class="my-5">
                        <p class="overview-box-2-title font-bold my-2"><a href="">株式会社ヤマセン工業</a></p>
                        <!-- <img class="sponsorship-img" src="<?=get_stylesheet_directory_uri(); ?>/img/sponsorship/shimamura.jpeg"> -->
                    </div>
                    <div class="my-5">
                        <p class="overview-box-2-title font-bold my-2"><a href="">合同会社アイ</a></p>
                        <!-- <img class="sponsorship-img" src="<?=get_stylesheet_directory_uri(); ?>/img/sponsorship/shimamura.jpeg"> -->
                    </div>
                    <div class="my-5">
                        <p class="overview-box-2-title font-bold my-2"><a href="">有限会社ZAOライフサービス</a></p>
                        <!-- <img class="sponsorship-img" src="<?=get_stylesheet_directory_uri(); ?>/img/sponsorship/shimamura.jpeg"> -->
                    </div>
                    <div class="my-5">
                        <p class="overview-box-2-title font-bold my-2"><a href="">株式会社ラウンドアバウト</a></p>
                        <!-- <img class="sponsorship-img" src="<?=get_stylesheet_directory_uri(); ?>/img/sponsorship/shimamura.jpeg"> -->
                    </div>
                    <div class="my-5">
                        <p class="overview-box-2-title font-bold my-2"><a href="">株式会社EG Forest</a></p>
                        <!-- <img class="sponsorship-img" src="<?=get_stylesheet_directory_uri(); ?>/img/sponsorship/shimamura.jpeg"> -->
                    </div>
                    <div class="my-5">
                        <p class="overview-box-2-title font-bold my-2"><a href="">合同会社美と健康コーポレーション</a></p>
                        <!-- <img class="sponsorship-img" src="<?=get_stylesheet_directory_uri(); ?>/img/sponsorship/shimamura.jpeg"> -->
                    </div>
                    <div class="my-5">
                        <p class="overview-box-2-title font-bold my-2"><a href="">Quest</a></p>
                        <!-- <img class="sponsorship-img" src="<?=get_stylesheet_directory_uri(); ?>/img/sponsorship/shimamura.jpeg"> -->
                    </div>
                    <div class="my-5">
                        <p class="overview-box-2-title font-bold my-2"><a href="">Remore</a></p>
                        <!-- <img class="sponsorship-img" src="<?=get_stylesheet_directory_uri(); ?>/img/sponsorship/shimamura.jpeg"> -->
                    </div>
                    <div class="my-5">
                        <p class="overview-box-2-title font-bold my-2"><a href="">有限会社コモン</a></p>
                        <!-- <img class="sponsorship-img" src="<?=get_stylesheet_directory_uri(); ?>/img/sponsorship/shimamura.jpeg"> -->
                    </div>
                    <div class="my-5">
                        <p class="overview-box-2-title font-bold my-2"><a href="">水谷意匠一級建築士事務所</a></p>
                        <!-- <img class="sponsorship-img" src="<?=get_stylesheet_directory_uri(); ?>/img/sponsorship/shimamura.jpeg"> -->
                    </div>
                    <div class="my-5">
                        <p class="overview-box-2-title font-bold my-2"><a href="">株式会社K&C</a></p>
                        <!-- <img class="sponsorship-img" src="<?=get_stylesheet_directory_uri(); ?>/img/sponsorship/shimamura.jpeg"> -->
                    </div>
                </div>
            </section>

        </main>

<?php get_footer(); ?>
