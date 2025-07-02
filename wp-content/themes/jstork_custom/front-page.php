<?php
// デフォルトの年を設定
$default_year = wp_get_year();
#$default_year = 2024;
$tournament = $_REQUEST['y'] ?? '';
if (!preg_match('/^\d+$/', $tournament) || $tournament > $default_year) {
    $tournament = $default_year;
}

//大会概要
if (have_posts()) : while (have_posts()) : the_post();
$args = array(
	'posts_per_page' => -1,
	'post_type' => 'tournament',
	'orderby' => 'modified',
	'order' => 'DESC',
    'name' => $tournament,
);
$posts = get_posts( $args );
$group_list = array();
foreach ( $posts as $post ):
	setup_postdata( $post );

    //カスタムフィールド取得
	$post_meta = get_post_meta($post->ID);
    $tournament_data['tournament_name'] = get_the_title();
    $tournament_data['tournament_main_img'] = get_field('tournament_main_img');
    $tournament_data['tournament_date'] = get_field('tournament_date');
    $tournament_data['tournament_location'] = get_field('tournament_location');
    $tournament_data['tournament_purpose'] = get_field('tournament_purpose');
    $tournament_data['tournament_organization'] = get_field('tournament_organization');
    $tournament_data['tournament_supervisor'] = get_field('tournament_supervisor');
    $tournament_data['tournament_sponsor'] = get_field('tournament_sponsor');
    $tournament_data['tournament_cooperation'] = get_field('tournament_cooperation');
    $tournament_data['tournament_administrator'] = get_field('tournament_administrator');
    $tournament_data['tournament_cosponsor'] = get_field('tournament_cosponsor');
    $tournament_data['tournament_mayor_img'] = get_field('tournament_mayor_img');
    $tournament_data['tournament_mayor_name'] = get_field('tournament_mayor_name');
    $tournament_data['tournament_mayor_greet'] = get_field('tournament_mayor_greet');
    $tournament_data['tournament_chairman'] = get_field('tournament_chairman');
    $tournament_data['tournament_chairman_name'] = get_field('tournament_chairman_name');
    $tournament_data['tournament_chairman_greet'] = get_field('tournament_chairman_greet');
    $tournament_data['tournament_qualification'] = get_field('tournament_qualification');
    $tournament_data['tournament_regulation'] = get_field('tournament_regulation');
    $tournament_data['tournament_regulation2'] = get_field('tournament_regulation2');
    $tournament_data['tournament_ceremony'] = get_field('tournament_ceremony');
    $tournament_data['tournament_fee'] = get_field('tournament_fee');
    $tournament_data['tournament_seed'] = get_field('tournament_seed');

    // echo '<pre>';
    // var_dump($tournament_data['tournament_chairman_name']);
    // echo '</pre>';

endforeach; // ループの終了
wp_reset_postdata(); // 直前のクエリを復元する

endwhile;
endif;

?>
<?php get_header(); ?>
<div class="mian-image-area">
<img class="" src="<?=$tournament_data['tournament_main_img']['url'];?>" style="">
</div>

<main class="container py-5">
    <section>
        <h5 class="text-center font-bold title">市長挨拶</h5>
        <div class="my-5">
            <div class="text-center">
                <img class="" src="<?=$tournament_data['tournament_mayor_img']['url'];?>" style="max-width:350px;">
            </div>
            <div class="my-5 text-md">
                <p class="font-bold text-end mb-3 me-2"><?=$tournament_data['tournament_mayor_name'];?></p>
                <?=nl2br($tournament_data['tournament_mayor_greet']);?>
            </div>
        </div>
    </section>
    <section>
        <h5 class="text-center font-bold title">理事長挨拶</h5>
        <div class="my-5">
            <div class="text-center">
                <img class="" src="<?=$tournament_data['tournament_chairman']['url'];?>" style="max-width:350px;">
            </div>
            <div class="my-5 text-md">
                <p class="font-bold text-end mb-3 me-2"><?=$tournament_data['tournament_chairman_name'];?></p>
                <?=nl2br($tournament_data['tournament_chairman_greet']);?>
            </div>
        </div>
    </section>
    <section>
        <h5 class="text-center font-bold title">大会規定</h5>
            <div class="my-5">
                <p class="font-bold text-md">全ての試合はFIFAが定めるFIFA Laws of Game に基づきます。</p>
                <p class="text-sm my-3">※ただし、以下に定める「<?=$tournament_data['tournament_name'];?> 」のローカルルールに基づく</p>
            </div>
            <div class="my-5">
                <div class="overview-box-2">
                    <p class="overview-box-2-title">大会名</p>
                    <p class="px-2 py-1 text-md"><?=$tournament_data['tournament_name'];?></p> 
                </div>
            </div>
            <div class="my-5">
                <div class="overview-box-2">
                    <p class="overview-box-2-title">期間</p>
                    <p class="px-2 py-1 text-md"><?=$tournament_data['tournament_date'];?></p> 
                </div>
            </div>
            <div class="my-5">
                <div class="overview-box-2">
                    <p class="overview-box-2-title">会場</p>
                    <p class="px-2 py-1 text-md"><?=nl2br($tournament_data['tournament_location']);?></p> 
                </div>
            </div>
            <div class="my-5">
                <div class="overview-box-2">
                    <p class="overview-box-2-title">目的</p>
                    <p class="px-2 py-1 text-md"><?=nl2br($tournament_data['tournament_purpose']);?></p> 
                </div>
            </div>
            <div class="my-5">
                <div class="overview-box-2">
                    <p class="overview-box-2-title">主催</p>
                    <p class="px-2 py-1 text-md flex-shark-1"><?=$tournament_data['tournament_organization'];?></p> 
                </div>
            </div>
            <div class="my-5">
                <div class="overview-box-2">
                    <p class="overview-box-2-title">主管</p>
                    <p class="px-2 py-1 text-md"><?=nl2br($tournament_data['tournament_supervisor']);?></p> 
                </div>
            </div>
            <div class="my-5">
                <div class="overview-box-2">
                    <p class="overview-box-2-title">後援</p>
                    <p class="px-2 py-1 text-md"><?=nl2br($tournament_data['tournament_sponsor']);?></p> 
                </div>
            </div>
            <div class="my-5">
                <div class="overview-box-2">
                    <p class="overview-box-2-title">協力</p></p>
                    <p class="px-2 py-1 text-md"><?=$tournament_data['tournament_cooperation'];?></p> 
                </div>
            </div>
            <div class="my-5">
                <div class="overview-box-2">
                    <p class="overview-box-2-title">運営</p>
                    <p class="px-2 py-1 text-md"><?=$tournament_data['tournament_administrator'];?></p> 
                </div>
            </div>
            <div class="my-5">
                <div class="overview-box-2">
                    <p class="overview-box-2-title">協賛</p>
                    <p class="px-2 py-1 text-md"><?=nl2br($tournament_data['tournament_cosponsor']);?></p>
                </div>
            </div>
            <div class="my-5">
                <div class="overview-box-2">
                    <p class="overview-box-2-title">参加資格</p>
                    <p class="px-2 py-1 text-md"><?=$tournament_data['tournament_qualification'];?></p> 
                </div>
            </div>
<!--
            <div class="my-5">
                <div class="overview-box-2">
                    <p class="overview-box-2-title">新型コロナウィルス感染症対策</p>
                    <p class="px-2 py-1 text-md">
                        (公財)埼玉県サッカー協会第４種委員会が定めた「サッカー活動の再開に向けたガイドライン」に基づき対応
                    </p> 
                </div>
            </div>
-->
            <div class="mt-5">
                <div class="overview-text-area-box">
                    <p class="overview-box-2-title">大会規定</p>
                </div>
            </div>
            <div class="">
                <div class="overview-text-area">
                    <div class="my-2 text-md px-2 py-1"><?=nl2br($tournament_data['tournament_regulation']);?></div>
                </div>
            </div>
            <div class="mt-5">
                <div class="overview-text-area-box">
                    <p class="overview-box-2-title">試合規定</p>
                </div>
            </div>
            <div class="">
                <div class="overview-text-area">
                    <div class="my-2 text-md px-2 py-1"><?=nl2br($tournament_data['tournament_regulation2']);?></div>
                </div>
            </div>
            <div class="my-5">
                <div class="overview-box-2">
                    <p class="overview-box-2-title">閉会式兼表彰式</p>
                    <p class="px-2 py-1 text-md"><?=nl2br($tournament_data['tournament_ceremony']);?></p> 
                </div>
            </div>
            <div class="my-5">
                <div class="overview-box-2">
                    <p class="overview-box-2-title">参加費</p>
                    <p class="px-2 py-2 text-md"><?=nl2br($tournament_data['tournament_fee']);?></p> 
                </div>
            </div>
            <div class="my-5">
                <div class="overview-box-2">
                    <p class="overview-box-2-title">シード権</p>
                    <p class="px-2 py-2 text-md"><?=nl2br($tournament_data['tournament_seed']);?></p> 
                </div>
            </div>
    </section>
</main>
<?php get_footer(); ?>
