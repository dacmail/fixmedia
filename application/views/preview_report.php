<h1>Confirma tu reporte</h1>
<div>
	<h2><?=$report['report_title'];?></h2>
	<p><?=$report['report_url'];?></p>
	<hr />
	<? foreach ($report['type_info'] as $index => $type) : ?>
		<p>[<?=$types[$type]->parent_type->type;?>] <?=$types[$type]->type;?> </p>
		<h3><?=$report['title'][$index]; ?></h3>
		<p><?=$report['content'][$index]; ?></p>
		<hr/>
	<? endforeach; ?>
	<?php echo form_open($this->router->reverseRoute('reports-send_url'), '', array_merge($report,array('edit_draft' => true))) ?>
		<input type="submit" name="submit" value="Hacer modificaciones" /> 
	</form>

	<?php echo form_open($this->router->reverseRoute('reports-save'), '', $report) ?>
		<input type="submit" name="submit" value="Enviar reporte" /> 
	</form>
</div>
