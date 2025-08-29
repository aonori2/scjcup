<?php
//開催情報を取得
$tournament_id = 136; //今回はSCJCUP2023を前提とする

//とりあえずチーム全部持ってくる
if (have_posts()) : while (have_posts()) : the_post();
$args = array(
	'posts_per_page' => -1,
	'post_type' => 'venue',
	'orderby' => 'modified',
	'order' => 'DESC',
);
$posts = get_posts( $args );
$group_list = array();
foreach ( $posts as $post ):
	setup_postdata( $post );

    //カスタムフィールド取得
	$post_meta = get_post_meta($post->ID);
    $venue_data[$post->ID]['venue_name'] = get_the_title();
    $venue_data[$post->ID]['address'] = get_field('address');
    $venue_data[$post->ID]['access'] = get_field('access');
    $venue_data[$post->ID]['map'] = get_field('map');

    // echo '<pre>';
    // var_dump($venue_data);
    // echo '</pre>';

endforeach; // ループの終了
wp_reset_postdata(); // 直前のクエリを復元する

endwhile;
endif;

?>
<?php get_header(); ?>

<div class="mian-image-area">
    <img class="main-img" src="<?=get_stylesheet_directory_uri(); ?>/img/S__2285806_0.jpg">
</div>
<main class="container py-5">
<section>
    <h3 class="text-center font-bold title">お得なクーポン</h3>
    <div class="mt-5 pb-5 border-bottom border-2">
        <div class="d-flex justify-content-between align-items-center">
            <p class="overview-box-2-title font-bold my-2">NAIL&BODY ART<span class="text-l mx-2">Remore</span></p>
        </div>
        <div class="text-center mt-4 font-bold">
            <img src="<?=get_stylesheet_directory_uri(); ?>/img/S__9273413.jpg">
        </div>
    </div>
    <div class="mt-5 pb-5 border-bottom border-2">
        <div class="d-flex justify-content-between align-items-center">
            <p class="overview-box-2-title font-bold my-2"><span class="text-l mx-2">コバトン*カフェ</span></p>
        </div>
        <div class="text-center mt-4 font-bold">
            <img src="<?=get_stylesheet_directory_uri(); ?>/img/20230032.jpg">
        </div>
    </div>

<!--
    <div class="mt-5 pb-5 border-bottom border-2">
        <div class="d-flex justify-content-between align-items-center">
            <p class="overview-box-2-title font-bold my-2">昔ながらの中華そば<span class="text-l mx-2">甲州屋</span></p>
        </div>
        <div class="text-center mt-4 font-bold">
            <a href="https://koushuya.net">https://koushuya.net</a>
        </div>
    </div>
    <div class="mt-5 pb-5 border-bottom border-2">
        <div class="d-flex justify-content-between align-items-center">
            <p class="overview-box-2-title font-bold my-2">サッカードットコム株式会社</p>
        </div>
        <div class="text-center mt-4 font-bold">
            <a href="https://www.jogarbola.net/">https://www.jogarbola.net/</a>
        </div>
    </div>
    <div class="mt-5 pb-5">
        <div class="d-flex justify-content-between align-items-center">
            <p class="overview-box-2-title font-bold my-2">株式会社アルコグランデ</p>
        </div>
        <div class="text-center mt-4 font-bold">
            <a href="http://www.arco-g.com/">http://www.arco-g.com/</a>
        </div>
    </div>
-->
</section>
</main>

<?php get_footer(); ?>