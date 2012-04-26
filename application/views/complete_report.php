<h1>Paso 2: Completa tu reporte</h1>

<div class="validation_errors">
	<?php echo validation_errors(); ?>	
</div>

<?php echo form_open('reports/view') ?>
	<p>Estás reportando la dirección: <?=$url_sent?> | <?=$url_title?></p>
	<p><label>Elige el tipo de reporte</label> 
	<input type="radio" name="type" id="correccion" value="correccion" /> <label for="correccion">Corrección</label>
	<input type="radio" name="type" id="ampliacion" value="ampliacion" /> <label for="ampliacion">Ampliación</label>
	</p>

	<input type="submit" name="submit" value="Veamos como queda" /> 
</form>