<div id="container" class="clearfix">
	<div id="content">
		<h1 class="title">Listado de reportes <? echo anchor($this->router->reverseRoute('reports-create'), 'Añade un nuevo reporte', array('class' => "button submit")); ?></h1>
		<ul class="reports_list">
			<? foreach ($reports as $report) : ?>
				<li>
					<?= anchor($this->router->reverseRoute('reports-view', array('slug' => $report->slug)), $report->title); ?>
					<? if ($logged_in && !$report->is_voted($the_user->id)) : ?>
					<a href="<?php echo site_url(array('services/fix_vote',$report->id)); ?>" id="vote-<?= $report->id ?>" class="fix_vote">¡<span class="count-vote-<?= $report->id ?>"><?= $report->votes_count; ?></span> Fixs!</a>
					<? elseif (!$logged_in) : ?>
					<a href="<?php echo base_url("index.php/auth/login"); ?>">¡<span class="count-vote-<?= $report->id ?>"><?= $report->votes_count; ?></span> Fixs!</a>
					<? endif; ?>


				</li>
			<? endforeach; ?>
		</ul>
	</div>
</div>
