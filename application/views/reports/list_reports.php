<div id="container" class="clearfix columns">
	<div id="content">
		<h1 class="title">Más urgentes</h1>
		<p class="sub_title sep">Noticias con más personas solicitando que alguien las arregle</p>
		<section class="reports_list">
			<? foreach ($reports as $report) : ?>
				<article class="report_info clearfix">
					<div class="screenshot">
						<img src="<?php echo base_url(); ?>fakes/screenshot-thumb.jpg" width="150" alt="Captura de <?=$report->title;?>" />
						<div class="clearfix fix_reports_counters">
							<div class="fixes"><span class="count"><?= $report->votes_count; ?></span> fixes</div>
							<div class="reports"><span class="count"><?= count($report->data); ?></span> reportes</div>
						</div>
					</div>
					<h1 class="title"><a href="<?= site_url($this->router->reverseRoute('reports-view', array('slug' => $report->slug))); ?>"><?=$report->title;?></a></h1>
					<div class="report_meta">
						<p class="authorship">Enviado por <?= $report->user->username; ?> el <?= $report->created_at->format('d/m/Y'); ?></p>
						<p class="source">Fuente: <?= $report->site; ?></p>
					</div>
				</article>
			<? endforeach; ?>
		</section>
		<div class="pagination clearfix"><?=$pagination_links;?></div>
	</div>
	<?php $this->load->view('includes/sidebar'); ?>
</div>
