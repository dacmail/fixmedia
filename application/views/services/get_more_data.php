<div class="report_data">
	<p><label class="label">Elige el tipo de reporte</label> 
		<div class="wrap_types clearfix">
		<? foreach ($reports_types_tree as $report_type) : ?>
			<span class="wrap_type">
				<input data-count="<?=$count;?>" data-service="<?php echo site_url('services/get_subtypes_select'); ?>" type="radio" name="type[2]" class="main_type_radio" id="type_<?=$report_type->id;?>_<?=$count;?>" value="<?=$report_type->id;?>" /> 
				<label for="type_<?=$report_type->id;?>_<?=$count;?>"><?=$report_type->type;?></label>
			</span>
		<? endforeach; ?>
		</div>
	</p>
	<div class="fields_wrap" id="fields_<?=$count;?>"></div>
</div>