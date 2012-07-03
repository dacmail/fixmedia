
<div id="container" class="sending report columns">
	<div id="content">
		<p class="step">Paso 3 de 3: Confirma tu reporte</p>
		<h1 class="title"><?=$report['report_title'];?></h1>
		<h1></h1>
		<? $count=1; foreach ($report['type_info'] as $index => $type) :  ?>
			<div class="subreport">
				<p class="subreport_type type<?=$types[$type]->parent_type->id;?>"><?=$types[$type]->type;?> </p>
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
		<?php echo form_open($this->router->reverseRoute('reports-send'), '', array_merge($report,array('edit_draft' => true))) ?>
			<input type="submit" name="submit" class="add" value="&larr; Hacer modificaciones" /> 
		</form>

		<?php echo form_open($this->router->reverseRoute('reports-save'), '', $report) ?>
			<input type="submit" name="submit" class="button submit" value="Enviar reporte" /> 
		</form>		
	</div>

	<aside id="sidebar">
		<div class="counter"><span class="count">000</span> personas quieren mejorar así esta noticia</div>
		<p class="url_sent"><a href="<?=$report['report_url'];?>" target="blank">Ir a la noticia original</a></p>

		<img src="<?php echo base_url(); ?>fakes/screenshot.jpg" alt="Captura de <?=$report['report_title'];?>" />
	</aside>
</div>
