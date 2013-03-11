
<div class="row wrap_title">
	<label class="label" for="title"><? _e('¿Qué quieres arreglar?'); ?> <span class="tip"><? _e('Dilo en un titular, recuerda que al final puedes seguir añadiendo reportes a esta misma noticia'); ?></span></label>
	<input type="text" id="title_<?=$count;?>" name="title[]"  class="text" maxlength="120" />
	<span class="help">
		<? if ($type==1) : ?>
		<? _e('Esto es lo primero que verán el resto de usuarios, es importante titular bien: destaca en una frase la esencia de tu corrección.'); ?>
		<? else : ?>
		<? _e('Esto es lo primero que verán el resto de usuarios, es importante titular bien: destaca en una frase la esencia de tu ampliación.'); ?>
		<? endif ?>
		<span class="charcount">120</span>
	</span>

</div>
<div class="row wrap_content">
	<label class="label" for="content"><? _e('Explícalo'); ?> <span class="tip"><? _e('Si es necesario'); ?></span></label>
	<textarea class="textarea" id="content_<?=$count;?>" name="content[]" maxlength="400"></textarea>
	<div class="help">
		<? if ($type==1) : ?>
		<? _e('Identifica en breves palabras la parte de la noticia que consideras que debe ser corregida, por qué debe serlo y cuál es tu alternativa.'); ?>
		<? else : ?>
		<? _e('Identifica en breves palabras por qué crees que a esta noticia la falta más contenido y cuál es.'); ?>
		<? endif ?>
		<span class="charcount">400</span>
	</div>

</div>
<div class="row wrap_urls">
	<label class="label" for="urls"><? _e('Fuentes o archivos'); ?> <span class="tip"><? _e('Si es necesario añadie URL a fuentes directas, otras noticias, enlaces, etc.'); ?></span></label>
	<input type="text" class="urls text" id="urls_<?=$count;?>" name="urls[<?=$count;?>][]" placeholder="http://"/>
	<span class="help">
		<? if ($type==1) : ?>
		<? _e('Por ejemplo, un enlace a otra noticia sobre el mismo asunto o un enlace a un documento, fotografía o archivo que justifiquen tu corrección.'); ?>
		<? else : ?>
		<? _e('Por ejemplo, un enlace a otra noticia sobre el mismo asunto pero más completa o un enlace a un documento, fotografía, gráfico o archivo que contengan la ampliación.'); ?>
		<? endif ?>
	</span>
	<a href="#" class="add_url"><? _e('Agregar otra URL'); ?></a>
</div>

<div class="row wrap_type_info">
	<label class="label" for="type_info"><? _e('Clasifica tu reporte'); ?> <span class="tip"><? _e('Ayuda a la comunidad a comprender rápidamente cual es el problema en esta noticia'); ?></span></label>
			<p class="option clearfix checked"><input type="radio" name="type_info[<?=$count;?>]" value="0" id="type0-<?=$count;?>" checked /><label for="type0-<?=$count;?>"><? _e('Ninguna'); ?></label></p>
	<? foreach ($reports_types as $report_type) : ?>
			<p class="option clearfix"><input type="radio" name="type_info[<?=$count;?>]" value="<?=$report_type->id; ?>" id="type<?=$report_type->id; ?>-<?=$count;?>" /><label for="type<?=$report_type->id; ?>-<?=$count;?>"><?=$report_type->type;?></label></p>
	<? endforeach; ?>
	<span class="help">
		<? if ($type==1) : ?>
			<? _e('Escoge la opción que mejor se ajuste al tipo de corrección que deseas realizar sobre esta noticia.'); ?>
		<? else : ?>
			<? _e('Escoge la opción que mejor se ajuste al tipo de ampliación que deseas realizar sobre esta noticia.'); ?>
		<? endif ?>
	</span>
</div>