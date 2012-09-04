<div id="container" class="clearfix sending report columns">
	<div id="content">
		<?php $this->load->view('includes/report-info'); ?>
		<h2 class="action_title"><strong>¿Qué es mejorable en esta noticia?</strong> Listado de reportes recibidos</h2>
		<? $count=1; foreach ($report->data as $subreport) :  ?>
			<div class="subreport">
				<div class="clearfix">
					<span class="counter">
						<strong class="count-vote-up-<?= $subreport->id ?> count-vote-down-<?= $subreport->id ?>"><?= $subreport->votes_count ?></strong>
						<div class="votes_buttons clearfix">
							<? if ($logged_in && !$subreport->is_voted($the_user->id)) : ?>
							<a href="<?php echo site_url(array('services/report_vote', $the_user->id ,$subreport->id, 1)); ?>" id="vote-up-<?= $subreport->id ?>" class="report_vote up clearfix vote-<?= $subreport->id ?>">+</a>
							<? endif; ?>
							<? if ($logged_in && !$subreport->is_voted($the_user->id)) : ?>
								<a href="<?php echo site_url(array('services/report_vote', $the_user->id ,$subreport->id, -1)); ?>" id="vote-down-<?= $subreport->id ?>" class="report_vote down clearfix vote-<?= $subreport->id ?>">-</a>
							<? endif; ?>
						</div>

					</span>
					<div class="subreport_info">
						<h3 class="subreport_title"><?=$subreport->title; ?></h3>
						<p class="authorship">Enviado por <a href="<?= site_url($this->router->reverseRoute('user-profile', array('username' => $subreport->user->name))); ?>"><?= $subreport->user->name; ?></a> el <?= $subreport->created_at->format('d/m/Y'); ?></p>
						<p class="clearfix subreport_types type_<?=$subreport->type;?>">
							<span class="type"><?=$subreport->type;?></span> 
							<? if ($subreport->type_info!=$subreport->type) : ?>
							<span class="type_info" title="<?= $subreport->type_info; ?>"><?= character_limiter($subreport->type_info,50); ?></span>
							<? endif; ?> 
						</p>
						<? if (!empty($subreport->content) || !empty($subreport->urls[0])) : ?>
						<a href="#" class="toggle_info show">Mostrar detalles y fuentes</a>
						<div class="subreport_content">
							<?=$subreport->content;?>
							<? if (count(array_filter($subreport->urls))>0) : ?>
								<h4 class="subreport_urls">Fuentes:</h4>
								<? foreach($subreport->urls as $url) : ?>
								<a href="<?=$url?>" target="_blank" class="source"><?=$url; ?></a>
								<? endforeach; ?>
							<? endif; ?>
						</div>
						<? endif; ?>
					</div>
				</div>
			</div>
		<? $count++; endforeach; ?>
		
		
	</div>

	<aside id="sidebar">
		<div class="counter">
			<span class="count count-vote-<?= $report->id ?>"><?= $report->votes_count ?></span> 
			<? if ($report->votes_count==1 && ($logged_in && $report->is_voted($the_user->id))) : ?>
			persona (tu) quiere que alguien la arregle
			<? elseif ($report->votes_count==1) :?>
			persona quiere que alguien la arregle
			<? else : ?>
			personas  quieren que alguien la arregle
			<? endif; ?>
			<span class="action-title">¿Qué quieres hacer con ella ahora?</span>
		</div>
		<? if ($logged_in && !$report->is_voted($the_user->id)) : ?>
			<a href="<?php echo site_url(array('services/fix_vote',$report->id)); ?>" id="vote-<?= $report->id ?>" class="button icon fixit fix_vote">
				FIX <span class="subtitle">Yo también quiero que la arreglen</span>	
			</a>			
		<? elseif (!$logged_in) : ?>
			<a href="<?php echo base_url("index.php/auth/login"); ?>" id="vote-<?= $report->id ?>" class="button icon fixit">
				FIX <span class="subtitle">Yo también quiero que la arreglen</span>	
			</a>
		<? endif; ?>
	
		<a href="<?= site_url($this->router->reverseRoute('reports-view', array('slug' => $report->slug))); ?>" class="button icon share">
			Compártela <span class="subtitle">Para arreglarla entre todos</span>
			</a>

		<a href="<?= site_url($this->router->reverseRoute('reports-send' , array('id' => $report->id))); ?>" class="button icon add_report">
			Arréglala <span class="subtitle">Añade tu propio reporte</span>	
			</a>
		
	</aside>
</div>
