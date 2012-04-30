<p>
	<label for="type_info">Selecciona una opción: </label>
	<select size="<?=count($reports_types);?>" name="type_info[]" id="type_info">
		<? foreach ($reports_types as $report_type) : ?>
			<option value="<?=$report_type->id; ?>"><?=$report_type->type;?></option>
		<? endforeach; ?>
	</select>
</p>
<p>
	<label for="content">Explica tu corrección o ampliación</label>
	<textarea id="content" name="content[]" maxlength="350">Texto por defecto</textarea>
</p>
<p>
	<label for="urls">Añade una URL a la fuente de tu correción o al archivo de tu ampliación</label>
	<input type="text" id="urls" name="urls[]" value="Valor de prueba"/>
</p>
<p>
	<label for="title">Titula esta aportación</label>
	<input type="text" id="title" name="title[]" value="Valor de prueba" />
</p>