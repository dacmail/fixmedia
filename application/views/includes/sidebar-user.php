<aside id="sidebar">
	<section class="user_info">
		<div class="clearfix fix_reports_counters">
			<div class="fixes"><span class="count"><?= count($user->fixes); ?></span> fixes</div>
			<div class="reports"><span class="count"><?= count($user->subreports); ?></span> reportes</div>
		</div>
	</section>
	<section class="block ranking users">
		<h3 class="title">Posición de <?= $user->name; ?> en Fixmedia</h3>
		<? foreach ($users_ranking as $user_rank) :?>
			<?$users_ranking_position++;?>
			<div class="row <?= $user_rank->id==$user->id ? 'user' : 'clearfix'; ?>">
				<span class="pos"><?= $users_ranking_position ?></span> <span class="site"><a href="<?= site_url($this->router->reverseRoute('user-profile', array('username' => $user_rank->username))); ?>"><?= $user_rank->name; ?></a></span>
			</div>
		<? endforeach; ?> 
	</section>
	<? $this->load->view('includes/mini-faqs'); ?>
</aside>