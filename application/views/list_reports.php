<ul>
	<? foreach ($reports as $report) : ?>
		<li><?=$report->title;?></li>
	<? endforeach; ?>
</ul>

<p><? echo anchor($this->router->reverseRoute('reports-create'), 'Añade un nuevo reporte'); ?></p>
