<div id="container" class="clearfix profile columns">
	<div id="content">
		<section class="user_info clearfix">
			  <img src="<?php echo base_url(); ?>fakes/screenshot-med.jpg" width="150" alt="Imagen de <?=$site;?>" />
			  <div class="data">
			  		<h1 class="name"><?= $site; ?> </h1>
			  </div>
		</section>
		<section class="tabs">
			<ul class="tabs_items">
				<li><a href="#stats">Estadísticas</a></li>
				<li class="<?= (($page>1) ? 'ui-tabs-selected' : ''); ?>"><a href="#fixes">Noticias de <?= $site; ?></a></li>
			</ul>
			<div id="stats">	
			 
			</div>
			<div class="reports_list" id="fixes">
			<? foreach ($reports as $report) : ?>
				<article class="report_info clearfix vote-<?=$report->id;?>">
					<div class="screenshot">
						<img src="<?php echo base_url(); ?>fakes/screenshot-thumb.jpg" width="150" alt="Captura de <?=$report->title;?>" />
						<div class="clearfix fix_reports_counters">
							<div class="fixes"><span class="count"><?= $report->votes_count; ?></span> fixes</div>
							<div class="reports"><span class="count"><?= count($report->data); ?></span> reportes</div>
						</div>
					</div>
					<h1 class="title"><a href="<?= site_url($this->router->reverseRoute('reports-view', array('slug' => $report->slug))); ?>"><?=$report->title;?></a></h1>
					<div class="report_meta">
						<p class="authorship">Enviado por <a href="<?= site_url($this->router->reverseRoute('user-profile', array('username' => $report->user->username))); ?>"><?= $report->user->name; ?></a> el <?= $report->created_at->format('d/m/Y'); ?></p>
						<p class="source">Fuente: <a href="#"><?= $report->site; ?></a></p>
					</div>
				</article>
			<? endforeach; ?>
			<div class="pagination clearfix"><?=$pagination_links;?></div>
			</div>

		</section>
	</div>
</div>