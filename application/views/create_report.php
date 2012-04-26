<h1>Enviar nuevo reporte</h1>
<div class="validation_errors">
	<?php echo validation_errors(); ?>
	<?=$error_url_check ?>
</div>
<?php echo form_open('reports/send_url') ?>

	<label for="title">Url de la noticia</label> 
	<input type="input" name="url" /><br />

	<input type="submit" name="submit" value="Siguiente" /> 

</form>