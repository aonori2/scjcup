<?php
// デフォルトの年を設定
$default_year = wp_get_year();
#$default_year = 2023;
$tournament = $_REQUEST['y'] ?? '';
if (!preg_match('/^\d+$/', $tournament) || $tournament > $default_year) {
    $tournament = $default_year;
}

// 大会概要を取得
$args = array(
    'posts_per_page' => -1,
    'post_type'      => 'tournament',
    'orderby'        => 'modified',
    'order'          => 'DESC',
    'name'           => $tournament,
);
$tournament_posts = get_posts($args);
$tournament_id = "";

if ($tournament_posts) {
    foreach ($tournament_posts as $post) {
        $tournament_id = $post->ID;
        $tournament_img = get_field('tournament_venue_img');
    }
    wp_reset_postdata();
}

//とりあえずチーム全部持ってくる
if (have_posts()) : while (have_posts()) : the_post();
$args = array(
	'posts_per_page' => -1,
	'post_type' => 'venue',
	'orderby' => 'modified',
	'order' => 'DESC',
    'meta_query'     => array(
        array(
            'key'     => 'tournament_schedule', // 投稿オブジェクトフィールドのキーを指定
            'value'   => $tournament_id,
            'compare' => '='
        )
    )
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
    <img class="main-img" src="<?=$tournament_img['url'];?>">
</div>
<main class="container py-5">
    <section>
        <h5 class="text-center font-bold title">会場一覧</h5>
    </section>

    <?php
    //情報をループして表示
    foreach($venue_data as $venue_id => $venue){
    ?>
        <section class="mt-5">
            <div class="mx-2">
                <h5 class="font-bold px-2 py-2 team-block-title"><?=$venue['venue_name'];?></h5>
            </div>
            <p class="text-md font-bold ms-2 team-sub-title mt-4 mb-2">所在地</p>
            <p class="text-md ms-2"><?=$venue['address'];?></p>
            <p class="text-md font-bold ms-2 team-sub-title mt-4 mb-2">アクセス</p>
            <div class="p-2">
                <p class="text-sm mt-2"><?=nl2br($venue['access']);?></p>
            </div>
            <div class="mt-5">
                <?=$venue['map'];?>
            </div>
        </section>
    <?php
    }
    ?>
</main>

<?php get_footer(); ?>
