<div id="container" class="sending editing columns">
	<div id="content">
		<p class="step">Paso 2 de 3: Modifica tu reporte</p>
		<h1 class="title"><?=$report['report_title']?></h1>
		<? $hidden_fields = array('report_url' => $report['report_url'], 'report_title' => $report['report_title'], 'site' => $report['site']); ?>
		<?php echo form_open($this->router->reverseRoute('reports-preview'), array('id' => 'form_report'), $hidden_fields) ?>
			<? foreach ($report['type'] as $index => $type) : $count=$index+1;?>
				<div class="report_data">
					<p><label class="label">Elige el tipo de reporte</label>
					<div class="wrap_types clearfix">
					<? foreach ($reports_types_tree as $report_type) : ?>
						<span class="wrap_type <? echo (($type==$report_type->id) ? 'active' : '');?>">
							<input data-count="<?=$count?>" data-service="<?php echo site_url('services/get_subtypes_select'); ?>" type="radio" name="type[<?=$count-1;?>]" class="main_type_radio" id="type_<?=$report_type->id;?>" value="<?=$report_type->id;?>"  <? echo (($type==$report_type->id) ? 'checked' : '');?>/> 
							<label for="type_<?=$report_type->id;?>"><?=$report_type->type;?></label>
						</span>
						<? if ($type==$report_type->id) { $selected_type=$report_type; } ?>
					<? endforeach; ?>
					</div>
					</p>
					<div class="fields_wrap open" id="fields_<?=$count;?>">
						<div class="row wrap_type_info">
							
							<label class="label" for="type_info">Selecciona una opción: </label>
							<? foreach ($selected_type->childrens as $children) : ?>
								<p class="<? echo (($report['type_info'][$index]==$children->id) ? 'checked' : ''); ?> option clearfix"><input type="radio" name="type_info[<?=$count-1;?>]" id="type<?=$children->id; ?>-<?=$count-1;?>" value="<?=$children->id; ?>" <? echo (($report['type_info'][$index]==$children->id) ? 'checked' : ''); ?> /><label for="type<?=$children->id; ?>-<?=$count-1;?>"><?=$children->type;?></label></p>
							<? endforeach; ?>
							<span class="help">A magna risus a adipiscing, ac? Ridiculus facilisis, urna auctor? Dapibus ridiculus pid, vut ac purus, turpis nascetur integer enim mattis. Nisi, tristique, rhoncus nunc odio pulvinar phasellus</span>
						</div>
						<div class="row wrap_content">
							<label class="label" for="content">Explica tu corrección o ampliación</label>
							<textarea class="textarea" id="content_<?=$count;?>" name="content[]" maxlength="350"><?=$report['content'][$index];?></textarea>
							<span class="help">A magna risus a adipiscing, ac? Ridiculus facilisis, urna auctor? Dapibus ridiculus pid, vut ac purus, turpis nascetur integer enim mattis. Nisi, tristique, rhoncus nunc odio pulvinar phasellus</span>
						</div>
						<div class="row wrap_urls">
							<label class="label" for="urls">Añade una URL a la fuente de tu correción o al archivo de tu ampliación</label>
							<? if ($report['urls'][$index]) :?>
								<? foreach ($report['urls'][$index] as $url) : ?>
									<input type="text" class="urls text" id="urls_<?=$count;?>" name="urls[<?=$count-1;?>][]" value="<?=$url?>"/>
								<? endforeach; ?>
							<? else : ?>
								<input type="text" class="urls text" id="urls_<?=$count;?>" name="urls[<?=$count-1;?>][]" value=""/>
							<? endif; ?>
							<span class="help">A magna risus a adipiscing, ac? Ridiculus facilisis, urna auctor? Dapibus ridiculus pid, vut ac purus, turpis nascetur integer enim mattis. Nisi, tristique, rhoncus nunc odio pulvinar phasellus</span>
							<? if (count($report['urls'][$index])<3) : ?><a href="#" class="add_url">Agregar otra URL</a><? endif; ?>
						</div>
						<div class="row wrap_title">
							<label class="label" for="title">Titula esta aportación</label>
							<input class="text" type="text" id="title_<?=$count;?>" name="title[]" value="<?=$report['title'][$index];?>" />
							<span class="help">A magna risus a adipiscing, ac? Ridiculus facilisis, urna auctor? Dapibus ridiculus pid, vut ac purus, turpis nascetur integer enim mattis. Nisi, tristique, rhoncus nunc odio pulvinar phasellus</span>
						</div>

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