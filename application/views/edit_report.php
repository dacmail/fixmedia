<h1><?=$page_title;?></h1>

<? $hidden_fields = array('report_url' => $report['report_url'], 'report_title' => $report['report_title']); ?>
<?php echo form_open($this->router->reverseRoute('reports-preview'), '', $hidden_fields) ?>
	<p>Estás reportando la dirección: <?=$report['report_url'];?> | <?=$report['report_title'];?></p>


	<? foreach ($report['type'] as $index => $type) : $count=$index+1;?>
		<div class="report_data">
			<p><label>Elige el tipo de reporte</label> 
			<? foreach ($reports_types_tree as $report_type) : ?>
				<input data-count="<?=$count?>" data-service="<?php echo site_url('services/get_subtypes_select'); ?>" type="radio" name="type[<?=$count?>]" class="main_type_radio" id="type_<?=$report_type->id;?>" value="<?=$report_type->id;?>"  <? echo (($type==$report_type->id) ? 'checked' : '');?>/> 
				<label for="type_<?=$report_type->id;?>"><?=$report_type->type;?></label>
				<? if ($type==$report_type->id) { $selected_type=$report_type; } ?>
			<? endforeach; ?>
			</p>
			<div class="fields_wrap" id="fields_<?=$count;?>">
				<p>
					
					<label for="type_info">Selecciona una opción: </label>
					<select size="<?=count($report_type->childrens);?>" name="type_info[]" id="type_info_<?=$count;?>">
						<? foreach ($selected_type->childrens as $children) : ?>
								<option <? echo (($report['type_info'][$index]==$children->id) ? 'selected="selected"' : ''); ?> value="<?=$children->id; ?>"><?=$children->type;?></option>
						<? endforeach; ?>
					</select>
				</p>
				<p>
					<label for="content">Explica tu corrección o ampliación</label>
					<textarea id="content_<?=$count;?>" name="content[]" maxlength="350"><?=$report['content'][$index];?></textarea>
				</p>
				<p>
					<label for="urls">Añade una URL a la fuente de tu correción o al archivo de tu ampliación</label>
					<? foreach ($report['urls'][$index] as $url) : ?>
						<input type="text" class="urls" id="urls_<?=$count;?>" name="urls[<?=$count;?>][]" value="<?=$url?>"/>
					<? endforeach; ?>
					<? if (count($report['urls'][$index])<3) : ?><a href="#" class="add_url">Agregar otra URL</a><? endif; ?>
				</p>
				<p>
					<label for="title">Titula esta aportación</label>
					<input type="text" id="title_<?=$count;?>" name="title[]" value="<?=$report['title'][$index];?>" />
				</p>

			</div>
		</div>
	<? endforeach; ?>
	






	<a href="#" id="add_more" data-service="<?php echo site_url('services/get_more_data'); ?>" class="button submit add">Añadir otra corrección/ampliación</a>
	<input type="submit" name="submit" value="Veamos como queda" /> 
</form>