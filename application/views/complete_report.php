<h1>Paso 2: Completa tu reporte</h1>

<div class="validation_errors">
	<?php echo validation_errors(); ?>	
</div>
<? $hidden_fields = array('report_url' => $url_sent, 'report_title' => $url_title); ?>
<?php echo form_open($this->router->reverseRoute('reports-preview'), '', $hidden_fields) ?>
	<p>Estás reportando la dirección: <?=$url_sent?> | <?=$url_title?></p>
	<div class="report_data">
		<p><label>Elige el tipo de reporte</label> 
		<? foreach ($reports_types_tree as $report_type) : ?>
			<input data-count="1" data-service="<?php echo site_url('services/get_subtypes_select'); ?>" type="radio" name="type[1]" class="main_type_radio" id="type_<?=$report_type->id;?>" value="<?=$report_type->id;?>" /> 
			<label for="type_<?=$report_type->id;?>"><?=$report_type->type;?></label>
		<? endforeach; ?>
		</p>
		<div class="fields_wrap" id="fields_1"></div>
	</div>

	<a href="#" id="add_more" data-service="<?php echo site_url('services/get_more_data'); ?>" class="button submit add">Añadir otra corrección/ampliación</a>
	<input type="submit" name="submit" value="Veamos como queda" /> 
</form>