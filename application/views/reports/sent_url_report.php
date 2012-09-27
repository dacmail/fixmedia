<div id="container" class="clearfix sending_url columns">
	<div id="content">
		<section class="report_info clearfix">
			<div class="screenshot">
				<img src="<?php echo base_url(); ?>static/screenshot-med.jpg" alt="Captura de <?=$report->title;?>" />
				<a class="url_sent" href="<?=$report->url; ?>" target="blank">Ver noticia original</a>
			</div>
			<h1 class="title"><?=$report->title;?></h1>
			<div class="report_meta">
				<p class="authorship">Enviado por <a href="<?= site_url($this->router->reverseRoute('user-profile', array('username' => $report->user->name))); ?>"><?= $report->user->name; ?></a> el <?= $report->created_at->format('d/m/Y'); ?></p>
				<p class="source">Fuente: <?= $report->site; ?></p>
			</div>
		</section>

		<section class="sending_actions clearfix">
			<h2 class="action_title">Ya has hecho fix a esta noticia. <strong>¿Qué quieres hacer con ella ahora?</strong></h2>

			<a href="<?= site_url($this->router->reverseRoute('reports-view-share', array('slug' => $report->slug, 'share' => 'share'))); ?>" class="button icon share">
			Compártela <span class="subtitle">Para arreglarla entre todos</span>
			</a>

			<a href="<?= site_url($this->router->reverseRoute('reports-send' , array('id' => $report->id))); ?>" class="button submit icon add_report">
			Arréglala <span class="subtitle">Empieza tú mismo</span>
			</a>
		</section>

	</div>
	<aside id="sidebar" class="report">
		<div class="counter"><span class="count count-vote-<?= $report->id ?>"><?= $report->votes_count ?></span>
			persona (tu) quiere que alguien la arregle
		</div>
	</aside>
</div>