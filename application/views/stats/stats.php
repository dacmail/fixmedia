<div id="container" class="clearfix stats">
	<div id="content">
		<div class="block-wrap clearfix">
			<section class="indicators clearfix">
				<div class="indicator">
					<span class="counter"><?= $total_news ?></span>
					<? _e('noticias'); ?>
				</div>
				<div class="indicator">
					<span class="counter"><?= $total_reports ?></span>
					<? _e('reportes'); ?>
				</div>
				<div class="indicator">
					<span class="counter"><?= $total_fixes ?></span>
					<? _e('fixes'); ?>
				</div>
				<div class="indicator">
					<span class="counter"><?= $total_users ?></span>
					<? _e('usuarios'); ?>
				</div>
				<div class="indicator last">
					<span class="counter"><?= $total_sources ?></span>
					<? _e('fuentes'); ?>
				</div>
			</section>
			<aside class="indicators-explanation"><? _e('Las cifras globales de Fixmeda desde el día de su lanzamiento'); ?></aside>
		</div>
		<div class="block-wrap clearfix">
			<h1 class="title"><? _e('Fuentes'); ?></h2>
			<p class="sub_title sep"><? _e('Las fuentes más importantes en Fixmedia en los últimos 7 días'); ?></p>
			<section id="chart_1" class="chart_full"></section>
			<aside class="chart-explanation top">
				<p class="cex_text"><? _e('Cada globo representa una fuente (un medio, un blog, etc.). Cuanto más alineado esté a la derecha, es que ha recibido más reportes. Cuanto más arriba esté, es que ha recibido más fixes. Cuanto mayor sea el tamaño del globo, es que tiene el total de noticias tienen más importancia dentro de Fixmedia.'); ?></p>
			</aside>
		</div>
		<div class="block-wrap clearfix">
			<h1 class="title"><? _e('Fixes'); ?></h2>
			<p class="sub_title sep"><? _e('Fixes acumulados en los últimos 7 días'); ?></p>
			<div class="wrapin clearfix">
				<section id="chart_2" class="chart_2_3"></section>
				<section id="chart_7" class="chart_1_3"></section>
			</div>
			<aside class="chart-explanation top">
				<p class="cex_text"><? _e('¿Cuántos fixes se han hecho? ¿Cuál es la proporción de fixes respecto a los reportes recibidos durante el mismo periodo?'); ?></p>
			</aside>
		</div>
		<div class="block-wrap clearfix">
			<h1 class="title"><? _e('Reportes'); ?></h2>
			<p class="sub_title sep"><? _e('Reportes acumulados en los últimos 7 días'); ?></p>
			<div class="wrapin clearfix">
				<section id="chart_3" class="chart_2_3"></section>
				<section id="chart_5" class="chart_1_3"></section>
			</div>
			<aside class="wrapin chart-explanation top">
				<p class="cex_text"><? _e('¿Cuántos reportes han enviado los usuarios esta última semana? De ellos, ¿cuántos han sido ampliaciones y cuántos, correcciones?'); ?></p>
			</aside>
			<div class="wrapin clearfix">
				<section id="chart_6" class="chart_2_3"></section>
				<aside class="chart-explanation cex_1_3">
					<h3 class="cex_title"><? _e('Tipos de correcciones'); ?></h3>
					<p class="cex_text"><? _e('¿Dónde fallan los medios? ¿Qué tipo de correcciones se han hecho esta última semana?'); ?></p>
				</aside>
			</div>
			<div class="wrapin clearfix">
				<section id="chart_8" class="chart_2_3"></section>
				<aside class="chart-explanation cex_1_3">
					<h3 class="cex_title"><? _e('Tipos de amplaciones'); ?></h3>
					<p class="cex_text"><? _e('¿Qué tipo de ampliaciones se han hecho esta última semana?'); ?></p>
				</aside>
			</div>
		</div>

	   	<script type="text/javascript" src="https://www.google.com/jsapi"></script>
	    <script type="text/javascript">
	    	google.load('visualization', '1.0', {'packages':['corechart']});
			google.setOnLoadCallback(draw_charts);
			function draw_chart_1() {
			    // Create and populate the data table.
			    var data = google.visualization.arrayToDataTable([
			      	['ID', '<? _e('Número de reportes'); ?>', '<? _e('Número de fixes'); ?>', '<? _e('Fuente'); ?>', '<? _e('Reputación'); ?>'],
			      	<? foreach ($global as $site) :?>
						[<?= "'". substr($site->site, 0, 3) ."'";?>, <?=$site->reportes?>, <?=$site->votos?>, <?= "'". $site->site ."'";?>,  <?=$site->karma?>],
					<? endforeach; ?>
			    ]);

			    var options = {
			      title: '<? _e('Número de fixes, número de reportes y reputación acumulada de las 10 fuentes más importantes'); ?>',
			      hAxis: {title: '<? _e('Número de reportes'); ?>', minValue: 0},
			      vAxis: {title: '<? _e('Número de fixes'); ?>', minValue: 0},
			      bubble: {textStyle: {fontSize: 11}},
			  	  chartArea:{left:50,top:20,width:"750", height:"350"}
			    };

			    // Create and draw the visualization.
			    var chart = new google.visualization.BubbleChart(
			        document.getElementById('chart_1'));
			    chart.draw(data, options);
			}
			function draw_chart_2() {
			  var data = google.visualization.arrayToDataTable([
			    ['Día', 'Fixes'],
			    <? foreach ($fixes_by_days as $fix) : ?>
			    	['<?= $fix->fecha; ?>', <?= $fix->fixes; ?>],
			    <? endforeach; ?>
			  ]);
			  var chart = new google.visualization.LineChart(document.getElementById('chart_2'));
			  chart.draw(data, {
			  				title: '<? _e('Número de fixes en los últimos 7 días'); ?>',
			                vAxis: {minValue: 0},
			              	hAxis: {minValue: 0},
			              	chartArea:{left:30,top:20,width:"500", height:"300"}}
			          );
			}
			function draw_chart_3() {
			  var data = google.visualization.arrayToDataTable([
			    ['Día', 'Reportes'],
			    <? foreach ($reports_by_days as $rep) : ?>
			    	['<?= $rep->fecha; ?>', <?= $rep->total; ?>],
			    <? endforeach; ?>
			  ]);
			  var chart = new google.visualization.LineChart(document.getElementById('chart_3'));
			  chart.draw(data, {
			  				title: '<? _e('Número de reportes en los últimos 7 días'); ?>',
			                vAxis: {minValue: 0},
			              	hAxis: {minValue: 0},
			              	chartArea:{left:30,top:20,width:"500", height:"300"}}
			          );
			}
			function draw_chart_4() {
			  var data = google.visualization.arrayToDataTable([
			    ['Día', 'Reportes', 'Fixes'],
			    <? foreach ($by_date as $fecha => $count) : ?>
			    	['<?= $fecha; ?>', <?= isset($count['total']) ? $count['total'] : 0; ?>, <?= isset($count['fixes']) ? $count['fixes'] : 0; ?>],
			    <? endforeach; ?>
			  ]);
			  var chart = new google.visualization.LineChart(document.getElementById('chart_4'));
			  chart.draw(data, {
			 			 	title: '<? _e('Número de fixes y reportes en los últimos 7 días'); ?>',
			                vAxis: {minValue: 0},
			              	hAxis: {minValue: 0},
			              chartArea:{left:30,top:20,width:"500", height:"300"}}
			          );
			}
			function draw_chart_5() {
			  var data = google.visualization.arrayToDataTable([
			    ['<? _e('Tipo'); ?>', '<? _e('Reportes'); ?>'],
			    <? foreach ($reports_types as $item) : ?>
			    	['<?= $item->type; ?>', <?= $item->total; ?>],
			    <? endforeach; ?>
			  ]);

			  // Create and draw the visualization.
			  new google.visualization.PieChart(document.getElementById('chart_5')).
			      draw(data, {title:"<? _e('Tipos de reportes en los últimos 7 días'); ?>",
			  chartArea:{left:20,top:20,width:"280", height:"300"}});
			}

			function draw_chart_6() {
			  var data = google.visualization.arrayToDataTable([
			    ['Subtipo', 'Reportes'],
			    <? foreach ($reports_subtypes_c as $item) : ?>
			    ["<?= preg_replace('/^\s+|\n|\r|\s+$/m', '',$item->type_info); ?>", <?= $item->total; ?>],
			    <? endforeach; ?>
			  ]);

			  // Create and draw the visualization.
			  new google.visualization.BarChart(document.getElementById('chart_6')).
			      draw(data,
			           {title:"<? _e('Subtipos de correcciones más utilizados en los últimos 7 días'); ?>",
			           hAxis: {minValue:0},
			       		chartArea:{left:30,top:20,width:"500", height:"300"}}
			      );
			}
			function draw_chart_7() {
			  var data = google.visualization.arrayToDataTable([
			    ['<? _e('Tipo'); ?>', '<? _e('Total'); ?>'],
			    <? foreach ($reports_vs_fixs as $item) : ?>
			    	['<?= $item->vote_type; ?>', <?= $item->total; ?>],
			    <? endforeach; ?>
			  ]);

			  // Create and draw the visualization.
			  new google.visualization.PieChart(document.getElementById('chart_7')).
			      draw(data, {title:"<? _e('Reportes vs Fixes en los últimos 7 días'); ?>",
			 				 chartArea:{left:20,top:20,width:"280", height:"300"}});
			}
			function draw_chart_8() {
			  var data = google.visualization.arrayToDataTable([
			    ['<? _e('Subtipo'); ?>', '<? _e('Reportes'); ?>'],
			    <? foreach ($reports_subtypes_a as $item) : ?>
			    ["<?= preg_replace('/^\s+|\n|\r|\s+$/m', '',$item->type_info); ?>", <?= $item->total; ?>],
			    <? endforeach; ?>
			  ]);

			  // Create and draw the visualization.
			  new google.visualization.BarChart(document.getElementById('chart_8')).
			      draw(data,
			           {title:"<? _e('Subtipos de ampliaciones más utilizados en los últimos 7 días'); ?>",
			           hAxis: {minValue:0},
			       		chartArea:{left:30,top:30,width:"500", height:"300"}}
			      );
			}
			function draw_charts() {
				draw_chart_1();
				draw_chart_2();
				draw_chart_3();
				draw_chart_5();
				draw_chart_6();
				draw_chart_7();
				draw_chart_8();
			}
		</script>

	</div>
</div>