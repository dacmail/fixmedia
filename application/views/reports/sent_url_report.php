<div id="container" class="sending_url">
	<div id="content">
		<h1 class="title"><?=$report->title?></h1>
		<? $hidden_fields = array('report_id' => $report->id, 'report_url' => $report->url, 'report_title' => $report->title, 'site' => $report->site); ?>
		<?php echo form_open($this->router->reverseRoute('reports-send' , array('id' => $report->id)), '', $hidden_fields) ?>
			<input class="submit button" type="submit" name="submit" value="o ¡comienza tu mismo!" /> 
		</form>
	</div>
</div>