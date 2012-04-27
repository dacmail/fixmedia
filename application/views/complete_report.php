<h1>Paso 2: Completa tu reporte</h1>

<div class="validation_errors">
	<?php echo validation_errors(); ?>	
</div>

<?php echo form_open('reports/view') ?>
	<p>Estás reportando la dirección: <?=$url_sent?> | <?=$url_title?></p>
	<p><label>Elige el tipo de reporte</label> 
		<? foreach ($reports_types_tree as $report_type) : ?>
		<input type="radio" name="type" id="type_<?=$report_type->report_type_id;?>" value="<?=$report_type->report_type_id;?>" /> 
		<label for="type_<?=$report_type->report_type_id;?>"><?=$report_type->type;?></label>
		<? endforeach; ?>
	</p>
		<? foreach ($reports_types_tree as $report_type) : ?>
			<div class="subtype_list" id="subtype_<?=$report_type->report_type_id;?>">
			<select size="<?=count($report_type->childrens);?>" name="subtype" id="subtype_<?=$report_type->report_type_id;?>">
				<? foreach ($report_type->childrens as $children) : ?>
					<option value="<?=$children->report_type_id; ?>"><?=$children->type;?></option>
				<? endforeach; ?>
			</select>
			</div>
		<? endforeach; ?>
	<input type="submit" name="submit" value="Veamos como queda" /> 
</form>