<div id="container" class="clearfix sending new clearfix">
	<div id="content">
		<h1 class="title sep">Envía una noticia</h1>
		<?php echo form_open($this->router->reverseRoute('reports-create')) ?>
			<div class="row wrap_create_report">
				<label class="label" for="title">Url de la noticia</label>
				<input class="text" type="input" placeholder="http://ejemplo.com/noticia.html" value="<?php echo set_value('url'); ?>" name="url" /><br />
				<span class="help">Si has leído una noticia que crees que puedes corregir o ampliar, comienza introduciendo aquí su URL</span>
				<?php echo form_error('url', '<span class="error">', '</span>'); ?>
				<? if (!empty($error_url_check)) : ?>
					<span class="error"><?=$error_url_check ?></span>
				<? endif; ?>
			</div>
			<input class="submit button" type="submit" name="submit" value="Siguiente" /> 
		</form>
	</div>
</div>	

