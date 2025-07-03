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
<footer>
	<div class="container">
		<div class="footer-area px-3 py-3">
			<div class="footer-nav">   
				<ul>
					<li>
						<a href="<?=home_url();?>?y=<?=$tournament;?>">大会概要</a>
					</li>
					<li>
						<p class="footer-nav-item" data-target="1">参加チーム一覧</p>
						<ul id="footer-nav-subItem1" class="hidden">
							<li>
								<a href="<?=home_url();?>/group/?y=<?=$tournament;?>"><i class="fas fa-chevron-right me-2"></i>すべてのチーム</a>
							</li>
                            <?php
                            //存在するグループ分だけリンク生成
                            ksort($group_list);
                            foreach($group_list as $group_name){
                            ?>
                                <li><a href="/group/?group=<?=$group_name;?>&y=<?=$tournament;?>"><i class="fas fa-chevron-right me-2"></i><?=$group_name;?></a></li>
                            <?
                            }
                            ?>
						</ul>
					</li>
					<li>
						<a href="<?=home_url();?>/venue/?y=<?=$tournament;?>">会場一覧</a>
					</li>
					<li>
						<p class="footer-nav-item" data-target="2">試合日程・結果</p>
						<ul id="footer-nav-subItem2" class="hidden">
							<li class="footer-nav-sub-item">
								<p class="footer-nav-sub-item-title" data-target="1">グループリーグ</p>
								<ul id="footer-nav-item-second-area1" class="hidden">
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

<?php if ( $tournament<=2024 ): ?>
                            <li class="nav-sub-item">
								<p class="footer-nav-sub-item-title" data-target="2">プレミアリーグ(上位)</p>
								<ul id="footer-nav-item-second-area2" class="hidden">
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
								<p class="footer-nav-sub-item-title" data-target="3">ゴールドリーグ(中位)</p>
								<ul id="footer-nav-item-second-area3" class="hidden">
                                    <li class="nav-sub-item">
                                        <a href="<?=home_url();?>/league/?group=ゴールドリーグ(中位)&y=<?=$tournament;?>">
                                            <i class="fas fa-chevron-right me-2"></i>グループLeague
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="nav-sub-item">
								<p class="footer-nav-sub-item-title" data-target="4">シルバーリーグ(下位)</p>
								<ul id="footer-nav-item-second-area4" class="hidden">
                                    <li class="nav-sub-item">
                                        <a href="<?=home_url();?>/league/?group=シルバーリーグ(下位)&y=<?=$tournament;?>">
                                            <i class="fas fa-chevron-right me-2"></i>グループLeague
                                        </a>
                                    </li>
                                </ul>
                            </li>
<?php elseif ( $tournament==2025 ): ?>
                            <li class="nav-sub-item">
								<p class="footer-nav-sub-item-title" data-target="2">プレミアトーナメント</p>
								<ul id="footer-nav-item-second-area2" class="hidden">
                                    <li class="nav-sub-item">
                                        <a href="<?=home_url();?>/league/?group=プレミアトーナメント&y=<?=$tournament;?>">
                                            <i class="fas fa-chevron-right me-2"></i>プレミアトーナメント
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="nav-sub-item">
								<p class="footer-nav-sub-item-title" data-target="3">ゴールドトーナメント</p>
								<ul id="footer-nav-item-second-area3" class="hidden">
                                    <li class="nav-sub-item">
                                        <a href="<?=home_url();?>/league/?group=ゴールドリーグトーナメント&y=<?=$tournament;?>">
                                            <i class="fas fa-chevron-right me-2"></i>ゴールドリーグトーナメント
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="nav-sub-item">
								<p class="footer-nav-sub-item-title" data-target="4">シルバートーナメント</p>
								<ul id="footer-nav-item-second-area4" class="hidden">
                                    <li class="nav-sub-item">
                                        <a href="<?=home_url();?>/league/?group=シルバートーナメント&y=<?=$tournament;?>">
                                            <i class="fas fa-chevron-right me-2"></i>シルバートーナメント
                                        </a>
                                    </li>
                                </ul>
                            </li>
<?php else: ?>
                            <li class="nav-sub-item">
								<p class="footer-nav-sub-item-title" data-target="2">プレミアリーグ(上位)</p>
								<ul id="footer-nav-item-second-area2" class="hidden">
                                    <li class="nav-sub-item">
                                        <a href="<?=home_url();?>/league/?group=プレミアリーグ(上位)A&y=<?=$tournament;?>">
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
								<p class="footer-nav-sub-item-title" data-target="3">ゴールドリーグ(中位)</p>
								<ul id="footer-nav-item-second-area3" class="hidden">
                                    <li class="nav-sub-item">
                                        <a href="<?=home_url();?>/league/?group=ゴールドリーグ(中位)A&y=<?=$tournament;?>">
                                            <i class="fas fa-chevron-right me-2"></i>グループLeague
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="nav-sub-item">
								<p class="footer-nav-sub-item-title" data-target="4">シルバーリーグ(下位)</p>
								<ul id="footer-nav-item-second-area4" class="hidden">
                                    <li class="nav-sub-item">
                                        <a href="<?=home_url();?>/league/?group=シルバーリーグ(下位)A&y=<?=$tournament;?>">
                                            <i class="fas fa-chevron-right me-2"></i>グループLeague
                                        </a>
                                    </li>
                                </ul>
                            </li>
<?php endif; ?>

<!--
							<li class="footer-nav-sub-item">
								<p class="footer-nav-sub-item-title" data-target="2">プレミアリーグ(上位)</p>
								<ul id="footer-nav-item-second-area2" class="hidden">
									<li class="nav-sub-item">
										<a href="../premireLeague/groupLeague.html">
											<i class="fas fa-chevron-right me-2"></i>Group League
										</a>
									</li>
									<li class="nav-sub-item">
										<a href="../premireLeague/tournament.html">
											<i class="fas fa-chevron-right me-2"></i>Tournament
										</a>
									</li>
								</ul>
							</li>
							<li class="footer-nav-sub-item">
								<p class="footer-nav-sub-item-title" data-target="3">ゴールドリーグ(中位)</p>
								<ul id="footer-nav-item-second-area3" class="hidden">
									<li class="nav-sub-item">
										<a href="../goldLeague/groupLeague.html">
											<i class="fas fa-chevron-right me-2"></i>Group League
										</a>
									</li>
									<li class="nav-sub-item">
										<a href="../goldLeague/tournament.html">
											<i class="fas fa-chevron-right me-2"></i>順位決定戦
										</a>
									</li>
								</ul>
							</li>
							<li class="footer-nav-sub-item">
								<p class="footer-nav-sub-item-title" data-target="4">シルバーリーグ(下位)</p>
								<ul id="footer-nav-item-second-area4" class="hidden">
									<li class="nav-sub-item">
										<a href="../silverLeague/groupLeague.html">
											<i class="fas fa-chevron-right me-2"></i>Group League
										</a>
									</li>
									<li class="nav-sub-item">
										<a href="../silverLeague/tournament.html">
											<i class="fas fa-chevron-right me-2"></i>順位決定戦
										</a>
									</li>
								</ul>
							</li>
-->
						</ul>
					</li>
					<li>
						<a href="<?=home_url();?>/sponsor<?=$tournament;?>/?y=<?=$tournament;?>">協賛企業ご紹介</a>
					</li>
<!--					
					<li>
						<a href="<?=home_url();?>/coupon/">お得なクーポン</a>
					</li>
-->
				</ul>
			</div>
		</div>
	</div>
</footer>
<?php
// 管理者権限の場合のみ対象とする
if ( current_user_can( '_tournament_editor' ) ) {
    global $wpdb;
    echo "<pre>";
    // SQL クエリを表示
    print_r( $wpdb->queries );
    echo "</pre>";
}
?>
<?php wp_footer(); ?>
</body>
</html>
