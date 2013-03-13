<aside id="sidebar">
	<section class="user_info">
		<div class="clearfix fix_reports_counters">
			<div class="fixes"><span class="count"><?= count($user->fixes); ?></span> <? _e('fixes'); ?></div>
			<div class="reports"><span class="count"><?= count($user->subreports); ?></span> <? _e('reportes'); ?></div>
		</div>
	</section>
	<section class="user_karma">
		<?= karma_graphic($user->karma); ?>
	</section>
	<? if ($logged_in && $user->id==$the_user->id) : ?>
		<section class="user_data">
			<p class="header row"><? _e('Noticias descubiertas'); ?> <span><?= $user->send_fixes(); ?></span></p>
			<p class="row"><? _e('Fixes recibidos'); ?> <span><?= $user->fixes_accumulated(); ?></span></p>
			<p class="row"><? _e('Fixes de media'); ?> <span><?= $user->fixes_avg(); ?></span></p>
			<p class="row avg"><? _e('Media en Fixmedia'); ?> <span><?= avg_fixes(); ?></span></p>
			<p class="row"><? _e('Reportes recibidos'); ?> <span><?= $user->received_reports(); ?></span></p>
			<p class="header row"><? _e('Reportes propios'); ?> <span><?= count($user->subreports); ?></span></p>
			<p class="row"><? _e('Valoración media'); ?> <span><?= $user->votes_avg(); ?></span></p>
			<p class="row avg"><? _e('Valoración media en Fixmedia'); ?> <span><?= avg_votes(); ?></span></p>
		</section>
	<? endif; ?>
	<section class="block ranking users">
		<h3 class="title"><? printf(_('Posición de %s en Fixmedia'), $user->name); ?></h3>
		<? foreach ($users_ranking as $user_rank) :?>
			<?$users_ranking_position++;?>
			<div class="row <?= $user_rank->id==$user->id ? 'user' : 'clearfix'; ?>">
				<span class="pos"><?= $users_ranking_position ?></span> <span class="site"><a href="<?= site_url($this->router->reverseRoute('user-profile', array('username' => $user_rank->username))); ?>"><?= $user_rank->name; ?></a></span>
			</div>
		<? endforeach; ?>
	</section>
	<? $this->load->view('includes/mini-faqs'); ?>
</aside>