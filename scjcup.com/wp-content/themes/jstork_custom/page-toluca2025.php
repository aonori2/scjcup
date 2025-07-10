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
                <h5 class="text-center font-bold title">7月21日国際交流マッチ</h5>

<section class="mt-5 pb-5 team-section">
            <div class="row">
                <div class="col-3">
                    <img class="team-logo" src="https://scjcup.com/wp-content/uploads/2024/07/miso.jpg">
                </div>
                <div class="col-9 font-bold">
                    <p>MISO Junior Elite U12 BOYS</p>
                    <p>(その他アメリカ合衆国 ハワイ州)</p>
                    <p class="text-md mt-2 font-bold">グループA</p>
                    <p class="text-md mt-2 font-bold">監督：MR. OLSI UKU</p>
                </div>
                <div class="my-3">
                    <img class="team-img" src="https://scjcup.com/wp-content/uploads/2025/06/MIS-image3.png">
                </div>
            </div>
            <p class="text-md font-bold ms-2 team-sub-title">MISO Junior Elite U12 BOYS - 選手紹介</p>
            <table class="player table table-striped" style="width: 100%; font-size: 1.2em; text-align: center;">
                <tbody><tr>
                    <th>背番号</th>
                    <th>選手名</th>
                </tr>
                                <tr>
                    <th>1</th>
                    <th>Cameron Cheatham</th>
                </tr>
                                <tr>
                    <th>2</th>
                    <th>Grant Butenhoff</th>
                </tr>
                                <tr>
                    <th>3</th>
                    <th>Kasyn Yonamine</th>
                </tr>
                                <tr>
                    <th>4</th>
                    <th>Graham Rinkavage</th>
                </tr>
                                <tr>
                    <th>5</th>
                    <th>Ezekiel Lee</th>
                </tr>
                                <tr>
                    <th>6</th>
                    <th>Pono Braunthal</th>
                </tr>
                                <tr>
                    <th>7</th>
                    <th>Wes Pickman</th>
                </tr>
                                <tr>
                    <th>8</th>
                    <th>Kua Santiago</th>
                </tr>
                                <tr>
                    <th>9</th>
                    <th>Raphael Yip</th>
                </tr>
                                <tr>
                    <th>10</th>
                    <th>Stephen Xiao</th>
                </tr>
                                <tr>
                    <th>11</th>
                    <th>Pili Gleason</th>
                </tr>
                            </tbody></table>
        </section>

<section class="mt-5 pb-5 team-section">
            <div class="row">
                <div class="col-3">
                    <img class="team-logo" src="https://scjcup.com/wp-content/uploads/2024/07/miso.jpg">
                </div>
                <div class="col-9 font-bold">
                    <p>MISO Junior Elite U12 GIRLS</p>
                    <p>(その他アメリカ合衆国 ハワイ州)</p>
                    <p class="text-md mt-2 font-bold">グループB</p>
                    <p class="text-md mt-2 font-bold">監督：Ｍr. Joe Takahashi</p>
                </div>
                <div class="my-3">
                    <img class="team-img" src="https://scjcup.com/wp-content/uploads/2025/06/MIS-image2.png">
                </div>
            </div>
            <p class="text-md font-bold ms-2 team-sub-title">MISO Junior Elite U12 GIRLS - 選手紹介</p>
            <table class="player table table-striped" style="width: 100%; font-size: 1.2em; text-align: center;">
                <tbody><tr>
                    <th>背番号</th>
                    <th>選手名</th>
                </tr>
                                <tr>
                    <th>1</th>
                    <th>Shyne Upchurch</th>
                </tr>
                                <tr>
                    <th>1</th>
                    <th>Ale’anahenaheokeola Kalai</th>
                </tr>
                                <tr>
                    <th>2</th>
                    <th>Kylie Siegmund</th>
                </tr>
                                <tr>
                    <th>2</th>
                    <th>Miya Okamura</th>
                </tr>
                                <tr>
                    <th>3</th>
                    <th>Savannah Osborn</th>
                </tr>
                                <tr>
                    <th>3</th>
                    <th>Milena George</th>
                </tr>
                                <tr>
                    <th>4</th>
                    <th>Jailee Jo Peltier</th>
                </tr>
                                <tr>
                    <th>4</th>
                    <th>Naeema Stovaw</th>
                </tr>
                                <tr>
                    <th>5</th>
                    <th>Kaelana Saesing</th>
                </tr>
                                <tr>
                    <th>5</th>
                    <th>Codi Mansanas</th>
                </tr>
                                <tr>
                    <th>6</th>
                    <th>Kody Cummins</th>
                </tr>
                                <tr>
                    <th>6</th>
                    <th>Kashlynn Sedeno</th>
                </tr>
                                <tr>
                    <th>7</th>
                    <th>Jalen Kim</th>
                </tr>
                                <tr>
                    <th>7</th>
                    <th>Skylar Castro</th>
                </tr>
                                <tr>
                    <th>8</th>
                    <th>Kylie Nakamura-Soares</th>
                </tr>
                                <tr>
                    <th>8</th>
                    <th>Saige Ballesteros</th>
                </tr>
                                <tr>
                    <th>9</th>
                    <th>Leah Oshiro</th>
                </tr>
                                <tr>
                    <th>9</th>
                    <th>Kayla Uyehara</th>
                </tr>
                                <tr>
                    <th>10</th>
                    <th>Leila Lipoakalauoha Neumann</th>
                </tr>
                                <tr>
                    <th>10</th>
                    <th>June Homestead</th>
                </tr>
                                <tr>
                    <th>11</th>
                    <th>Mylah-Belle Murillo</th>
                </tr>
                            </tbody></table>
        </section>

        </section>
        </main>

<?php get_footer(); ?>
