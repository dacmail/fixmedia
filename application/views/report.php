<div id="container" class="sending report columns">
	<div id="content">
		<h1 class="title"><?=$report->title;?></h1>
		<? $count=1; foreach ($report->data as $subreport) :  ?>
			<div class="subreport">
				<p class="subreport_type type<?=$subreport->type;?>"><?=$subreport->type_info;?> </p>
				<div class="clearfix">
					<span class="counter"><?=$count;?></span>
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
	</div>

	<aside id="sidebar">
		<div class="counter"><span class="count">000</span> personas quieren mejorar así esta noticia</div>
		<p class="url_sent"><a href="<?=$report->url; ?>" target="blank">Ir a la noticia original</a></p>

		<img src="<?php echo base_url(); ?>fakes/screenshot.gif" alt="Captura de <?=$report->title;?>" />
	</aside>
</div>
