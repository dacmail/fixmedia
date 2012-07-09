<div id="container" class="clearfix">
	<div id="content">
		<h1 class="title">Listado de reportes <? echo anchor($this->router->reverseRoute('reports-create'), 'Añade un nuevo reporte', array('class' => "button submit")); ?></h1>
		<ul class="reports_list">
			<? foreach ($reports as $report) : ?>
				<li>
					<?= anchor($this->router->reverseRoute('reports-view', array('slug' => $report->slug)), $report->title); ?>
					[<a href="<?php echo site_url(array('services/fix_vote', 1 ,$report->id)); ?>" id="vote-<?= $report->id ?>" class="fix_vote">¡<span id="vote-count-<?= $report->id ?>"><?= $report->votes; ?></span> Fixs!</a>]
				</li>
			<? endforeach; ?>
		</ul>
	</div>
</div>
