<?php
// デフォルトの年を設定
$default_year = wp_get_year();
#$default_year = 2024;
$tournament = $_REQUEST['y'] ?? '';
if (!preg_match('/^\d+$/', $tournament) || $tournament > $default_year) {
    $tournament = $default_year;
}


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
        $tournament_img = get_field('tournament_team_img');
    }
    wp_reset_postdata();
}

// チームを取得
$args = array(
    'posts_per_page' => -1,
    'post_type'      => 'team',
    'orderby'        => 'modified',
    'order'          => 'DESC',
    'meta_query'     => array(
        array(
            'key'     => 'tournament_schedule', // 投稿オブジェクトフィールドのキーを指定
            'value'   => $tournament_id,
            'compare' => '='
        )
    )
);
$team_posts = get_posts($args);
$group_list = array();
if ($team_posts) {
    foreach ($team_posts as $post) {
        setup_postdata($post);

        $tmp_group = get_field('team_group');
        //グループ指定があった場合は該当してないものを飛ばす
        $group_list[$tmp_group] = $tmp_group;
        if(@$group_name && $group_name != $tmp_group){
            continue;
        }
    }
}

?>
<!doctype html>
<html <?php language_attributes(); ?>>

<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title><?php wp_title(''); ?><?=$tournament;?></title>
<meta name="HandheldFriendly" content="True">
<meta name="MobileOptimized" content="320">
<meta name="viewport" content="width=device-width, initial-scale=1"/>
<meta property="og:image" content="https://casq-st.com/wp-content/uploads/2024/07/114071-scaled.jpg">

<?php if ( get_theme_mod( 'opencage_appleicon' ) ) : ?><link rel="apple-touch-icon" href="<?php echo get_theme_mod( 'opencage_appleicon' ); ?>"><?php endif; ?>
<?php if ( get_theme_mod( 'opencage_favicon' ) ) : ?><link rel="icon" href="<?php echo get_theme_mod( 'opencage_favicon' ); ?>"><?php endif; ?>

<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">

<!--[if IE]>
<?php if ( get_theme_mod( 'opencage_favicon_ie' ) ) : ?><link rel="shortcut icon" href="<?php echo get_theme_mod( 'opencage_favicon_ie' ); ?>"><?php endif; ?>
<![endif]-->

<?php get_template_part( 'head' ); ?>

<?php wp_head(); ?>

<?php
$ua = $_SERVER['HTTP_USER_AGENT'];

if (strpos($ua, 'iPhone') !== false || strpos($ua, 'Android') !== false) {
    // スマホの場合
    $ua = "mobile";
} else {
    // PCの場合
    $ua = "pc";
}
?>
<?php if ( $ua == "mobile" ): ?>
<style>
body iframe {
    width: 100%;
    height: 280px;
}
</style>
<?php else: ?>
<style>
body iframe {
    width: 100%;
    height: 550px;
}
</style>
<?php endif; ?>
</head>

<body <?php body_class(); ?>>
	<?php wp_body_open(); ?>
<div id="container">


<?php if ( get_option('other_options_headerunderlink') && get_option('other_options_headerundertext') ) : ?>
<div class="header-info"><a<?php if(get_option('other_options_headerunderlink_target')):?> target="_blank"<?php endif;?>  style="background-color: <?php echo get_theme_mod( 'other_options_headerunderlink_bgcolor'); ?>;" href="<?php echo esc_html(get_option('other_options_headerunderlink'));?>"><?php echo esc_html(get_option('other_options_headerundertext'));?></a></div>
<?php endif;?>

<?php get_template_part( 'parts_homeheader' ); ?>
<nav class="" id="humberger-nav">
            <ul class="nav-area">
                <li>
                    <a href="<?=home_url();?>?y=<?=$tournament;?>">
                        大会概要
                    </a>
                </li>
                <li>
                    <p class="nav-item" data-target="1">
                        参加チーム一覧
                    </p>
                    <ul id="nav-item-sub-area1" class="nav-item-sub-area">
                        <li class="nav-item-sub">
                            <a href="<?=home_url();?>/group/?y=<?=$tournament;?>">
                                <i class="fas fa-chevron-right me-2"></i>すべてのチーム
                            </a>
                        </li>
                        <?php
                        //存在するグループ分だけリンク生成
                        ksort($group_list);
                        foreach($group_list as $group_name){
                        if ( $group_name == '所属グループなし' ) continue;
                        ?>
                            <li class="nav-sub-item">
                                <a href="/group/?group=<?=$group_name;?>&y=<?=$tournament;?>">
                                    <i class="fas fa-chevron-right me-2"></i><?=$group_name;?>
                                </a>
                            </li>
                        <?
                        }
                        ?>
                    </ul>
                </li>
                <li>
                    <a href="<?=home_url();?>/venue/?y=<?=$tournament;?>">
                        会場一覧
                    </a>
                </li>
                <li>
                    <p class="nav-item" data-target="2">
                        試合日程・結果
                    </p>
                    <ul id="nav-item-sub-area2" class="nav-item-sub-area">
                        <li class="nav-sub-item">
                            <p class="nav-sub-item-title" data-target="1">グループリーグ</p>
                            <ul id="nav-item-second-area1" class="hidden">
                        <?php
                        //存在するグループ分だけリンク生成
                        ksort($group_list);
                        foreach($group_list as $group_name){
                        ?>
                            <li class="nav-sub-item">
                                <a href="/league/?group=<?=$group_name;?>&y=<?=$tournament;?>">
                                    <i class="fas fa-chevron-right me-2"></i><?=$group_name;?>
                                </a>
                            </li>
                        <?
                        }
                        ?>

                            </ul>
                        </li>
<?php if ( $default_year <= 2024 ): ?>
                        <li class="nav-sub-item">
                            <p class="nav-sub-item-title" data-target="2">プレミアリーグ(上位)</p>
                            <ul id="nav-item-second-area2" class="hidden">
                                <li class="nav-sub-item">
                                    <a href="<?=home_url();?>/league/?group=プレミアリーグ(上位)&y=<?=$tournament;?>">
                                        <i class="fas fa-chevron-right me-2"></i>グループLeague
                                    </a>
                                </li>
                                <li class="nav-sub-item">
                                    <a href="<?=home_url();?>/league/?group=プレミアリーグ(上位)-トーナメント&y=<?=$tournament;?>">
                                        <i class="fas fa-chevron-right me-2"></i>Tournament
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-sub-item">
                            <p class="nav-sub-item-title" data-target="3">ゴールドリーグ(中位)</p>
                            <ul id="nav-item-second-area3" class="hidden">
                                <li class="nav-sub-item">
                                    <a href="<?=home_url();?>/league/?group=ゴールドリーグ(中位)&y=<?=$tournament;?>">
                                        <i class="fas fa-chevron-right me-2"></i>グループLeague
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-sub-item">
                            <p class="nav-sub-item-title" data-target="4">シルバーリーグ(下位)</p>
                            <ul id="nav-item-second-area4" class="hidden">
                                <li class="nav-sub-item">
                                    <a href="<?=home_url();?>/league/?group=シルバーリーグ(下位)&y=<?=$tournament;?>">
                                        <i class="fas fa-chevron-right me-2"></i>グループLeague
                                    </a>
                                </li>
                            </ul>
                        </li>

                    </ul>
                </li>
<?php elseif ( $default_year == 2025 ): ?>
                        <li class="nav-sub-item">
                            <p class="nav-sub-item-title" data-target="2">プレミアトーナメント</p>
                            <ul id="nav-item-second-area2" class="hidden">
                                <li class="nav-sub-item">
                                    <a href="<?=home_url();?>/league/?group=プレミアトーナメント&y=<?=$tournament;?>">
                                        <i class="fas fa-chevron-right me-2"></i>プレミアトーナメント
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-sub-item">
                            <p class="nav-sub-item-title" data-target="3">ゴールドトーナメント</p>
                            <ul id="nav-item-second-area3" class="hidden">
                                <li class="nav-sub-item">
                                    <a href="<?=home_url();?>/league/?group=ゴールドトーナメント&y=<?=$tournament;?>">
                                        <i class="fas fa-chevron-right me-2"></i>ゴールドトーナメント
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-sub-item">
                            <p class="nav-sub-item-title" data-target="4">シルバートーナメント</p>
                            <ul id="nav-item-second-area4" class="hidden">
                                <li class="nav-sub-item">
                                    <a href="<?=home_url();?>/league/?group=シルバートーナメント&y=<?=$tournament;?>">
                                        <i class="fas fa-chevron-right me-2"></i>シルバートーナメント
                                    </a>
                                </li>
                            </ul>
                        </li>

                    </ul>
                </li>
<?php endif; ?>
                <li>
                    <a href="<?=home_url();?>/sponsor<?=$tournament;?>/?y=<?=$tournament;?>">
                        協賛企業ご紹介
                    </a>
                </li>
<!--
                <li class="mb-5">
                    <a href="<?=home_url();?>/coupon/">
                        お得なクーポン
                    </a>
                </li>
-->
            </ul>
        </nav>
        <header class="row g-0">
            <div class="col-10 header-left">
                <div class="px-1 py-2 d-flex">
                    <img class="site-logo mt-3 ms-1" src="<?=get_stylesheet_directory_uri(); ?>/img/saitama_logo.gif">
                    <div class="mx-2">
                        <a href=/<?= (@$_REQUEST['y']!=2025&&@$_REQUEST['y']) ? '?y='.$_REQUEST['y'] : ''; ?>><img src="<?=get_stylesheet_directory_uri(); ?>/img/shimamura_header_logo.jpg?1" border=0></a>
                        <p class="text-m text-md site-title font-bold">さいたまシティジュニアカップ<span class="site-sub-title"><?=$tournament;?></span></p>
                    </div>
                </div>
            </div>
            <div class="col-2 header-right toggle_btn">
                <span></span>
                <span></span>
                <span></span>
            </div>
        </header>

