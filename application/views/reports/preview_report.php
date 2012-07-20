
<div id="container" class="sending report columns">
	<div id="content">
		<section class="report_info clearfix">
			<div class="screenshot">
				<img src="<?php echo base_url(); ?>fakes/screenshot-thumb.jpg" alt="Captura de <?=$report_sent->title;?>" />
				<a class="url_sent" href="<?=$report_sent->url; ?>" target="blank">Ver noticia original</a>
			</div>
			<h1 class="title"><?=$report_sent->title;?></h1>
			<div class="report_meta">
				<p class="authorship">Enviado por <?= $report_sent->user->username; ?> el <?= $report_sent->created_at->format('d/m/Y'); ?></p>
				<p class="source">Fuente: <?= $report_sent->site; ?></p>
			</div>
		</section>
		<? $count=1; foreach ($report['type_info'] as $index => $type) :  ?>
			<div class="subreport">
				<p class="subreport_type type<? echo ($types[$index]->parent_type ? $types[$index]->parent_type->id : $types[$index]->id);?>"><?=$types[$index]->type;?> </p>

				<div class="clearfix">
					<span class="counter"><?=$count;?></span>
					<div class="subreport_info">
						<h3 class="subreport_title"><?=$report['title'][$index]; ?></h3>
						<a href="#" class="toggle_info">Mostrar u ocultar detalles y fuentes</a>
						<div class="subreport_content">
							<?=$report['content'][$index];?>
							<h4 class="subreport_urls">Fuentes:</h4>
							<? foreach($report['urls_decode'][$index] as $url) : ?>
							<a href="<?=$url?>" target="_blank" class="source"><?=$url; ?></a>
							<? endforeach; ?>
						</div>
					</div>
				</div>
			</div>
		<? $count++; endforeach; ?>

		<? $hidden_fields = form_hidden(array_merge($report, array('edit_draft' => true))); ?>
		<?php echo form_open($this->router->reverseRoute('reports-send', array('id' => $report['report_id'])), '') ?>
			<? echo $hidden_fields; ?>
			<input type="submit" name="submit" class="edit" value="&larr; Hacer modificaciones" /> 
		<? echo form_close(); ?>

		<?php echo form_open($this->router->reverseRoute('reports-save'), '') ?>
			<? echo $hidden_fields; ?>
			<input type="submit" name="submit" class="button submit" value="Enviar reporte" /> 
		<? echo form_close(); ?>		
	</div>

	<aside id="sidebar">
		<div class="counter"><span class="count count-vote-<?= $report_sent->id ?>"><?= $report_sent->votes_count ?></span> quieren mejorar así esta noticia</div>
	</aside>
</div>
