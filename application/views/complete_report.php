<h1>Paso 2: Completa tu reporte</h1>

<div class="validation_errors">
	<?php echo validation_errors(); ?>	
</div>
<? $hidden_fields = array('report_url' => $url_sent, 'report_title' => $url_title); ?>
<?php echo form_open('reports/view', '', $hidden_fields) ?>
	<p>Estás reportando la dirección: <?=$url_sent?> | <?=$url_title?></p>
	<p><label>Elige el tipo de reporte</label> 
		<? foreach ($reports_types_tree as $report_type) : ?>
		<input data-service="<?php echo site_url('services/get_subtypes_select'); ?>" type="radio" name="type" class="main_type_radio" id="type_<?=$report_type->report_type_id;?>" value="<?=$report_type->report_type_id;?>" /> 
		<label for="type_<?=$report_type->report_type_id;?>"><?=$report_type->type;?></label>
		<? endforeach; ?>
	</p>
	<div class="fields_wrap">

	</div>
	<input type="submit" name="submit" value="Veamos como queda" /> 
</form>