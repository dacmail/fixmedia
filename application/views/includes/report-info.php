<section class="report_info clearfix <? echo ($logged_in && $report->is_removable($the_user->id)) ? 'removable' : ''; ?>">
	<div class="screenshot">
		<? if (is_null($report->screenshot) || $report->screenshot=="ERROR") : ?>
			<a href="<?=$report->url; ?>" target="_blank"><img src="<?= base_url('static/screenshot-med.jpg'); ?>" alt="<? printf(_('Captura de %s'), $report->title); ?>"  title="karma <?= $report->karma ?> / coef <?= $report->karma_value ?> / valor <?= $report->karma*$report->karma_value?>"/></a>
		<? else : ?>
			<a href="<?=$report->url; ?>" target="_blank"><img src="<?=base_url('images/sources/thumb-report-' . $report->id . '.png'); ?>" width="180" alt="<? printf(_('Captura de %s'), $report->title); ?>"  title="karma <?= $report->karma ?> / coef <?= $report->karma_value ?> / valor <?= $report->karma*$report->karma_value?>"/></a>
		<? endif; ?>
		<a class="url_sent" href="<?=$report->url; ?>" target="blank"><? _e('Ver noticia original'); ?></a>
	</div>
	<h1 class="title"><?=$report->title;?></h1>
	<div class="report_meta">
		<p class="authorship"><? _e('Enviado por'); ?> <a href="<?= site_url($this->router->reverseRoute('user-profile', array('username' => $report->user->username))); ?>"><?= $report->user->name; ?></a> <? _e('el'); ?> <?= $report->created_at->format('d/m/Y'); ?></p>
		<p class="source"><? _e('Fuente'); ?>: <a href="<?= site_url($this->router->reverseRoute('source-profile', array('sitename' => $report->site))); ?>"><?= $report->site; ?></a></p>
	</div>
	<? if ($logged_in && $report->is_removable($the_user->id)) : ?>
		<p class="remove-report"><? _e('Esta noticia la has enviado tú y todavía puedes eliminarla.'); ?> <a href="<?= site_url('reports/delete/' . $report->id); ?>"><? _e('Eliminar noticia'); ?></a></p>
	<? endif; ?>
</section>
