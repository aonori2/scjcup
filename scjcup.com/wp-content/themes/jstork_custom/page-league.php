<?php
// デフォルトの年を設定
$default_year = wp_get_year();
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
        $tournament_img = get_field('tournament_result_img');
    }
    wp_reset_postdata();
}

//グループの指定
$group_name = $_GET['group'];

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
        setup_postdata( $post );



        $tmp_group = get_field('team_group');
        $group_list[$tmp_group] = $tmp_group;

        //グループ指定があった場合は該当してないものを飛ばす
        if($group_name == "グループA" || $group_name == "グループB" || $group_name == "グループC"||$group_name == "グループD" || $group_name == "グループE" || $group_name == "グループF")
        if($group_name && $group_name != $tmp_group){
            continue;
        }

        //カスタムフィールド取得
        $post_meta = get_post_meta($post->ID);
        $team_data[$post->ID]['team_name'] = get_the_title();


        $team_data[$post->ID]['team_group'] = get_field('team_group');
        $team_data[$post->ID]['team_logo'] = get_field('team_logo');

        // echo '<pre>';
        // var_dump($team_data);
        // echo '</pre>';

    }
    wp_reset_postdata(); // 直前のクエリを復元する

    //マッチング情報をすべて持ってくる
    $args = array(
        'posts_per_page' => -1,
        'post_type'      => 'match',
        'order'          => 'ASC',
        'meta_query'     => array(
            array(
                'key'     => 'tournament_schedule', // 投稿オブジェクトフィールドのキーを指定
                'value'   => $tournament_id,
                'compare' => '='
            )
        )
    );
    $match_posts = get_posts($args);
    $match_data = array();
    $result_data = array();
    foreach ( $match_posts as $post ):
        setup_postdata( $post );


        if ( $tournament == 2025 ){
        $tmp_group = $group_name;
        } else {
        $tmp_group = get_field('team_group');
        }
        if($group_name && $group_name != $tmp_group){
            continue;
        }

        if ( $tournament == 2025 ){
        if ( !strstr($post->post_title,$group_name) ){
            continue;
        }
        }
/*
        //該当してないマッチは除外
        if ( strstr($group_name,'プレミア') ){
            if($group_name && $group_name != $tmp_group){
                continue;
            }
        } else {
            if ( strstr($group_name,'-') ){
                $group_name1 = array_shift(explode("-",$group_name));
                if($group_name1 && $group_name1 != $tmp_group){
                    continue;
                }
            } else {
                #continue;
            }
        }
*/

        //カスタムフィールド取得
        $post_meta = get_post_meta($post->ID);
        $match_data[$post->ID]['match_name'] = get_the_title();

        $match_data[$post->ID]['team_group'] = get_field('team_group');// ?? array_shift(explode("-",$group_name));
        $match_data[$post->ID]['team_point'] = get_field('team_point');
        $match_data[$post->ID]['is_pk'] = get_field('is_pk');
        $match_data[$post->ID]['team_point_pk'] = get_field('team_point_pk');
        $match_data[$post->ID]['match_end'] = get_field('match_end');
        $match_data[$post->ID]['team_vs'] = get_field('team_vs');
        $match_data[$post->ID]['start_time'] = get_field('start_time');
        $match_data[$post->ID]['end_time'] = get_field('end_time');
        $match_data[$post->ID]['match_venue'] = get_field('match_venue');
        $match_data[$post->ID]['match_court'] = get_field('match_court');
        $match_data[$post->ID]['scorer'] = get_field('scorer');

        #echo '<pre>';
        #var_dump($match_data[$post->ID]['team_vs']['team_a']->ID);
        #var_dump($team_data[$match_data[$post->ID]['team_vs']['team_a']->ID]['team_name']);
        #echo '</pre>';

        //初期化
        if(!isset($result_data[$match_data[$post->ID]['team_vs']['team_a']->ID]['vs_count'])){
            $result_data[$match_data[$post->ID]['team_vs']['team_a']->ID]['vs_count'] = 0;
        }
        if(!isset($result_data[$match_data[$post->ID]['team_vs']['team_b']->ID]['vs_count'])){
            $result_data[$match_data[$post->ID]['team_vs']['team_b']->ID]['vs_count'] = 0;
        }
        if(!isset($result_data[$match_data[$post->ID]['team_vs']['team_a']->ID]['win_point'])){
            $result_data[$match_data[$post->ID]['team_vs']['team_a']->ID]['win_point'] = 0;
        }
        if(!isset($result_data[$match_data[$post->ID]['team_vs']['team_b']->ID]['win_point'])){
            $result_data[$match_data[$post->ID]['team_vs']['team_b']->ID]['win_point'] = 0;
        }

        //チームNo
        $result_data[$match_data[$post->ID]['team_vs']['team_a']->ID]['team_no'] = $match_data[$post->ID]['team_vs']['team_a']->ID;
        $result_data[$match_data[$post->ID]['team_vs']['team_b']->ID]['team_no'] = $match_data[$post->ID]['team_vs']['team_b']->ID;

        //試合が終わった数
        if($match_data[$post->ID]['match_end']){
            $result_data[$match_data[$post->ID]['team_vs']['team_a']->ID]['vs_count']++;
            $result_data[$match_data[$post->ID]['team_vs']['team_b']->ID]['vs_count']++;
        }

        //勝ち点の計算
        //引き分け+１
        if($match_data[$post->ID]['match_end'] && ($match_data[$post->ID]['team_point']['team_a_point'] == $match_data[$post->ID]['team_point']['team_b_point'])){
            $result_data[$match_data[$post->ID]['team_vs']['team_a']->ID]['win_point']++;
            $result_data[$match_data[$post->ID]['team_vs']['team_b']->ID]['win_point']++;

        //勝ち+３
        }elseif($match_data[$post->ID]['match_end'] && ($match_data[$post->ID]['team_point']['team_a_point'] > $match_data[$post->ID]['team_point']['team_b_point'])){
            $result_data[$match_data[$post->ID]['team_vs']['team_a']->ID]['win_point'] += 3;

        }elseif($match_data[$post->ID]['match_end'] && ($match_data[$post->ID]['team_point']['team_a_point'] < $match_data[$post->ID]['team_point']['team_b_point'])){
            $result_data[$match_data[$post->ID]['team_vs']['team_b']->ID]['win_point'] += 3;
        }

        //得点
        $result_data[$match_data[$post->ID]['team_vs']['team_a']->ID]['goal_count'] += $match_data[$post->ID]['team_point']['team_a_point'];
        $result_data[$match_data[$post->ID]['team_vs']['team_b']->ID]['goal_count'] += $match_data[$post->ID]['team_point']['team_b_point'];

        //失点
        $result_data[$match_data[$post->ID]['team_vs']['team_a']->ID]['lost_count'] += $match_data[$post->ID]['team_point']['team_b_point'];
        $result_data[$match_data[$post->ID]['team_vs']['team_b']->ID]['lost_count'] += $match_data[$post->ID]['team_point']['team_a_point'];

        //得失点
        $result_data[$match_data[$post->ID]['team_vs']['team_a']->ID]['goal_difference'] += ($match_data[$post->ID]['team_point']['team_a_point'] - $match_data[$post->ID]['team_point']['team_b_point']);
        $result_data[$match_data[$post->ID]['team_vs']['team_b']->ID]['goal_difference'] += ($match_data[$post->ID]['team_point']['team_b_point'] - $match_data[$post->ID]['team_point']['team_a_point']);

        //勝・負・分
        if($match_data[$post->ID]['match_end'] && ($match_data[$post->ID]['team_point']['team_a_point'] == $match_data[$post->ID]['team_point']['team_b_point'])){
            $result_data[$match_data[$post->ID]['team_vs']['team_a']->ID]['same_count']++;
            $result_data[$match_data[$post->ID]['team_vs']['team_b']->ID]['same_count']++;
        }elseif($match_data[$post->ID]['match_end'] && ($match_data[$post->ID]['team_point']['team_a_point'] > $match_data[$post->ID]['team_point']['team_b_point'])){
            $result_data[$match_data[$post->ID]['team_vs']['team_a']->ID]['win_count']++;
            $result_data[$match_data[$post->ID]['team_vs']['team_b']->ID]['lose_count']++;
        }elseif($match_data[$post->ID]['match_end'] && ($match_data[$post->ID]['team_point']['team_a_point'] < $match_data[$post->ID]['team_point']['team_b_point'])){
            $result_data[$match_data[$post->ID]['team_vs']['team_a']->ID]['lose_count']++;
            $result_data[$match_data[$post->ID]['team_vs']['team_b']->ID]['win_count']++;        
        }

    endforeach; // ループの終了
    wp_reset_postdata(); // 直前のクエリを復元する

    $init_result_data = $result_data;


    //順位計算
    //勝ち点が多い順 ＞ 得失点差が大きい順　＞　得点が大きい順
    $vs_count = 0;
    if($result_data){
        foreach($result_data as $team_no => $result){
            $sort_array[$team_no] = $result;
            $vs_count += $result['vs_count'];
        }
    }
    // ソートの基準となるキーに対応する値の配列を作成
    function createArrayForSort($key_name, $array) {
        foreach ($array as $key => $value) {
                $standard_key_array[$key] = $value[$key_name];
        }

        return $standard_key_array;
    }

    // 各キーを基準にソートできるように、対応する値の配列を作成
    $win_point_array = createArrayForSort('win_point', $sort_array);
    $goal_difference_array = createArrayForSort('goal_difference', $sort_array);
    $goal_count_array = createArrayForSort('goal_count', $sort_array);

    //優先順位で昇順ソートする
    if ( $vs_count && $win_point_array && $goal_difference_array && $goal_count_array ){
    array_multisort($win_point_array, SORT_DESC, $goal_difference_array, SORT_DESC, $goal_count_array, SORT_DESC, $result_data);
    }
}
// echo '<pre>';
// var_dump($match_data);
// echo '</pre>';



?>
<?php get_header(); ?>

<div class="mian-image-area">
    <img class="main-img" src="<?=$tournament_img['url'];?>">
</div>
<main class="container py-5">
    <h5 class="text-center font-bold title">試合日程・結果</h5>
    <section class="">
        <?php
        if($group_name == "グループA" || $group_name == "グループB" || $group_name == "グループC"||$group_name == "グループD" || $group_name == "グループE" || $group_name == "グループF"){
            switch( $group_name ){
                case "グループA": $g=''; break;
                case "グループB": $g=''; break;
                case "グループC": $g='1'; break;
                case "グループD": $g='1'; break;
                case "グループE": $g='3'; break;
                case "グループF": $g='3'; break;
            }
        ?>
        <p class="mx-2 schedule-sub-title">グループリーグ</p>
        <div class="schedule-group-button-area">
                        <?php
                        //存在するグループ分だけリンク生成
                        ksort($group_list);
                        foreach($group_list as $gname){
                        if ( $gname == '所属グループなし' ) continue;
                        ?>
                                <a href="/league/?group=<?=$gname;?>&y=<?=$tournament;?>"><?=$gname;?></a>
                        <?
                        }
                        ?>
        </div>
        <?php
        }elseif($group_name == "プレミアリーグ(上位)" || $group_name == "ゴールドリーグ(中位)" || $group_name == "シルバーリーグ(下位)"){
        ?>
        <p class="mx-2 schedule-sub-title">順位決定リーグ</p>
        <div class="schedule-group-button-area">
            <a href="<?=home_url();?>/league/?group=プレミアリーグ(上位)&y=<?=$tournament;?>">プレミア</a>
            <a href="<?=home_url();?>/league/?group=ゴールドリーグ(中位)&y=<?=$tournament;?>">ゴールド</a>
            <a href="<?=home_url();?>/league/?group=シルバーリーグ(下位)&y=<?=$tournament;?>">シルバー</a>
        </div>    
        <?php
        }elseif(false&&$group_name == "プレミアリーグ(上位)A" || $group_name == "ゴールドリーグ(中位)A" || $group_name == "シルバーリーグ(下位)A" || $group_name == "プレミアリーグ(上位)B" || $group_name == "ゴールドリーグ(中位)B" || $group_name == "シルバーリーグ(下位)B"){
        ?>
        <p class="mx-2 schedule-sub-title">順位決定リーグ</p>
        <div class="schedule-group-button-area">
            <a href="<?=home_url();?>/league/?group=プレミアリーグ(上位)A&y=<?=$tournament;?>">プレミアA</a>
            <a href="<?=home_url();?>/league/?group=プレミアリーグ(上位)B&y=<?=$tournament;?>">プレミアB</a>
            <a href="<?=home_url();?>/league/?group=ゴールドリーグ(中位)A&y=<?=$tournament;?>">ゴールドA</a>
            <a href="<?=home_url();?>/league/?group=ゴールドリーグ(中位)B&y=<?=$tournament;?>">ゴールドB</a>
            <a href="<?=home_url();?>/league/?group=シルバーリーグ(下位)A&y=<?=$tournament;?>">シルバーA</a>
            <a href="<?=home_url();?>/league/?group=シルバーリーグ(下位)B&y=<?=$tournament;?>">シルバーB</a>
        </div>    
        <br />
        <div class="schedule-group-button-area">
            <a href="<?=home_url();?>/league/?group=プレミアリーグ(上位)AB-トーナメント&y=<?=$tournament;?>">プレミアトーナメント</a>
        </div>    
        <?php
        }elseif($group_name == "プレミアリーグ(上位)-トーナメント" || $group_name == "ゴールドリーグ(中位)-順位決定戦" || $group_name == "シルバーリーグ(下位)-順位決定戦"){
        ?>        
        <p class="mx-2 schedule-sub-title">順位決定リーグ</p>
        <div class="schedule-group-button-area">
            <a href="<?=home_url();?>/league/?group=プレミアリーグ(上位)-トーナメント&y=<?=$tournament;?>">プレミア</a>
            <a href="<?=home_url();?>/league/?group=ゴールドリーグ(中位)&y=<?=$tournament;?>">ゴールド</a>
            <a href="<?=home_url();?>/league/?group=シルバーリーグ(下位)&y=<?=$tournament;?>">シルバー</a>
        </div>    
        <?php
        }
        ?>
        <?php if($group_name == "プレミアリーグ(上位)" ): ?>
        <br />
        <div class="schedule-group-button-area">
            <a href="<?=home_url();?>/league/?group=プレミアリーグ(上位)-トーナメント&y=<?=$tournament;?>">プレミアトーナメント</a>
        </div>    
        <?php endif; ?>
        <?php if($group_name == "プレミアリーグ(上位)-トーナメント" ): ?>
        <br />
        <div class="schedule-group-button-area">
            <a href="<?=home_url();?>/league/?group=プレミアリーグ(上位)&y=<?=$tournament;?>">プレミアリーグ</a>
        </div>    
        <?php endif; ?>

        <?php if($group_name == "プレミアトーナメント" || $group_name == "ゴールドトーナメント" || $group_name == "シルバートーナメント"): ?>
        <br />
        <p class="mx-2 schedule-sub-title">順位決定トーナメント</p>
        <div class="schedule-group-button-area">
            <a href="<?=home_url();?>/league/?group=プレミアトーナメント&y=<?=$tournament;?>">プレミアトーナメント</a>
            <a href="<?=home_url();?>/league/?group=ゴールドトーナメント&y=<?=$tournament;?>">ゴールドトーナメント</a>
            <a href="<?=home_url();?>/league/?group=シルバートーナメント&y=<?=$tournament;?>">シルバートーナメント</a>
        </div>    
        <br />
        <?php
            if($group_name == "プレミアトーナメント"){
                $page = 1;
                $g = '';
            } elseif($group_name == "ゴールドトーナメント"){
                $page = 2;
                $g = '1';
            } elseif($group_name == "シルバートーナメント"){
                $page = 3;
                $g = '3';
            }
        ?>

<?php if ( $tournament == 2025 && strstr($_SERVER['HTTP_USER_AGENT'], "Chrome") ): ?>
        <iframe width="300" height="400" src="<?= home_url(); ?>/web/viewer.html?file=/img/report.pdf#page=<?= $page ?>&zoom=page-width" allowfullscreen></iframe>
<?php else: ?>
        <embed src="/img/report.pdf#page=<?= $page ?>" type="application/pdf" width="100%" height="600">

<?php endif; ?>
        <div class="text-sm text-center">
        <a href="<?= home_url(); ?>/img/report.pdf">pdfファイル</a>
        </div>
        <?php endif; ?>

        <?php
        if ( strstr($group_name,"トーナメント") ){
            $hidden = " hidden";
        }
        ?>
        <div class="schedule-group-name mb-3">
            <p class="mx-2 schedule-sub-title"><?= $group_name;?></p>
        </div>
        <div class="">
            <table class="table table-bordered border-2">
                <thead>
                <tr class="table-th-bg">
                    <th class="text-sm<?= $hidden ?>">順位</th>
                    <th class="text-sm">クラブ名</th>
                    <th class="text-sm text-center">試合数</th>
                    <th class="text-sm text-center<?= $hidden ?>">勝ち点</th>
                    <th class="text-sm text-center">得点</th>
                    <th class="text-sm text-center">失点</th>
                    <th class="text-sm text-center<?= $hidden ?>">得失差</th>
                    <th class="text-sm text-center">勝</th>
                    <th class="text-sm text-center<?= $_hidden ?>">分</th>
                    <th class="text-sm text-center">負</th>
                    </tr>
                </thead>
                <tbody class="text-sm">
                    <?php
                    $rank=1;
                    foreach($result_data as $key => $result){
                        if ( strlen($team_data[$result['team_no']]['team_name']) <= 3 ){
                            continue;
                        }
                    ?>
                        <tr class="text-sm">
                            <th scope="row" class="<?= $hidden ?>"><?=$rank;?></th>
                            <?
                            ?>
                            <td class=""><?=$team_data[$result['team_no']]['team_name'];?></td>
                            <td><?=$result['vs_count']==0 ? 0 : $result['vs_count'];?></td>
                            <td class="<?= $hidden ?>"><?=$result['win_point']==0 ? 0 : $result['win_point'];?></td>
                            <td><?=$result['goal_count']==0 ? 0 : $result['goal_count'];?></td>
                            <td><?=$result['lost_count']==0 ? 0 : $result['lost_count'];?></td>
                            <td class="<?= $hidden ?>"><?=$result['goal_difference']==0 ? 0 : $result['goal_difference'];?></td>
                            <td><?=$result['win_count']==0 ? 0 : $result['win_count'];?></td>
                            <td class="<?= $_hidden ?>"><?=$result['same_count']==0 ? 0 : $result['same_count'];?></td>
                            <td><?=$result['lose_count']==0 ? 0 : $result['lose_count'];?></td>
                        </tr>
                    <?php
                        $rank++;
                    }
                    ?>
                </tbody>
            </table>
        </div>
        <?php if($tournament<=2024 || $group_name == "グループA" || $group_name == "グループB" || $group_name == "グループC"||$group_name == "グループD" || $group_name == "グループE" || $group_name == "グループF"): ?>
        <?php endif; ?>

        <!-- 試合見出し -->
        <div class="mt-5">

            <?php
            //取得できた試合数分だけループ
            $match_data_chunk = array();
            $match_count = 0;
            $loop = 0;
            foreach($match_data as $match_id => $match){
                $match_count++;
//                var_dump($match_count);
                $match_status = '試合開始前';
                if($match['match_end']){
                    $match_status = '試合終了';
                }
            ?>

                <!-- 第N試合 -->
                <?php
                if(($tournament==2025&&strstr($group_name,'グループ'))||$match_count%2==1){
                    if(($tournament==2025&&strstr($group_name,'グループ'))){
                    $loop = $match_count;
                    } else {
                    $loop++;
                    }
                ?>
                <div class="schedule-group-section-title">
                    <p class="text-md schedule-section-button" data-target="<?=$loop;?>">第<?=$loop;?>試合</p>
                    <p class="text-sm schedule-section-button" data-target="<?=$loop;?>"><span class="mx-3 text-sm"><?=$match['start_time'];?> ~</span>+</p>
                </div>

                <!-- No.N/A -->
                <div class="hidden group<?=$loop;?>" style="display: none;">
                    <div class="schedule-group-detail-wrapper">
                        <p class="text-md text-center font-bold"><?=$match['match_name'];?></p>
                        <p class="schedule-place-name text-sm text-center mt-2"><?=$match['match_venue']->post_title;?></p>
                        <div class="schedule-group-detail">
                            <div class="schedule-detail-team">
                                <img class="schedule-team-logo" src="<?=$team_data[$match['team_vs']['team_a']->ID]['team_logo'];?>">
                                <p class="schedule-team-name text-sm text-center my-2"><?=$match['team_vs']['team_a']->post_title;?></p>
                            </div>
                            <div style="width:30%;">
                                <p class="text-md text-center font-bold"><?=$match['start_time'];?></p>
                                <div class="d-flex justify-content-around align-items-center">
                                    <p class="mx-3 text-lg schedule-score"><?=$match['team_point']['team_a_point'];?></p>
                                    <p class="schedule-game-status-before"><?=$match_status;?></p>
                                    <p class="mx-3 text-lg schedule-score"><?=$match['team_point']['team_b_point'];?></p>
                                </div>
                            </div>
<?/*                            
                            <pre>
                            <? var_dump($match['team_vs']['team_b']);?>
                            </pre>
*/?>
                            <div class="schedule-detail-team">
                                <img class="schedule-team-logo" src="<?=$team_data[$match['team_vs']['team_b']->ID]['team_logo'];?>">
                                <p class="schedule-team-name text-sm text-center my-2"><?=$match['team_vs']['team_b']->post_title;?></p>
                            </div>
                        </div>
                        <div style="display:flex; margin-top:0.85em;">
                            <div style="width:50%; padding:0 1em; font-size: 0.8em; display: flex; flex-wrap: wrap; justify-content: flex-end; align-items: flex-start;">
                                <?php
                                //チームA得点者
                                $cnt=1;
                                if($match['scorer']['team_a_scorer']){
                                    foreach($match['scorer']['team_a_scorer'] as $key => $val){
                                ?>
                                        <div class="text-center font-bold" style="white-space: nowrap; width: 100%;"><?=$cnt;?>.<?=$val["scorer_name"]->post_title;?></div>
                                <?php
                                        $cnt++;
                                    }
                                }
                                ?>
                                </div>
                                <div style="width:50%; padding:0 1em; font-size: 0.8em; display: flex; flex-wrap: wrap; justify-content: flex-end; align-items: flex-start;">
                                <?php
                                //チームB得点者
                                $cnt=1;
                                if($match['scorer']['team_b_scorer']){
                                    foreach($match['scorer']['team_b_scorer'] as $key => $val){
                                ?>
                                        <div class="text-center font-bold" style="white-space: nowrap; width: 100%;"><?=$cnt;?>.<?=$val["scorer_name"]->post_title;?></div>
                                <?php
                                        $cnt++;
                                    }
                                }
                                ?>
                                </div>
                            </div>

                            <?php
                            //PKの場合
                            if($match['is_pk']){
                            ?>
                            <p class="text-center font-bold"><?=$match['team_point_pk']['team_a_point_pk'];?> (PK) <?=$match['team_point_pk']['team_b_point_pk'];?></p>
                            <?
                            }
                            ?>
                    </div>
                </div>
                <?
                }else{
                ?>

                <!-- No.N/B -->
                <div class="hidden group<?=$loop;?>" style="display: none;">
                    <div class="schedule-group-detail-wrapper">
                        <p class="text-md text-center font-bold"><?=$match['match_name'];?></p>
                        <p class="schedule-place-name text-sm text-center mt-2"><?=$match['match_venue']->post_title;?></p>
                        <div class="schedule-group-detail">
                            <div class="schedule-detail-team">
                                <img class="schedule-team-logo" src="<?=$team_data[$match['team_vs']['team_a']->ID]['team_logo'];?>">
                                <p class="schedule-team-name text-sm text-center my-2"><?=$match['team_vs']['team_a']->post_title;?></p>
                            </div>
                            <div style="width:30%;">
                                <p class="text-md text-center font-bold"><?=$match['start_time'];?></p>
                                <div class="d-flex justify-content-around align-items-center">
                                    <p class="mx-3 text-lg schedule-score"><?=$match['team_point']['team_a_point'];?></p>
                                    <p class="schedule-game-status-before"><?=$match_status;?></p>
                                    <p class="mx-3 text-lg schedule-score"><?=$match['team_point']['team_b_point'];?></p>
                                </div>
                            </div>
                            <div class="schedule-detail-team">
                                <img class="schedule-team-logo" src="<?=$team_data[$match['team_vs']['team_b']->ID]['team_logo'];?>">
                                <p class="schedule-team-name text-sm text-center my-2"><?=$match['team_vs']['team_b']->post_title;?></p>
                            </div>
                        </div>
                        <div style="display:flex; margin-top:0.85em;">
                            <div style="width:50%; padding:0 1em; font-size: 0.8em; display: flex; flex-wrap: wrap; justify-content: flex-end; align-items: flex-start;">
                            <?php
                            //チームA得点者
                            if($match['scorer']['team_a_scorer']){
                                $cnt=1;
                                foreach($match['scorer']['team_a_scorer'] as $key => $val){
                                    if($val["scorer_name"]->post_title){
                            ?>
                                        <div class="text-center font-bold" style="white-space: nowrap; width: 100%;"><?=$cnt;?>.<?=$val["scorer_name"]->post_title;?></div>
                            <?php
                                        $cnt++;
                                    }
                                }
                            }
                            ?>
                            </div>
                            <div style="width:50%; padding:0 1em; font-size: 0.8em; display: flex; flex-wrap: wrap; justify-content: flex-start; align-items: flex-start;">
                            <?php
                            //チームB得点者
                            if($match['scorer']['team_b_scorer']){
                                $cnt=1;
                                foreach($match['scorer']['team_b_scorer'] as $key => $val){
                                    if($val["scorer_name"]->post_title){
                            ?>
                                        <div class="text-center font-bold" style="white-space: nowrap; width: 100%;"><?=$cnt;?>.<?=$val["scorer_name"]->post_title;?></div>
                            <?php
                                        $cnt++;
                                    }
                                }
                            }
                            ?>
                            </div>
                        </div>
                        <?php
                        //PKの場合
                        if($match['is_pk']){
                        ?>
                        <p class="text-center font-bold"><?=$match['team_point_pk']['team_a_point_pk'];?> (PK) <?=$match['team_point_pk']['team_b_point_pk'];?></p>
                        <?
                        }
                        ?>
                    </div>
                </div>
            <?php } ?>
                        <?php if(($tournament==2025&&strstr($group_name,'グループ'))){ ?>
                        <?php if ( $loop == 4 ){ ?>
                        <div class="schedule-group-button-area" />
                        <img src="/img/e1710_1<?=$g;?>.png" width=300 style="position:absolute; left:230px; top;50px;" /><img src="/img/1737848547401.jpg" width=300  style="margin:20px;"/>
                        </div>
                        <?php } ?>
                        <?php } elseif($tournament==2025){ ?>
                        <?php if( $match_count == 8 ){ ?>
                        <div class="schedule-group-button-area" />
                        <img src="/img/e1710_1<?=$g;?>.png" width=300 style="position:absolute; left:230px; top;50px;" /><img src="/img/1737848547401.jpg" width=300  style="margin:20px;"/>
                        </div>
                        <?php } ?>
                        <?php } ?>
            <?php } ?>


        </div>
    </section>
</main>
<script type="text/javascript">
<?php if ( $tournament == 2025 ): ?>
$(".schedule-section-button").each(function(index, element){
    var openAreaTarget = $(this).data('target');

    if(!$(this).hasClass('open')) {
        $('.group' + openAreaTarget).slideDown();
        $(this).addClass('open');
    } else {
        $('.group' + openAreaTarget).slideUp();
        $(this).removeClass('open');
    }
});
<?php endif; ?>


</script>

<?php get_footer(); ?>
