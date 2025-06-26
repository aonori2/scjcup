<?php

// 子テーマのstyle.cssを後から読み込む
add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles' );
function theme_enqueue_styles() {
    wp_enqueue_style( 'style', get_template_directory_uri() . '/style.css' );
    wp_enqueue_style( 'child-style',
        get_stylesheet_directory_uri() . '/style.css',
        array('style')
    );
}

/************************/
/* フロント側の処理     */
/************************/

//cssとjs読み込み
function my_enqueue_scripts() {
    wp_enqueue_style('theme-style', 'https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css');
    wp_enqueue_script('theme-script', get_stylesheet_directory_uri() . '/js/index.js');
}
add_action('wp_enqueue_scripts', 'my_enqueue_scripts');

//fontawesome読み込み
add_action('wp_enqueue_scripts', 'fontawesome_enqueue');
function fontawesome_enqueue()
{
    wp_enqueue_script('fontawesome_script', 'https://kit.fontawesome.com/abe3ac2a4c.js');
}

//crossoriginを付加する
add_filter('script_loader_tag', 'custom_script_loader_tag', 10, 2);
function custom_script_loader_tag($tag, $handle)
{
    if ($handle !== 'fontawesome_script') {
        return $tag;
    }
    $script_replace = str_replace('></script>', ' crossorigin="anonymous"></script>', $tag);
    return $script_replace;
}


/************************/
/* 管理画面関連の処理     */
/************************/
//カスタム投稿のタイトルのプレースホルダ指定
function change_default_title( $title ) {
    $screen = get_current_screen();
    if ( $screen->post_type == 'post' ) {
          $title = 'タイトルを入力';
    }elseif ( $screen->post_type == 'tournament' ) {
          $title = '大会名を入力してください';
    }elseif ( $screen->post_type == 'team' ) {
           $title = 'チーム名を入力してください';
    }elseif ( $screen->post_type == 'match' ) {
           $title = '試合名を入力してください';
    }elseif ( $screen->post_type == 'venue' ) {
           $title = '会場名を入力してください';
    }elseif ( $screen->post_type == 'court' ) {
           $title = 'コート名を入力してください';
    }elseif ( $screen->post_type == 'player' ) {
           $title = '選手名を入力してください';
    }
    return $title;
}
add_filter( 'enter_title_here', 'change_default_title' );

//ログイン後のURLをtournament管理に変更
function custom_login_redirect() {
    return 'wp-admin/edit.php?post_type=tournament';
}
add_filter('login_redirect', 'custom_login_redirect');

//管理画面の投稿一覧をログイン中のユーザーの投稿のみに制限する(管理者以外)
function pre_get_author_posts( $query ) {
    if ( is_admin() && !current_user_can('administrator') && $query->is_main_query()
            && ( !isset($_GET['author']) || $_GET['author'] == get_current_user_id())) {
        $query->set( 'author', get_current_user_id() );
        unset($_GET['author']);
    }
}
add_action( 'pre_get_posts', 'pre_get_author_posts' );

//管理画面の投稿一覧の投稿数の表示も制限(管理者以外)
function count_author_posts( $counts, $type = 'post', $perm = '' ) {
  if ( !is_admin() || current_user_can('administrator') ) {
    return $counts;
  }
  global $wpdb;
  if ( ! post_type_exists( $type ) )
    return new stdClass;
  $cache_key = _count_posts_cache_key( $type, $perm ) . '_author'; // 2
  $counts = wp_cache_get( $cache_key, 'counts' );
  if ( false !== $counts ) {
    return $counts;
  }
  $query = "SELECT post_status, COUNT( * ) AS num_posts FROM {$wpdb->posts} WHERE post_type = %s";
  $query .= $wpdb->prepare( " AND ( post_author = %d )", get_current_user_id() );
  $query .= ' GROUP BY post_status';
 
  $results = (array) $wpdb->get_results( $wpdb->prepare( $query, $type ), ARRAY_A );
  $counts = array_fill_keys( get_post_stati(), 0 );
  foreach ( $results as $row ) {
    $counts[ $row['post_status'] ] = $row['num_posts'];
  }
  $counts = (object) $counts;
  wp_cache_set( $cache_key, $counts, 'counts' );
  return $counts;
}
add_filter( 'wp_count_posts', 'count_author_posts', 10, 3 );

//メディアも自分が投稿したものだけ表示する
function display_only_self_uploaded_medias( $query ) {
if (! current_user_can('administrator') ) {
    if ( $user = wp_get_current_user() ) {
    $query['author'] = $user->ID;
    }
    return $query;
    }
}
add_action( 'ajax_query_attachments_args', 'display_only_self_uploaded_medias' );

//管理画面の上部バーを非表示
function remove_admin_bar_menus( $wp_admin_bar ) {
    $wp_admin_bar->remove_menu( 'wp-logo' ); //ロゴ
    $wp_admin_bar->remove_menu( 'about' ); //ロゴ / WordPressについて
    $wp_admin_bar->remove_menu( 'wporg' ); //ロゴ / WordPress.org
    $wp_admin_bar->remove_menu( 'documentation' ); //ロゴ / ドキュメンテーション
    $wp_admin_bar->remove_menu( 'support-forums' ); //ロゴ / サポート
    $wp_admin_bar->remove_menu( 'feedback' ); //ロゴ / フィードバック
    $wp_admin_bar->remove_menu( 'site-name' ); //サイト名
    $wp_admin_bar->remove_menu( 'view-site' ); //サイト名 / サイトを表示
    $wp_admin_bar->remove_menu( 'updates' ); //更新
    $wp_admin_bar->remove_menu( 'comments' ); //コメント
    $wp_admin_bar->remove_menu( 'new-content' ); //新規
    $wp_admin_bar->remove_menu( 'new-post' ); //新規 / 投稿
    $wp_admin_bar->remove_menu( 'new-media' ); //新規 / メディア
    $wp_admin_bar->remove_menu( 'new-page' ); //新規 / 固定
    $wp_admin_bar->remove_menu( 'new-user' ); //新規 / ユーザー
    $wp_admin_bar->remove_menu( 'view' ); //投稿を表示
    $wp_admin_bar->remove_menu( 'customize' ); //カスタマイズ
    $wp_admin_bar->remove_menu( 'edit' );//〜を編集
//    $wp_admin_bar->remove_menu( 'my-account' ); //こんにちは、[ユーザー名]さん $wp_admin_bar->remove_menu( 'user-info' ); // ユーザー / [ユーザー名]
    $wp_admin_bar->remove_menu( 'edit-profile' ); //ユーザー / プロフィールを編
//    $wp_admin_bar->remove_menu( 'logout' ); //ユーザー / ログアウト
    $wp_admin_bar->remove_menu( 'menu-toggle' ); //メニュー
    $wp_admin_bar->remove_menu( 'search' ); //検索
}
add_action( 'admin_bar_menu', 'remove_admin_bar_menus', 999 );

//管理画面メニューバーのアイコン画像非表示
function my_admin_style() {
    echo '<style>
    #wp-admin-bar-my-account img{
      display: none !important;
    }
    #wpadminbar #wp-admin-bar-my-account.with-avatar #wp-admin-bar-user-actions>li {
        margin-left: 44px !important;
    }
    </style>'.PHP_EOL;
  }
add_action('admin_print_styles', 'my_admin_style');

//管理画面フッター部の表示を消す
function custom_admin_footer() {    
}
add_filter('admin_footer_text', 'custom_admin_footer');
function remove_admin_footer_version() {
    remove_filter('update_footer', 'core_update_footer');
}
add_action( 'admin_menu', 'remove_admin_footer_version');

//投稿パーマリンク用のURLスラッグの自動生成
function auto_post_slug( $slug, $post_ID, $post_status, $post_type ) {
    if ( preg_match( '/(%[0-9a-f]{2})+/', $slug ) ) {
        $slug = utf8_uri_encode( $post_type ) . '-' . $post_ID;
    }
    return $slug;
}
add_filter( 'wp_unique_post_slug', 'auto_post_slug', 10, 4 );

//ACFの投稿オブジェクトで表示される投稿を所有者のみに制限する（管理者以外）
function my_post_object_query( $args, $field, $post_id ) {
    if ( !current_user_can('administrator') ) {
        $user = wp_get_current_user();
        $args['author'] = $user->ID;
    }
    return $args;
}
add_filter('acf/fields/post_object/query', 'my_post_object_query', 10, 3);


//管理画面のフィールドを追加（名前が被ったときに区別するため）
function my_acf_fields_post_object_result( $text, $post, $field, $post_id ) {
    $field_array = array(
        'field_64a6985d7b951',  //所属チーム名
        'field_649aa0a434a2e',  //マッチング→チームA
        'field_649a86df5ee5f',  //マッチング→チームB
    );
    if(in_array($field['key'], $field_array)){
        $additional_info = get_field('tournament_schedule', $post->ID);
        $text .= ' ('.$additional_info->post_title.')';
    }
    return $text;
}
add_filter('acf/fields/post_object/result', 'my_acf_fields_post_object_result', 10, 4);

/*
add_filter('template_include', function($template) {
    echo '<div style="position:fixed;bottom:0;left:0;background:#000;color:#0f0;padding:5px;font-size:12px;z-index:9999;">Template: ' . $template . '</div>';
    return $template;
}); 
*/

/**
 * /group/ をリクエストされたら強制的に page-group.php を返す
 * （子テーマの functions.php に追記推奨）
 */
function my_force_group_template( $template ) {

	// ① WordPress が通常の is_page() 判定で "group" を認識できている場合
	if ( is_page( 'group' ) ) {
		$new_template = locate_template( 'page-group.php' );
		return $new_template ?: $template;
	}

	// ② 固定ページが存在しない／is_page() が false になる場合用のバックアップ判定
	$request = trim( $GLOBALS['wp']->request, '/' ); // 例）"group"
	if ( $request === 'group' ) {
		$new_template = locate_template( 'page-group.php' );
		return $new_template ?: $template;
	}

	// その他の URL はデフォルトのテンプレートへ
	return $template;
}
#add_filter( 'template_include', 'my_force_group_template', 99 );

function wp_get_year( $args = '' ) {
	global $wpdb, $wp_locale;
    $row = $wpdb->get_row( "SELECT post_name FROM $wpdb->posts WHERE post_type = 'tournament' AND post_status = 'publish' ORDER BY id DESC LIMIT 1" );
    return $row->post_name;
}
