<p class="row wrap_type_info">
	<label class="label" for="type_info">Selecciona una opción: </label>
	<select class="select" size="<?=count($reports_types);?>" name="type_info[]" id="type_info_<?=$count;?>">
		<? foreach ($reports_types as $report_type) : ?>
			<option value="<?=$report_type->id; ?>">- <?=$report_type->type;?></option>
		<? endforeach; ?>
	</select>
	<span class="help">A magna risus a adipiscing, ac? Ridiculus facilisis, urna auctor? Dapibus ridiculus pid, vut ac purus, turpis nascetur integer enim mattis. Nisi, tristique, rhoncus nunc odio pulvinar phasellus</span>
</p>
<p class="row wrap_content">
	<label class="label" for="content">Explica tu corrección o ampliación</label>
	<textarea class="textarea" id="content_<?=$count;?>" name="content[]" maxlength="350"></textarea>
	<span class="help">A magna risus a adipiscing, ac? Ridiculus facilisis, urna auctor? Dapibus ridiculus pid, vut ac purus, turpis nascetur integer enim mattis. Nisi, tristique, rhoncus nunc odio pulvinar phasellus</span>

</p>
<p class="row wrap_urls">
	<label class="label" for="urls">Añade una URL a la fuente de tu correción o al archivo de tu ampliación</label>
	<input type="text" class="urls text" id="urls_<?=$count;?>" name="urls[<?=$count;?>][]" placeholder="http://"/>
	<span class="help">A magna risus a adipiscing, ac? Ridiculus facilisis, urna auctor? Dapibus ridiculus pid, vut ac purus, turpis nascetur integer enim mattis. Nisi, tristique, rhoncus nunc odio pulvinar phasellus</span>
	<a href="#" class="add_url">Agregar otra URL</a>
</p>
<p class="row wrap_title">
	<label class="label" for="title">Titula esta aportación</label>
	<input type="text" id="title_<?=$count;?>" name="title[]"  class="text" />
	<span class="help">A magna risus a adipiscing, ac? Ridiculus facilisis, urna auctor? Dapibus ridiculus pid, vut ac purus, turpis nascetur integer enim mattis. Nisi, tristique, rhoncus nunc odio pulvinar phasellus</span>

</p>