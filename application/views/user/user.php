<div id="container" class="clearfix profile columns">
	<div id="content">
		<section class="user_info clearfix">
			<div class="gravatar">
				<?=get_avatar( $user, 150); ?>
			  	<? if ($logged_in && $user->id==$the_user->id && !count($user->auth)) : ?>
			  		<a class="change_gravatar" href="http://es.gravatar.com/" target="blank"><? _e('Cambiar gravatar'); ?></a>
			  	<? endif; ?>
			</div>
			<div class="data">
				<h1 class="name"><?= $user->name; ?>
					<? if ($logged_in && $user->id==$the_user->id) : ?>
						<a class="edit_profile_link" href="<?=site_url($this->router->reverseRoute('user-edit'));?>"><? _e('Editar perfil'); ?></a>
					<? endif; ?>
				</h1>
				<p class="when"><? _e('Mejorando noticias desde el'); ?> <?= date('d/m/Y', $user->created_on); ?></p>
				<p class="bio"><?= $user->bio ?></p>
				<? if ($user->url) : ?><p class="url"><? _e('Web'); ?>: <a href="<?= $user->url ?>"><?= $user->url ?></a></p><? endif; ?>
				<? if ($user->twitter) : ?>
				<p class="follow">
					<a href="https://twitter.com/<?=$user->twitter;?>" class="twitter-follow-button" data-show-count="false" data-lang="es"><? _e('Seguir a'); ?> @<?=$user->twitter;?></a>
					<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
				</p>
				<? endif; ?>
			</div>
		</section>
		<section class="tabs">
			<ul class="tabs_items">
				<li><a href="#stats"><? _e('Estadísticas'); ?></a></li>
				<li class="<?= (($page>1) ? 'ui-tabs-selected' : ''); ?>"><a href="#fixes"><? printf(_('Noticias mejoradas por %'), $user->name); ?></a></li>
				<? if ($logged_in && $user->id==$the_user->id) : ?>
				<li><a data-ajax="false" href="<?=site_url($this->router->reverseRoute('user-activity'));?>"><? _e('Actividad'); ?> <? if (count($the_user->unread_activity)) : ?> (<?= count($the_user->unread_activity); ?>)<? endif; ?></a></li>
				<? endif; ?>
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
						var options = { chartArea : {
						               		width:250,
						               		height:170,
						               		top: 0,
						               		left: 10
						               }};

						var chart = new google.visualization.PieChart(document.getElementById('fix_vs_rep'));
						chart.draw(data, options);
					}
					function fixes_by_sources() {
						var data = google.visualization.arrayToDataTable([
						  	['<? _e('Fuentes'); ?>', '<? _e('Fixes'); ?>'],
						 	<? foreach ($fixes_by_sites as $site) :?>
								[<?= "'". $site->site ."'";?>, <?=$site->fixes?>],
							<? endforeach; ?>
						]);
						var options = { chartArea : {
						               		width:220,
						               		height:170,
						               		top: 20,
						               		left: 25
						               },
						               vAxis : {minValue:0}
						           };

						var chart = new google.visualization.ColumnChart(document.getElementById('fixes_by_sources'));
						chart.draw(data, options);
					}
					function actions_by_month() {
						var data = google.visualization.arrayToDataTable([
							['<? _e('Mes'); ?>', '<? _e('Fixes'); ?>', '<? _e('Reportes'); ?>'],
							<? foreach ($actions_by_month as $mes => $action) :?>
								[<?= "'".date('F', mktime(0,0,0,$mes,1))."'";?>,<?= isset($action['fixes']) ? $action['fixes'] : 0; ?>,<?= isset($action['reports']) ? $action['reports'] : 0; ?>],
							<? endforeach; ?>
							]);

						var options = { chartArea : {
						               		width:220,
						               		height:140,
						               		top: 20,
						               		left: 25
						               },
						               vAxis: {minValue:0}
						           };

						var chart = new google.visualization.LineChart(document.getElementById('actions_by_month'));
						chart.draw(data, options);
					}

					function draw_charts() {
						fix_vs_report();
						actions_by_month();
						fixes_by_sources();
					}
			    </script>
			    <? if (count($user->reports) || count($user->subreports)) : ?>
				    <div class="chart_wrap clearfix">
				    	<div class="chart" id="fix_vs_rep"></div>
				    	<div class="explanation">
				    		<? if (count($user->subreports)>0) : ?>
				    			<h3 class="title"><?= round(count($user->fixes)/count($user->subreports),1); ?> <? _e('fixes por cada reporte'); ?></h3>
				    		<? else: ?>
				    			<h3 class="title"><?= count($user->fixes); ?> <? _e('fixes por cada reporte'); ?></h3>
				    		<? endif; ?>
				    		<p class="hint"><? _e('¿Este usuario es más de ‘Fix’ o de ‘Reporte’? Este gráfico nos dice qué porcentaje de Fixes ha hecho por cada reporte aportado.'); ?></p>
				    	</div>
				    </div>
				    <div class="chart_wrap clearfix">
				    	<div class="chart" id="actions_by_month"></div>
				    	<div class="explanation">
				    		<h3 class="title"><? _e('Actividad por meses'); ?></h3>
				    		<p class="hint"><? _e('Este gráfico nos muestra en qué momentos es más activo este usuario y haciendo el qué. Azul: fixes. Rojo: reportes.'); ?></p>
				    	</div>
				    </div>
				    <div class="chart_wrap clearfix">
				    	<div class="chart" id="fixes_by_sources"></div>
				    	<div class="explanation">
				    		<h3 class="title"><? _e('Fixes por fuentes'); ?></h3>
				    		<p class="hint"><? _e('¿Qué medios, blogs, etc. son los que se benefician más de la edición de este usuario? Ordenados de mayor a menor.'); ?></p>
				    	</div>
				    </div>
				<? else : ?>
					<p class="sub_title"><? printf(_('No hay datos para mostrar, cuando %s haga algún fix o reporte, mostraremos las estadísticas.'), $user->name); ?></p>
				<? endif; ?>
			</div>
			<div class="reports_list" id="fixes">
			<? if (count($votes)) : ?>
				<? foreach ($votes as $vote) : ?>
					<article class="report_info clearfix vote-<?=$vote->id;?> <?= $vote->report->has_subreport($user->id) ? 'has_reported' : 'only_fix'; ?> <?= $vote->report->user_id==$user->id ? 'first_fix' : ''; ?>">
						<div class="screenshot">
							<? if (is_null($vote->report->screenshot) || $vote->report->screenshot=="ERROR") : ?>
								<img src="<?php echo base_url(); ?>static/screenshot-thumb.jpg" alt="<? printf(_('Captura de %s'), $report->title); ?>"  title="karma <?= $vote->report->karma ?> / coef <?= $vote->report->karma_value ?> / valor <?= $vote->report->karma*$vote->report->karma_value?>"/>
							<? else : ?>
								<img src="<?=base_url('images/sources/thumb-home-' . $vote->report->id . '.png'); ?>" width="150" alt="<? printf(_('Captura de %s'), $report->title); ?>"  title="karma <?= $vote->report->karma ?> / coef <?= $vote->report->karma_value ?> / valor <?= $vote->report->karma*$vote->report->karma_value?>"/>
							<? endif; ?>
							<div class="clearfix fix_reports_counters">
								<div class="fixes"><span class="count"><?= $vote->report->votes_count; ?></span> <? _e('fixes'); ?></div>
								<div class="reports"><span class="count"><?= count($vote->report->data); ?></span> <? _e('reportes'); ?></div>
							</div>
						</div>
						<h2 class="title"><a href="<?= site_url($this->router->reverseRoute('reports-view', array('slug' => $vote->report->slug))); ?>"><?=$vote->report->title;?></a></h2>
						<div class="report_meta">
							<p class="authorship">Enviado por <a href="<?= site_url($this->router->reverseRoute('user-profile', array('username' => $vote->report->user->username))); ?>"><?= $vote->report->user->name; ?></a> el <?= $vote->report->created_at->format('d/m/Y'); ?></p>
							<p class="source">Fuente: <a href="<?= site_url($this->router->reverseRoute('source-profile', array('sitename' => $vote->report->site))); ?>"><?= $vote->report->site; ?></a></p>
							<? if ($vote->report->has_subreport($user->id)) : ?>
								<p class="action_type report"><?=$user->name;?> <? _e('reportó su propia mejora en esta noticia'); ?></p>
							<? elseif ($vote->report->user_id==$user->id) : ?>
								<p class="action_type fix"><?=$user->name;?> <? _e('fue el primero en hacer fix en esta noticia'); ?></p>
							<? endif; ?>
						</div>
					</article>
				<? endforeach; ?>
				<div class="pagination clearfix"><?=$pagination_links;?></div>
			<? else : ?>
				<p class="sub_title"><? printf(_('No hay datos para mostrar, cuando %s haga algún fix o reporte, mostraremos sus noticias.'), $user->name); ?></p>
			<? endif; ?>
			</div>

		</section>
		<p class="more-actions"><? _e('Ir a...'); ?> <a href="<?= site_url($this->router->reverseRoute('reports-create')); ?>"><? _e('Mejorar una noticia ahora'); ?></a></p>
	</div>
	<?php $this->load->view('includes/sidebar-user'); ?>
</div>