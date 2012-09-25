<div id="container" class="clearfix profile source columns">
	<div id="content">
		<section class="user_info clearfix">
			  <img src="<?php echo base_url(); ?>static/avatar-source.jpg" width="150" alt="Imagen de <?=$site;?>" />
			  <div class="data">
			  		<h1 class="name"><?= $site; ?> </h1>
			  		<p class="bio"><?= $url_data['description']; ?></p>
			  </div>
		</section>
		<section class="tabs">
			<ul class="tabs_items">
				<li><a href="#stats">Estadísticas</a></li>
				<li class="<?= (($page>1) ? 'ui-tabs-selected' : ''); ?>"><a href="#fixes">Noticias de <?= $site; ?></a></li>
			</ul>
			<div id="stats">
				<script type="text/javascript" src="https://www.google.com/jsapi"></script>
			    <script type="text/javascript">
			    	google.load('visualization', '1.0', {'packages':['corechart']});
					google.setOnLoadCallback(draw_charts);
					function fix_vs_report() {
						var data = new google.visualization.DataTable();
						data.addColumn('string', 'Type');
						data.addColumn('number', 'Count');
						data.addRows([
						<? foreach ($report_types as $type) :?>
						  ['<?= $type->class; ?>', <?= $type->cont; ?>],
						<? endforeach; ?>
						]);
						var options = { chartArea : {
						               		width:250,
						               		height:170,
						               		top: 0,
						               		left: 10
						               }};

						var chart = new google.visualization.PieChart(document.getElementById('fix_vs_rep'));
						chart.draw(data, options);
					}
					function actions_by_month() {
						var data = google.visualization.arrayToDataTable([
							['Mes', 'Fixes', 'Reportes'],
							<? foreach ($actions_by_month as $mes => $action) :?>
								[<?= "'".date('F', mktime(0,0,0,$mes,1))."'";?>,<?= isset($action['fixes']) ? $action['fixes'] : 0; ?>,<?= isset($action['reports']) ? $action['reports'] : 0; ?>],
							<? endforeach; ?>
							]);

						var options = { chartArea : {
						               		width:250,
						               		height:140,
						               		top: 0,
						               		left: 10
						               }};

						var chart = new google.visualization.LineChart(document.getElementById('actions_by_month'));
						chart.draw(data, options);
					}

					function draw_charts() {
						fix_vs_report();
						actions_by_month();
						//fixes_by_sources();
					}
			    </script>
			    <div class="chart_wrap clearfix">
			    	<div class="chart" id="fix_vs_rep"></div>
			    	<div class="explanation">
			    		<h3 class="title">Tipos de reportes</h3>
			    		<p class="hint">¿Se equivoca mucho o se queda corto? Este gráfico de tarta nos indica si los reportes que está recibiendo esta fuente son más correcciones o ampliaciones. </p>
			    	</div>
			    </div>
			 	<div class="chart_wrap clearfix">
			    	<div class="chart" id="actions_by_month"></div>
			    	<div class="explanation">
			    		<h3 class="title">Actividad por meses</h3>
			    		<p class="hint">¿En qué momentos recibe esta fuente más fixes y/o más reportes? Este gráfico temporal nos lo muestra.</p>
			    	</div>
			    </div>
			</div>
			<div class="reports_list" id="fixes">
			<? foreach ($reports as $report) : ?>
				<article class="report_info clearfix vote-<?=$report->id;?>">
					<div class="screenshot">
						<? if (is_null($report->screenshot) || $report->screenshot=="ERROR") : ?>
							<img src="<?php echo base_url(); ?>static/screenshot-thumb.jpg" alt="Captura de <?=$report->title;?> "  title="karma <?= $report->karma ?> / coef <?= $report->karma_value ?> / valor <?= $report->karma*$report->karma_value?>"/>
						<? else : ?>
							<img src="<?=base_url('images/sources/thumb-home-' . $report->id . '.png'); ?>" width="150" alt="Captura de <?=$report->title;?> "  title="karma <?= $report->karma ?> / coef <?= $report->karma_value ?> / valor <?= $report->karma*$report->karma_value?>"/>
						<? endif; ?>
						<div class="clearfix fix_reports_counters">
							<div class="fixes"><span class="count"><?= $report->votes_count; ?></span> fixes</div>
							<div class="reports"><span class="count"><?= count($report->data); ?></span> reportes</div>
						</div>
					</div>
					<h2 class="title"><a href="<?= site_url($this->router->reverseRoute('reports-view', array('slug' => $report->slug))); ?>"><?=$report->title;?></a></h2>
					<div class="report_meta">
						<p class="authorship">Enviado por <a href="<?= site_url($this->router->reverseRoute('user-profile', array('username' => $report->user->username))); ?>"><?= $report->user->name; ?></a> el <?= $report->created_at->format('d/m/Y'); ?></p>
						<p class="source">Fuente: <a href="<?= site_url($this->router->reverseRoute('source-profile', array('sitename' => $report->site))); ?>"><?= $report->site; ?></a></p>
					</div>
				</article>
			<? endforeach; ?>
			<div class="pagination clearfix"><?=$pagination_links;?></div>
			</div>

		</section>
	</div>
	<?php $this->load->view('includes/sidebar-source'); ?>
</div>