<div id="container" class="clearfix columns">
	<div id="content">
		<h1 class="title"><?=$title?></h1>
		<p class="sub_title sep"><?=$subtitle?></p>
		<section class="reports_list">
			<? foreach ($reports as $report) : ?>
				<article class="report_info clearfix">
					<div class="screenshot">
						<? if (is_null($report->screenshot) || $report->screenshot=="ERROR") : ?>
							<a href="<?=$report->url; ?>" target="_blank"><img src="<?php echo base_url(); ?>static/screenshot-thumb.jpg" alt="<? printf(_('Captura de %s'), $report->title); ?>"  title="karma <?= $report->karma ?> / coef <?= $report->karma_value ?> / valor <?= $report->karma*$report->karma_value?>"/></a>
						<? else : ?>
							<a href="<?=$report->url; ?>" target="_blank"><img src="<?=base_url('images/sources/thumb-home-' . $report->id . '.png'); ?>" width="150" alt="<? printf(_('Captura de %s'), $report->title); ?>"  title="karma <?= $report->karma ?> / coef <?= $report->karma_value ?> / valor <?= $report->karma*$report->karma_value?>"/></a>
						<? endif; ?>
						<div class="clearfix fix_reports_counters">
							<div class="fixes"><span class="count"><?= $report->votes_count; ?></span> <? _e('fixes'); ?></div>
							<div class="reports"><span class="count"><?= count($report->data); ?></span> <? _e('reportes'); ?></div>
						</div>
					</div>
					<h2 class="title"><a href="<?= site_url($this->router->reverseRoute('reports-view', array('slug' => $report->slug))); ?>"><?=$report->title;?></a></h2>
					<div class="report_meta">
						<p class="authorship"><? _e('Enviado por'); ?> <a href="<?= site_url($this->router->reverseRoute('user-profile', array('username' => $report->user->username))); ?>"><?= $report->user->name; ?></a> <? _e('el'); ?> <?= $report->created_at->format('d/m/Y'); ?></p>
						<p class="source"><? _e('Fuente'); ?>: <a href="<?= site_url($this->router->reverseRoute('source-profile', array('sitename' => $report->site))); ?>"><?= $report->site; ?></a></p>
						<? if ($report->has_subreport()) : ?>
						<p class="popular type_<?= preg_replace('/[^a-z0-9]+/i','-',strtolower($report->data[0]->type));?>">Reporte popular: <a href="<?= site_url($this->router->reverseRoute('reports-view', array('slug' => $report->slug))); ?>/#report-<?= $report->data[0]->id; ?>"><?= $report->data[0]->title; ?></a></p>
						<? endif; ?>
					</div>
				</article>
			<? endforeach; ?>
		</section>
		<div class="pagination clearfix"><?=$pagination_links;?></div>
	</div>
	<?php $this->load->view('includes/sidebar'); ?>
</div>
