<div id="container" class="sending columns">
	<div id="content">
		<p class="step">Paso 2 de 3: Modifica tu reporte</p>
		<h1 class="title"><?=$report['report_title']?></h1>

		<? $hidden_fields = array('report_url' => $report['report_url'], 'report_title' => $report['report_title'], 'site' => $report['site']); ?>
		<?php echo form_open($this->router->reverseRoute('reports-preview'), '', $hidden_fields) ?>
			<? foreach ($report['type'] as $index => $type) : $count=$index+1;?>
				<div class="report_data">
					<p><label class="label">Elige el tipo de reporte</label>
					<div class="wrap_types clearfix">
					<? foreach ($reports_types_tree as $report_type) : ?>
						<span class="wrap_type <? echo (($type==$report_type->id) ? 'active' : '');?>">
							<input data-count="<?=$count?>" data-service="<?php echo site_url('services/get_subtypes_select'); ?>" type="radio" name="type[<?=$count?>]" class="main_type_radio" id="type_<?=$report_type->id;?>" value="<?=$report_type->id;?>"  <? echo (($type==$report_type->id) ? 'checked' : '');?>/> 
							<label for="type_<?=$report_type->id;?>"><?=$report_type->type;?></label>
						</span>
						<? if ($type==$report_type->id) { $selected_type=$report_type; } ?>
					<? endforeach; ?>
					</div>
					</p>
					<div class="fields_wrap open" id="fields_<?=$count;?>">
						<p>
							
							<label class="label" for="type_info">Selecciona una opción: </label>
							<select class="select" size="<?=count($report_type->childrens);?>" name="type_info[]" id="type_info_<?=$count;?>">
								<? foreach ($selected_type->childrens as $children) : ?>
										<option <? echo (($report['type_info'][$index]==$children->id) ? 'selected="selected"' : ''); ?> value="<?=$children->id; ?>"><?=$children->type;?></option>
								<? endforeach; ?>
							</select>
						</p>
						<p>
							<label class="label" for="content">Explica tu corrección o ampliación</label>
							<textarea class="textarea" id="content_<?=$count;?>" name="content[]" maxlength="350"><?=$report['content'][$index];?></textarea>
						</p>
						<p>
							<label class="label" for="urls">Añade una URL a la fuente de tu correción o al archivo de tu ampliación</label>
							<? foreach ($report['urls'][$index] as $url) : ?>
								<input type="text" class="urls text" id="urls_<?=$count;?>" name="urls[<?=$count;?>][]" value="<?=$url?>"/>
							<? endforeach; ?>
							<? if (count($report['urls'][$index])<3) : ?><a href="#" class="add_url">Agregar otra URL</a><? endif; ?>
						</p>
						<p>
							<label class="label" for="title">Titula esta aportación</label>
							<input class="text" type="text" id="title_<?=$count;?>" name="title[]" value="<?=$report['title'][$index];?>" />
						</p>

					</div>
				</div>
			<? endforeach; ?>
			<a href="#" id="add_more" data-service="<?php echo site_url('services/get_more_data'); ?>" class="add">+ Añadir otra corrección/ampliación</a>
			<input type="submit" class="button submit" name="submit" value="Veamos como queda" /> 
		</form>
	</div>

	<aside id="sidebar">
		<div class="counter"><span class="count">000</span> personas quieren mejorar así esta noticia</div>
		<p class="url_sent"><a href="<?=$report['report_url']?>" target="blank">Ir a la noticia original</a></p>

		<img src="<?php echo base_url(); ?>fakes/screenshot.gif" alt="Captura de <?=$report['report_title']?>" />
	</aside>
</div>