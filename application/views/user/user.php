<div id="container" class="clearfix profile columns">
	<div id="content">
		<section class="user_info clearfix">
			  <?=gravatar( $user->email, 150 )?>
			  <div class="data">
			  		<h1 class="name"><?= $user->username; ?></h1>
			  		<p class="when">Mejorando noticias desde el <?= date('d/m/Y', $user->created_on); ?></p>
			  		<p class="bio"><?= $user->bio ?></p>
			 		<p class="url">Web: <a href="#"><?= $user->url ?></a></p>
			 		<p class="follow">
			 			<a href="https://twitter.com/<?=$user->twitter;?>" class="twitter-follow-button" data-show-count="false" data-lang="es">Seguir a @<?=$user->twitter;?></a>
		<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
			 		</p>
			  </div>
		</section>
		<section class="tabs">
			<ul class="tabs_items">
				<li><a href="#stats">Estadísticas</a></li>
				<li><a href="#fixes">Noticias mejoradas por <?= $user->username; ?></a></li>
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
						  ['Reportes', <?= count($user->subreports); ?>],
						  ['Fixes', <?= count($user->fixes); ?>],
						]);
						var options = {'title':'',
						               'width':320,
						               'height':200};

						var chart = new google.visualization.PieChart(document.getElementById('fix_vs_rep'));
						chart.draw(data, options);
					}
					function other_chart() {
						var data = new google.visualization.DataTable();
						data.addColumn('string', 'Type');
						data.addColumn('number', 'Count');
						data.addRows([
						  ['Reportes', <?= count($user->subreports); ?>],
						  ['Fixes', <?= count($user->fixes); ?>],
						]);
						var options = {'title':'',
						               'width':320,
						               'height':200};

						var chart = new google.visualization.PieChart(document.getElementById('other_chart'));
						chart.draw(data, options);
					}
					function another_chart() {
						var data = new google.visualization.DataTable();
						data.addColumn('string', 'Type');
						data.addColumn('number', 'Count');
						data.addRows([
						  ['Reportes', <?= count($user->subreports); ?>],
						  ['Fixes', <?= count($user->fixes); ?>],
						]);
						var options = {'title':'',
						               'width':320,
						               'height':200};

						var chart = new google.visualization.PieChart(document.getElementById('another_chart'));
						chart.draw(data, options);
					}
					function draw_charts() {
						fix_vs_report();
						other_chart();
						another_chart();
					}
			    </script>


			    <div class="chart_wrap clearfix">
			    	<div class="chart" id="fix_vs_rep"></div>
			    	<div class="explanation">
			    		<h3 class="title"><?= round(count($user->fixes)/count($user->subreports),1); ?> fixes por cada reporte</h3>
			    		<p class="hint">El trozo de texto estándar de Lorem Ipsum usado desde el año 1500 es reproducido debajo para aquellos interesados.</p>
			    	</div>
			    </div>
			    <div class="chart_wrap clearfix">
			    	<div class="chart" id="other_chart"></div>
			    	<div class="explanation">
			    		<h3 class="title"><?= round(count($user->fixes)/count($user->subreports),1); ?> fixes por cada reporte</h3>
			    		<p class="hint">El trozo de texto estándar de Lorem Ipsum usado desde el año 1500 es reproducido debajo para aquellos interesados.</p>
			    	</div>
			    </div>
			    <div class="chart_wrap clearfix">
			    	<div class="chart" id="another_chart"></div>
			    	<div class="explanation">
			    		<h3 class="title"><?= round(count($user->fixes)/count($user->subreports),1); ?> fixes por cada reporte</h3>
			    		<p class="hint">El trozo de texto estándar de Lorem Ipsum usado desde el año 1500 es reproducido debajo para aquellos interesados.</p>
			    	</div>
			    </div>
			    

			</div>
			<div class="reports_list" id="fixes">
			<? foreach ($user->subreports as $subreport) : ?>
				<article class="report_info clearfix">
					<div class="screenshot">
						<img src="<?php echo base_url(); ?>fakes/screenshot-thumb.jpg" width="150" alt="Captura de <?=$subreport->report->title;?>" />
						<div class="clearfix fix_reports_counters">
							<div class="fixes"><span class="count"><?= $subreport->report->votes_count; ?></span> fixes</div>
							<div class="reports"><span class="count"><?= count($subreport->report->data); ?></span> reportes</div>
						</div>
					</div>
					<h1 class="title"><a href="<?= site_url($this->router->reverseRoute('reports-view', array('slug' => $subreport->report->slug))); ?>"><?=$subreport->report->title;?></a></h1>
					<div class="report_meta">
						<p class="authorship">Enviado por <a href="<?= site_url($this->router->reverseRoute('user-profile', array('username' => $subreport->report->user->username))); ?>"><?= $subreport->report->user->username; ?></a> el <?= $subreport->report->created_at->format('d/m/Y'); ?></p>
						<p class="source">Fuente: <?= $subreport->report->site; ?></p>
					</div>
				</article>
			<? endforeach; ?>
			</div>
		</section>
	</div>
	<?php $this->load->view('includes/sidebar-user'); ?>
</div>