<div id="container" class="clearfix sending_url columns">
	<div id="content">
		<section class="report_info clearfix <? echo ($logged_in && $report->is_removable($the_user->id)) ? 'removable' : ''; ?>">
			<div class="screenshot">
				<img src="<?php echo base_url(); ?>static/screenshot-med.jpg" alt="<? printf(_('Captura de %s'), $report->title); ?>" />
				<a class="url_sent" href="<?=$report->url; ?>" target="blank"><? _e('Ver noticia original'); ?></a>
			</div>
			<h1 class="title"><?=$report->title;?></h1>
			<div class="report_meta">
				<p class="authorship"><? _e('Enviado por '); ?><a href="<?= site_url($this->router->reverseRoute('user-profile', array('username' => $report->user->name))); ?>"><?= $report->user->name; ?></a> <? _e('el'); ?> <?= $report->created_at->format('d/m/Y'); ?></p>
				<p class="source"><? _e('Fuente'); ?>: <?= $report->site; ?></p>
			</div>
			<? if ($logged_in && $report->is_removable($the_user->id)) : ?>
				<p class="remove-report"><? _e('Esta noticia la has enviado tú y todavía puedes eliminarla.'); ?> <a href="<?= site_url('reports/delete/' . $report->id); ?>"><? _e('Eliminar noticia'); ?></a></p>
			<? endif; ?>
		</section>

		<section class="sending_actions clearfix">
			<h2 class="action_title"><? _e('Ya has hecho fix a esta noticia.'); ?> <strong><? _e('¿Qué quieres hacer con ella ahora?'); ?></strong></h2>

			<a href="<?= site_url($this->router->reverseRoute('reports-view-share', array('slug' => $report->slug, 'share' => 'share'))); ?>" class="button icon share">
			<? _e('Compártela'); ?> <span class="subtitle"><? _e('Para arreglarla entre todos'); ?></span>
			</a>

			<a href="<?= site_url($this->router->reverseRoute('reports-send' , array('id' => $report->id))); ?>" class="button submit icon add_report">
			<? _e('Arréglala'); ?> <span class="subtitle"><? _e('Empieza tú mismo'); ?></span>
			</a>
		</section>

	</div>
	<aside id="sidebar" class="report">
		<div class="counter"><span class="count count-vote-<?= $report->id ?>"><?= $report->votes_count ?></span>
			<? _e('persona (tu) quiere que alguien la arregle'); ?>
		</div>
	</aside>
</div>