<?php
// デフォルトの年を設定
$default_year = wp_get_year();
#$default_year = 2024;
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
        $tournament_img = get_field('tournament_team_img');
    }
    wp_reset_postdata();
}

// グループの指定
$group_name = $_GET['group'] ?? '';

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
        if($group_name && $group_name != $tmp_group){
            continue;
        }

        //カスタムフィールド取得
        $post_meta = get_post_meta($post->ID);
        $team_data[$tmp_group][$post->ID]['team_name'] = get_the_title();
        $team_data[$tmp_group][$post->ID]['address1'] = get_field('address1');
        $team_data[$tmp_group][$post->ID]['address2'] = get_field('address2');
        $team_data[$tmp_group][$post->ID]['coach_name'] = get_field('coach_name');
        $team_data[$tmp_group][$post->ID]['team_group'] = get_field('team_group');
        $team_data[$tmp_group][$post->ID]['team_logo'] = get_field('team_logo');
        $team_data[$tmp_group][$post->ID]['team_img'] = get_field('team_img');
        $team_data[$tmp_group][$post->ID]['list_num'] = get_field('list_num');

        // echo '<pre>';
        // var_dump($team_data[$tmp_group][$post->ID]['list_num']);
        // echo '</pre>';

    }
}
wp_reset_postdata(); // 直前のクエリを復元する

//各チームの選手情報をもってくる
$args = array(
	'posts_per_page' => -1,
	'post_type' => 'player',
	'order' => 'ASC',
);
$posts = get_posts( $args );
$team_no = '';
foreach ( $posts as $post ):
	setup_postdata( $post );

    $tmp_team = get_field('team');

    //カスタムフィールド取得
	$post_meta = get_post_meta($post->ID);
    $uniform_number = get_field('uniform_number');
    $player_data[$tmp_team->ID][$uniform_number]['player_name'] = get_the_title();
    $player_data[$tmp_team->ID][$uniform_number]['uniform_number'] = $uniform_number;

    // echo '<pre>';
    // var_dump($player_data);
    // echo '</pre>';


endforeach; // ループの終了
wp_reset_postdata(); // 直前のクエリを復元する



?>
<?php get_header(); ?>

<div class="mian-image-area">
    <img class="main-img" src="<?=$tournament_img['url'];?>">
</div>
<main class="container py-5">
    <section>
        <h5 class="text-center font-bold title">参加チーム</h5>
    </section>
    <ul style="display: flex; justify-content: center;">
        <li style="padding:1em; margin-top:1em;"><a href="?group=">すべてのチーム</a></li>
    <?php
    //存在するグループ分だけリンク生成
    ksort($group_list);
    foreach($group_list as $group_name){
    ?>
        <li style="padding:1em; margin-top:1em;"><a href="?group=<?=$group_name;?>&y=<?=$tournament;?>"><?=$group_name;?></a></li>
    <?
    }
    ?>
    </ul>

    <?php
    //チーム情報をループして表示
    ksort($team_data);
    foreach($team_data as $group_name => $teams){
    ?>
        <div class="my-5 mx-2" target="#groupA">
            <h5 id="<?=$group_name;?>" class="font-bold px-2 py-2 team-block-title"><?=$group_name;?></h5>
        </div>
    <?
        foreach($teams as $team_id => $team){
    ?>
        <section class="mt-5 pb-5 team-section">
            <div class="row">
                <div class="col-3">
                    <img class="team-logo" src="<?=$team['team_logo'];?>">
                </div>
                <div class="col-9 font-bold">
                    <p><?=$team['team_name'];?></p>
                    <p>(<?=$team['address1'];?><?=$team['address2'];?>)</p>
                    <p class="text-md mt-2 font-bold"><?=$group_name;?></p>
                    <p class="text-md mt-2 font-bold">監督：<?=$team['coach_name'];?></p>
                </div>
                <div class="my-3">
                    <img class="team-img" src="<?=$team['team_img'];?>">
                </div>
            </div>
            <p class="text-md font-bold ms-2 team-sub-title"><?=$team['team_name'];?> - 選手紹介</p>
            <table class="player table table-striped" style="width: 100%; font-size: 1.2em; text-align: center;">
                <tr>
                    <th>背番号</th>
                    <th>選手名</th>
                </tr>
                <?php
                //背番号順に並べ替え
                ksort($player_data[$team_id]);
                foreach($player_data[$team_id] as $player){
                ?>
                <tr>
                    <th><?=$player['uniform_number'];?></th>
                    <th><?=$player['player_name'];?></th>
                </tr>
                <?
                }
                ?>
            </table>
        </section>
    <?php
        }
    }
    ?>
</main>

<?php get_footer(); ?>
