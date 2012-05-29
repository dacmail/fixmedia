<ul>
	<? foreach ($reports as $report) : ?>
		<li><?= anchor($this->router->reverseRoute('reports-view', array('slug' => $report->slug)), $report->title); ?></li>
	<? endforeach; ?>
</ul>