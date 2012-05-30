<div id="container" class="sending clearfix">
	<div id="content">
		<h1 class="title">Enviar nuevo reporte</h1>
		<div class="validation_errors">
			<?php echo validation_errors(); ?>
			<?=$error_url_check ?>
		</div>
		<?php echo form_open($this->router->reverseRoute('reports-send_url')) ?>

			<label class="label" for="title">Url de la noticia</label>
			<input class="text" type="input" placeholder="http://ejemplo.com/noticia.html" name="url" /><br />

			<input class="submit button" type="submit" name="submit" value="Siguiente" /> 

		</form>
	</div>
</div>	

