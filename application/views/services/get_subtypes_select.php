<p>
	<label class="label" for="type_info">Selecciona una opción: </label>
	<select class="select" size="<?=count($reports_types);?>" name="type_info[]" id="type_info_<?=$count;?>">
		<? foreach ($reports_types as $report_type) : ?>
			<option value="<?=$report_type->id; ?>"><?=$report_type->type;?></option>
		<? endforeach; ?>
	</select>
</p>
<p>
	<label class="label" for="content">Explica tu corrección o ampliación</label>
	<textarea class="textarea" id="content_<?=$count;?>" name="content[]" maxlength="350">Contenido por defecto</textarea>
</p>
<p>
	<label class="label" for="urls">Añade una URL a la fuente de tu correción o al archivo de tu ampliación</label>
	<input type="text" class="urls text" id="urls_<?=$count;?>" name="urls[<?=$count;?>][]" value="URL de prueba"/>
	<a href="#" class="add_url">Agregar otra URL</a>
</p>
<p>
	<label class="label" for="title">Titula esta aportación</label>
	<input type="text" id="title_<?=$count;?>" name="title[]"  class="text" value="Titular de prueba" />
</p>