<div id="container" class="clearfix sending_url columns">
	<div id="content">
		<section class="report_info clearfix">
			<div class="screenshot">
				<img src="<?php echo base_url(); ?>fakes/screenshot-thumb.jpg" alt="Captura de <?=$report->title;?>" />
				<a class="url_sent" href="<?=$report->url; ?>" target="blank">Ver noticia original</a>
			</div>
			<h1 class="title"><?=$report->title;?></h1>
			<p class="report_meta">Fuente: <?= $report->site; ?> | En Fixmedia desde: <?= $report->created_at->format('d/m/Y'); ?></p>
		</section>

		<section class="sending_actions clearfix">
			<h2 class="action_title">Ya has hecho fix a esta noticia. <strong>¿Qué quieres hacer con ella ahora?</strong></h2>
			
			<a href="<?= site_url($this->router->reverseRoute('reports-view', array('slug' => $report->slug))); ?>" class="button icon share">
			Compártela <span class="subtitle">Para arreglarla entre todos</span>
			</a>
			
			<a href="<?= site_url($this->router->reverseRoute('reports-send' , array('id' => $report->id))); ?>" class="button submit icon add_report">
			Arréglala <span class="subtitle">Empieza tú mismo</span>	
			</a>	
		</section>
		
	</div>
	<aside id="sidebar">
		<div class="counter"><span class="count count-vote-<?= $report->id ?>"><?= $report->votes_count ?></span> 
			persona (tu) quiere que alguien la arregle
		</div>
	</aside>
</div>