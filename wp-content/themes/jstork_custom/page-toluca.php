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
                <h5 class="text-center font-bold title">7月15日国際交流マッチ</h5>
                <section class="mt-5 pb-5 team-section">
                    <div class="row">
                        <div class="col-3">
                            <img class="team-logo" src="<?=get_stylesheet_directory_uri(); ?>/img/toluca_logo.jpg">
                        </div>
                        <div class="col-9 font-bold">
                            <p>SRT</p>
                            <p>(メキシコ合衆国 トルーカ市)</p>
                            <p class="text-md mt-2 font-bold">監督：JOSÉ LUIS GAVIÑO MERCADO </p>
                        </div>
                        <div class="my-3">
                            <img class="team-img" src="<?=get_stylesheet_directory_uri(); ?>/img/toluca_team.jpg">
                        </div>
                    </div>
                    <p class="text-md font-bold ms-2 team-sub-title">SRT - 選手紹介</p>
                    <table class="player table table-striped" style="width: 100%; font-size: 1.2em; text-align: center;">
                        <tr>
                            <th>背番号</th>
                            <th>選手名</th>
                        </tr>
                        <tr>
                            <th>12</th>
                            <th>SANTIAGO ALDAMA GONZÁLEZ</th>
                        </tr>
                        <tr>
                            <th>8</th>
                            <th>ERIK JOSÉ ÁVILA DÍAZ</th>
                        </tr>
                        <tr>
                            <th>6</th>
                            <th>EDSON GERARDO DE LA TORRE ROGEL  
                            </th>
                        </tr>
                        <tr>
                            <th>21</th>
                            <th>DEREK RODRIGO DÍAZ FLORES 
                            </th>
                        </tr>
                        <tr>
                            <th>9</th>
                            <th>JOSÉ MARÍA DOSAL CERVERA 
                            </th>
                        </tr>
                        <tr>
                            <th>11</th>
                            <th>RAFAEL DOSAL CERVERA 
                            </th>
                        </tr>
                        <tr>
                            <th>23</th>
                            <th>RAFAEL DOSAL CERVERA JOSÉ SALVADOR GAVIÑO MEDINA</th>
                        </tr>
                        <tr>
                            <th>17</th>
                            <th>TADEO MORTERA MIRANDA 
                            </th>
                        </tr>
                        <tr>
                            <th>19</th>
                            <th>AXEL MARTÍN ROJAS ACEVES
                            </th>
                        </tr>
                        <tr>
                            <th>4</th>
                            <th>MATÍAS MAXIMILIANO ROSAS VARGAS 
                            </th>
                        </tr>
                        <tr>
                            <th>13</th>
                            <th>JONATHAN SAAVEDRA LÓPEZ 
                            </th>
                        </tr>
                        <tr>
                            <th>7</th>
                            <th>SANTIAGO SOLORIO ROSILES 
                            </th>
                        </tr>
                        <tr>
                            <th>10</th>
                            <th>EMILIO TÉLLEZ GONZÁLEZ 
                            </th>
                        </tr>
                        <tr>
                            <th>18</th>
                            <th>RICARDO UGALDE VIVAS 
                            </th>
                        </tr>
                        <tr>
                            <th>24</th>
                            <th>PATRICIO CASTRO MEDINA
                            </th>
                        </tr>
                    </table>
                </section>
            </section>


            <section class="mt-5 pb-5 team-section">
                    <div class="row">
                        <div class="col-3">
                            <img class="team-logo" src="<?=get_stylesheet_directory_uri(); ?>/img/ryusei_logo.jpg">
                        </div>
                        <div class="col-9 font-bold">
                            <p>大宮流星サッカースポーツ少年団</p>
                            <p>(埼玉県さいたま市)</p>
                            <p class="text-md mt-2 font-bold">監督：戸野塚 晃</p>
                        </div>
                        <div class="my-3">
                            <img class="team-img" src="<?=get_stylesheet_directory_uri(); ?>/img/ryusei_team.jpg">
                        </div>
                    </div>
                    <p class="text-md font-bold ms-2 team-sub-title">大宮流星サッカースポーツ少年団 - 選手紹介</p>
                    <table class="player table table-striped" style="width: 100%; font-size: 1.2em; text-align: center;">
                        <tr>
                            <th>背番号</th>
                            <th>選手名</th>
                        </tr>
                        <tr>
                            <th>10</th>
                            <th>小野 直輝</th>
                        </tr>
                        <tr>
                            <th>8</th>
                            <th>蛭田 兼晟</th>
                        </tr>
                        <tr>
                            <th>14</th>
                            <th>田村 維吹</th>
                        </tr>
                        <tr>
                            <th>11</th>
                            <th>島田 凌太郎</th>
                        </tr>
                        <tr>
                            <th>3</th>
                            <th>和田 武</th>
                        </tr>
                        <tr>
                            <th>7</th>
                            <th>石黒 和玖</th>
                        </tr>
                        <tr>
                            <th>1</th>
                            <th>名取 大和</th>
                        </tr>
                        <tr>
                            <th>4</th>
                            <th>高谷 陽流</th>
                        </tr>
                        <tr>
                            <th>21</th>
                            <th>松谷 亘希</th>
                        </tr>
                        <tr>
                            <th>12</th>
                            <th>夘田 悠記</th>
                        </tr>
                        <tr>
                            <th>9</th>
                            <th>宮野 阿蓮</th>
                        </tr>
                        <tr>
                            <th>5</th>
                            <th>下田 來空</th>
                        </tr>
                        <tr>
                            <th>6</th>
                            <th>金子 樹希</th>
                        </tr>
                        <tr>
                            <th>2</th>
                            <th>白土 楓</th>
                        </tr>
                        <tr>
                            <th>15</th>
                            <th>細沼 新</th>
                        </tr>
                        <tr>
                            <th>13</th>
                            <th>村田 悠斗</th>
                        </tr>                        
                    </table>
                </section>
            </section>



            <section class="mt-5 pb-5 team-section">
                    <div class="row">
                        <div class="col-3">
                            <img class="team-logo" src="<?=get_stylesheet_directory_uri(); ?>/img/blitz_logo.jpg">
                        </div>
                        <div class="col-9 font-bold">
                            <p>岩槻ブリッツ</p>
                            <p>(埼玉県さいたま市)</p>
                            <p class="text-md mt-2 font-bold">監督：田部井 健太</p>
                        </div>
                        <div class="my-3">
                            <img class="team-img" src="<?=get_stylesheet_directory_uri(); ?>/img/blitz_team.jpg">
                        </div>
                    </div>
                    <p class="text-md font-bold ms-2 team-sub-title">岩槻ブリッツ - 選手紹介</p>
                    <table class="player table table-striped" style="width: 100%; font-size: 1.2em; text-align: center;">
                        <tr>
                            <th>背番号</th>
                            <th>選手名</th>
                        </tr>
                        <tr>
                            <th>11</th>
                            <th>千葉 海斗</th>
                        </tr>
                        <tr>
                            <th>2</th>
                            <th>田部井 一馬</th>
                        </tr>
                        <tr>
                            <th>3</th>
                            <th>加藤 莉那</th>
                        </tr>
                        <tr>
                            <th>4</th>
                            <th>寺口 斗真</th>
                        </tr>
                        <tr>
                            <th>5</th>
                            <th>渡邊 惺南</th>
                        </tr>
                        <tr>
                            <th>6</th>
                            <th>田口 裕仁</th>
                        </tr>
                        <tr>
                            <th>7</th>
                            <th>中村 竜絆</th>
                        </tr>
                        <tr>
                            <th>8</th>
                            <th>村田 颯人</th>
                        </tr>
                        <tr>
                            <th>9</th>
                            <th>大田原 仁心</th>
                        </tr>
                        <tr>
                            <th>10</th>
                            <th>夏苅 信隆</th>
                        </tr>
                        <tr>
                            <th>11</th>
                            <th>高橋 悠翔</th>
                        </tr>
                        <tr>
                            <th>12</th>
                            <th>今田 日生愛</th>
                        </tr>
                        <tr>
                            <th>13</th>
                            <th>大滝 直樹</th>
                        </tr>
                        <tr>
                            <th>17</th>
                            <th>小木田 丈</th>
                        </tr>
                        <tr>
                            <th>18</th>
                            <th>三澤 楓</th>
                        </tr>
                       
                    </table>
                </section>
            </section>
        </main>

<?php get_footer(); ?>
