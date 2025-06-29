<?php
// デフォルトの年を設定
$default_year = wp_get_year();
#$default_year = 2024;
$tournament = $_REQUEST['y'] ?? '';
if (!preg_match('/^\d+$/', $tournament) || $tournament > $default_year) {
    $tournament = $default_year;
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
                        <li class="nav-item-sub">
                            <a href="<?=home_url();?>/group/?group=グループA&y=<?=$tournament;?>">
                                <i class="fas fa-chevron-right me-2"></i>グループA
                            </a>
                        </li>
                        <li class="nav-item-sub">
                          <a href="<?=home_url();?>/group/?group=グループB&y=<?=$tournament;?>">
                                <i class="fas fa-chevron-right me-2"></i>グループB
                            </a>
                        </li>
                        <li class="nav-item-sub">
                          <a href="<?=home_url();?>/group/?group=グループC&y=<?=$tournament;?>">
                                <i class="fas fa-chevron-right me-2"></i>グループC
                            </a>
                        </li>
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
                                <li class="nav-sub-item">
                                    <a href="<?=home_url();?>/league/?group=グループA&y=<?=$tournament;?>">
                                        <i class="fas fa-chevron-right me-2"></i>グループA
                                    </a>
                                </li>
                                <li class="nav-sub-item">
                                    <a href="<?=home_url();?>/league/?group=グループB&y=<?=$tournament;?>">
                                        <i class="fas fa-chevron-right me-2"></i>グループB
                                    </a>
                                </li>
                                <li class="nav-sub-item">
                                    <a href="<?=home_url();?>/league/?group=グループC&y=<?=$tournament;?>">
                                        <i class="fas fa-chevron-right me-2"></i>グループC
                                    </a>
                                </li>
                            </ul>
                        </li>

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
<!--
                                    <li class="nav-sub-item">
                                    <a href="<?=home_url();?>/league/?group=ゴールドリーグ(中位)-順位決定戦">
                                        <i class="fas fa-chevron-right me-2"></i>順位決定戦
                                    </a>
                                </li>
-->
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
<!--                                
                                <li class="nav-sub-item">
                                    <a href="<?=home_url();?>/league/?group=シルバーリーグ(下位)-順位決定戦">
                                        <i class="fas fa-chevron-right me-2"></i>順位決定戦
                                    </a>
                               </li>
-->
                            </ul>
                        </li>

                    </ul>
                </li>
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
                        <a href=/<?= ($_REQUEST['y']!=2025&&$_REQUEST['y']) ? '?y='.$_REQUEST['y'] : ''; ?>><img src="<?=get_stylesheet_directory_uri(); ?>/img/shimamura_header_logo.jpg?1" border=0></a>
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

