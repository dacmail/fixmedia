<div class="row wrap_type_info">
	<label class="label" for="type_info">Selecciona una opción: </label>
	<? foreach ($reports_types as $report_type) : ?>
			<p class="option clearfix"><input type="radio" name="type_info[<?=$count;?>]" value="<?=$report_type->id; ?>" id="type<?=$report_type->id; ?>-<?=$count;?>" /><label for="type<?=$report_type->id; ?>-<?=$count;?>"><?=$report_type->type;?></label></p>
	<? endforeach; ?>
	<span class="help">
		<? if ($type==1) : ?>
			Escoge la opción que mejor se ajuste al tipo de corrección que deseas realizar sobre esta noticia. [+] aprender más
		<? else : ?>
			Escoge la opción que mejor se ajuste al tipo de ampliación que deseas realizar sobre esta noticia. [+] aprender más
		<? endif ?>
	</span>
</div>
<div class="row wrap_content">
	<label class="label" for="content">Explica tu corrección o ampliación</label>
	<textarea class="textarea" id="content_<?=$count;?>" name="content[]" maxlength="350"></textarea>
	<span class="help">
		<? if ($type==1) : ?>
		Identifica en breves palabras la parte de la noticia que consideras que debe ser corregida, por qué debe serlo y cuál es tu alternativa. [+] aprender más
		<? else : ?>
		Identifica en breves palabras por qué crees que a esta noticia la falta más contenido y cuál es. [+] aprender más
		<? endif ?>
	</span>

</div>
<div class="row wrap_urls">
	<label class="label" for="urls">Añade una URL a la fuente de tu correción o al archivo de tu ampliación</label>
	<input type="text" class="urls text" id="urls_<?=$count;?>" name="urls[<?=$count;?>][]" placeholder="http://"/>
	<span class="help">
		<? if ($type==1) : ?>
		Por ejemplo, un enlace a otra noticia sobre el mismo asunto o un enlace a un documento, fotografía o archivo que justifiquen tu corrección. [+] aprender más
		<? else : ?>
		Por ejemplo, un enlace a otra noticia sobre el mismo asunto pero más completa o un enlace a un documento, fotografía, gráfico o archivo que contengan la ampliación. [+] aprender más
		<? endif ?>
	</span>
	<a href="#" class="add_url">Agregar otra URL</a>
</div>
<div class="row wrap_title">
	<label class="label" for="title">Titula esta aportación</label>
	<input type="text" id="title_<?=$count;?>" name="title[]"  class="text" />
	<span class="help">
		<? if ($type==1) : ?>
		Esto es lo primero que verán el resto de usuarios, es importante titular bien: destaca en una frase la esencia de tu corrección. [+] aprender más
		<? else : ?>
		Esto es lo primero que verán el resto de usuarios, es importante titular bien: destaca en una frase la esencia de tu ampliación. [+] aprender más
		<? endif ?>
	</span>

</div>