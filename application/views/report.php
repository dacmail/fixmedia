<h1><?=$report->title;?></h1>
<p><?=$report->url;?></p>
<hr />
<div>
	<? foreach($report->data as $subreport) :?>
		<p>[<?=$subreport->type;?>] <?=$subreport->type_info;?> </p>
		<h3><?=$subreport->title; ?></h3>
		<p><?=$subreport->content; ?></p>
		<hr/>
	<? endforeach; ?>
</div>
