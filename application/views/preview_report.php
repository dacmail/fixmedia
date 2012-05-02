<h1>Confirma tu reporte</h1>
<div>
	<h2><?=$reporte['report_title'];?></h2>
	<p><?=$reporte['report_url'];?></p>
	<hr />
	<? foreach ($reporte['type_info'] as $index => $type) : ?>
		<p>[<?=$types[$type]->parent_type->type;?>] <?=$types[$type]->type;?> </p>
		<h3><?=$reporte['title'][$index]; ?></h3>
		<p><?=$reporte['content'][$index]; ?></p>
		<hr/>
	<? endforeach; ?>
	<?php echo form_open($this->router->reverseRoute('reports-save'), '', $reporte) ?>
		<input type="submit" name="submit" value="Enviar reporte" /> 
	</form>
</div>
