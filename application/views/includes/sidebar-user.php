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
			<div class="row <?= $user_rank->username==$user->username ? 'user' : 'clearfix'; ?>">
				<span class="pos"><?= $user_rank->id; ?></span> <span class="site"><?= $user_rank->name; ?></span>
			</div>
		<? endforeach; ?> 
	</section>
	<? $this->load->view('includes/mini-faqs'); ?>
</aside>