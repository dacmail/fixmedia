<div id="container" class="sending report columns">
	<div id="content">
		<section class="report_info clearfix">
			<div class="screenshot">
				<img src="<?php echo base_url(); ?>fakes/screenshot-thumb.jpg" alt="Captura de <?=$report->title;?>" />
				<a class="url_sent" href="<?=$report->url; ?>" target="blank">Ver noticia original</a>
			</div>
			<h1 class="title"><?=$report->title;?></h1>
			<p class="report_meta">Fuente: <?= $report->site; ?> | En Fixmedia desde: <?= $report->created_at->format('d/m/Y'); ?></p>
		</section>
		
		<? $count=1; foreach ($report->data as $subreport) :  ?>
			<div class="subreport">
				<p class="subreport_type type<?=$subreport->type;?>"><?=$subreport->type_info;?> </p>
				<div class="clearfix">
					<span class="counter">
						<? if ($logged_in && !$subreport->is_voted($the_user->id)) : ?>
							<a href="<?php echo site_url(array('services/report_vote', $the_user->id ,$subreport->id, 1)); ?>" id="vote-up-<?= $subreport->id ?>" class="report_vote up clearfix vote-<?= $subreport->id ?>">+</a>
						<? endif; ?>
						<strong class="count-vote-up-<?= $subreport->id ?> count-vote-down-<?= $subreport->id ?>"><?= $subreport->votes_count ?></strong>
						<? if ($logged_in && !$subreport->is_voted($the_user->id)) : ?>
							<a href="<?php echo site_url(array('services/report_vote', $the_user->id ,$subreport->id, -1)); ?>" id="vote-down-<?= $subreport->id ?>" class="report_vote down clearfix vote-<?= $subreport->id ?>">-</a>
						<? endif; ?>
					</span>
					<div class="subreport_info">
						<h3 class="subreport_title"><?=$subreport->title; ?></h3>
						<a href="#" class="toggle_info">Mostrar u ocultar detalles y fuentes</a>
						<div class="subreport_content">
							<?=$subreport->content;?>
							<h4 class="subreport_urls">Fuentes:</h4>
							<? foreach($subreport->urls as $url) : ?>
							<a href="<?=$url?>" target="_blank" class="source"><?=$url; ?></a>
							<? endforeach; ?>
						</div>
					</div>
				</div>
			</div>
		<? $count++; endforeach; ?>
		<? $hidden_fields = array('report_id' => $report->id, 'report_url' => $report->url, 'report_title' => $report->title, 'site' => $report->site); ?>
		<?php echo form_open($this->router->reverseRoute('reports-send' , array('id' => $report->id)), array('class' => 'clearfix'), $hidden_fields) ?>
			<input class="submit button" type="submit" name="submit" value="Realiza una aportación" /> 
		</form>
		<div class="clearfix fixme">
			<h3 class="title">Quiero que lo arreglen</h3>
			<? if ($logged_in && !$report->is_voted($the_user->id)) : ?>
			<a href="<?php echo site_url(array('services/fix_vote', $the_user->id ,$report->id)); ?>" id="vote-<?= $report->id ?>" class="fix_vote fix_button clearfix"> <span class="fix">Fix</span> <span class="counter">Contador <strong class="count-vote-<?= $report->id ?>"><?= $report->votes_count ?></strong></a>
			<? else : ?>
			<span id="vote-<?= $report->id ?>" class="fix_vote fix_button clearfix"> <span class="fix">Fix</span> <span class="counter">Contador <strong class="count-vote-<?= $report->id ?>"><?= $report->votes_count ?></strong></span>
			<? endif; ?>

			<div class="popup">
			 	<p>Al estar Fixmedia todavía en su primera beta, esta funcionalidad aún no está disponible. Esta acción que acabas de hacer (click en "Fix") es la más importante del proceso y tenemos que seguir afinando mucho.</p> 
			 	<p>En alguna versión posterior lo activaremos internamente para probarlo, y podrás ver todo su potencial cuando Fixmedia ya esté en abierto :)</p>
			 	<p><a href="<?=base_url()?>index.php/reporte/nuevo">Reportar otra noticia ahora</a></p>
			</div>
		</div>
	</div>

	<aside id="sidebar">
		<div class="counter"><span class="count count-vote-<?= $report->id ?>"><?= $report->votes_count ?></span> personas quieren mejorar así esta noticia</div>
		<p class="url_sent"><a href="<?=$report->url; ?>" target="blank">Ir a la noticia original</a></p>

		<img src="<?php echo base_url(); ?>fakes/screenshot.jpg" alt="Captura de <?=$report->title;?>" />
	</aside>
</div>
