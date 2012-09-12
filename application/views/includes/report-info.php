<section class="report_info clearfix">
	<div class="screenshot">
		<img src="<?php echo base_url(); ?>fakes/screenshot-med.jpg" alt="Captura de <?=$report->title;?> "  title="karma <?= $report->karma ?> / coef <?= $report->karma_value ?> / valor <?= $report->karma*$report->karma_value?>"/>
		<a class="url_sent" href="<?=$report->url; ?>" target="blank">Ver noticia original</a>
	</div>
	<h1 class="title"><?=$report->title;?></h1>
	<div class="report_meta">
		<p class="authorship">Enviado por <a href="<?= site_url($this->router->reverseRoute('user-profile', array('username' => $report->user->name))); ?>"><?= $report->user->name; ?></a> el <?= $report->created_at->format('d/m/Y'); ?></p>
		<p class="source">Fuente: <a href="<?= site_url($this->router->reverseRoute('source-profile', array('sitename' => $report->site))); ?>"><?= $report->site; ?></a></p>
	</div>
</section>