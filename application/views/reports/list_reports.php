<div id="container" class="clearfix">
	<div id="content">
		<h1 class="title">Listado de reportes <? echo anchor($this->router->reverseRoute('reports-create'), 'Añade un nuevo reporte', array('class' => "button submit")); ?></h1>
		<ul class="reports_list">
			<? foreach ($reports as $report) : ?>
				<li>
					<?= anchor($this->router->reverseRoute('reports-view', array('slug' => $report->slug)), $report->title); ?>
					<? if (is_object($user) && !$report->is_voted($user->id)) : ?>
					[<a href="<?php echo site_url(array('services/fix_vote', $user->id ,$report->id)); ?>" id="vote-<?= $report->id ?>" class="fix_vote">¡<span class="count-vote-<?= $report->id ?>"><?= $report->votes_count; ?></span> Fixs!</a>]
					<? else : ?>
					[<span>¡<span class="count-vote-<?= $report->id ?>"><?= $report->votes_count; ?></span> Fixs!</span>]
					<? endif; ?>
				</li>
			<? endforeach; ?>
		</ul>
	</div>
</div>
