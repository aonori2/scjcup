<?php
// デフォルトの年を設定
$default_year = wp_get_year();
#$default_year = 2024;
$tournament = $_REQUEST['y'] ?? '';
if (!preg_match('/^\d+$/', $tournament) || $tournament > $default_year) {
    $tournament = $default_year;
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
							<li>
								<a href="<?=home_url();?>/group/?group=グループA&y=<?=$tournament;?>"><i class="fas fa-chevron-right me-2"></i>グループA</a>
							</li>
							<li>
								<a href="<?=home_url();?>/group/?group=グループB&y=<?=$tournament;?>"><i class="fas fa-chevron-right me-2"></i>グループB</a>
							</li>
							<li>
								<a href="<?=home_url();?>/group/?group=グループC&y=<?=$tournament;?>"><i class="fas fa-chevron-right me-2"></i>グループC</a>
							</li>
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
<?php wp_footer(); ?>
</body>
</html>
