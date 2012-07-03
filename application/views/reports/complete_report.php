<div id="container" class="sending columns">
	<div id="content">
		<p class="step">Paso 2 de 3: Completa tu reporte</p>
		<h1 class="title"><?=$report->title?></h1>

		<div class="validation_errors">
			<?php echo validation_errors(); ?>	
		</div>
		<? $hidden_fields = array('report_id' => $report->id, 'report_url' => $report->url, 'report_title' => $report->title, 'site' => $report->site); ?>
		<?php echo form_open($this->router->reverseRoute('reports-preview'), array('id' => 'form_report'), $hidden_fields) ?>
			<div class="report_data">
				<p><label class="label">Elige el tipo de reporte</label> 
				<div class="wrap_types clearfix">
				<? foreach ($reports_types_tree as $report_type) : ?>
					<span class="wrap_type">
						<input data-count="1" data-service="<?php echo site_url('services/get_subtypes_select'); ?>" type="radio" name="type[0]" class="main_type_radio" id="type_<?=$report_type->id;?>" value="<?=$report_type->id;?>" /> 
						<label for="type_<?=$report_type->id;?>"><?=$report_type->type;?></label>
					</span>
				<? endforeach; ?>
				</div>
				</p>
				<div class="fields_wrap" id="fields_1"></div>
			</div>

			<a href="#" id="add_more" data-service="<?php echo site_url('services/get_more_data'); ?>" class="add">+ Añadir otra corrección/ampliación</a>
			<input id="submit" type="submit" class="button submit" name="submit" value="Veamos como queda" /> 
		</form>
	</div>

	<aside id="sidebar">
		<div class="counter"><span class="count">000</span> personas quieren mejorar así esta noticia</div>
		<p class="url_sent"><a href="<?=$report->url?>" target="blank">Ir a la noticia original</a></p>

		<img src="<?php echo base_url(); ?>fakes/screenshot.jpg" alt="Captura de <?=$report->title?>" />
	</aside>
</div>