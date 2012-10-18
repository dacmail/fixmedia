<div id="container" class="clearfix stats">
	<div id="content">
		<div class="block-wrap clearfix">
			<section class="indicators clearfix">
				<div class="indicator">
					<span class="counter"><?= $total_news ?></span>
					noticias
				</div>
				<div class="indicator">
					<span class="counter"><?= $total_reports ?></span>
					reportes
				</div>
				<div class="indicator">
					<span class="counter"><?= $total_fixes ?></span>
					fixes
				</div>
				<div class="indicator">
					<span class="counter"><?= $total_users ?></span>
					usuarios
				</div>
				<div class="indicator last">
					<span class="counter"><?= $total_sources ?></span>
					fuentes
				</div>
			</section>
			<aside class="indicators-explanation">El trozo de texto estándar de Lorem Ipsum usado desde el año 1500 es reproducido debajo para aquellos interesados.</aside>
		</div>
		<div class="block-wrap clearfix">
			<h1 class="title">Fuentes</h2>
			<p class="sub_title sep">Las fuentes más importantes en fixmedia</p>
			<section id="chart_1" class="chart_full"></section>
		</div>
		<div class="block-wrap clearfix">
			<h1 class="title">Fixes</h2>
			<p class="sub_title sep">Actividad de fixes en los últimos 7 días</p>
			<section id="chart_2" class="chart_2_3"></section>
			<section id="chart_7" class="chart_1_3"></section>
		</div>
		<div class="block-wrap clearfix">
			<h1 class="title">Reportes</h2>
			<p class="sub_title sep">Actividad de fixes en los últimos 7 días</p>
			<div class="wrapin clearfix">
				<section id="chart_3" class="chart_2_3"></section>
				<section id="chart_5" class="chart_1_3"></section>
			</div>
			<div class="wrapin clearfix">
				<section id="chart_6" class="chart_2_3"></section>
				<aside class="chart-explanation cex_1_3">
					<h3 class="cex_title">Titular</h3>
					<p class="cex_text">Lorem ipsum dolor sit amet, consecquetum</p>
					<p class="cex_counter">579</p>
					<p class="cex_counter_ex">reportes</p>
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
			      	['ID', 'Número de reportes', 'Número de fixes', 'Fuente', 'Reputación'],
			      	<? foreach ($global as $site) :?>
						[<?= "'". substr($site->site, 0, 3) ."'";?>, <?=$site->reportes?>, <?=$site->votos?>, <?= "'". $site->site ."'";?>,  <?=$site->karma?>],
					<? endforeach; ?>
			    ]);

			    var options = {
			      title: 'Número de fixes, número de reportes y reputación acumulada de las 10 fuentes más importantes en todo el periodo',
			      hAxis: {title: 'Número de reportes', minValue: 0},
			      vAxis: {title: 'Número de fixes', minValue: 0},
			      bubble: {textStyle: {fontSize: 11}},
			  	  chartArea:{left:50,top:10,width:"750", height:"350"}
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
			  				title: 'Número de fixes en los últimos 7 días',
			                vAxis: {minValue: 0},
			              	hAxis: {minValue: 0},
			              	chartArea:{left:30,top:10,width:"500", height:"300"}}
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
			  				title: 'Número de reportes en los últimos 7 días',
			                vAxis: {minValue: 0},
			              	hAxis: {minValue: 0},
			              	chartArea:{left:30,top:10,width:"500", height:"300"}}
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
			 			 	title: 'Número de fixes y reportes en los últimos 7 días',
			                vAxis: {minValue: 0},
			              	hAxis: {minValue: 0},
			              chartArea:{left:30,top:10,width:"500", height:"300"}}
			          );
			}
			function draw_chart_5() {
			  var data = google.visualization.arrayToDataTable([
			    ['Tipo', 'Reportes'],
			    <? foreach ($reports_types as $item) : ?>
			    	['<?= $item->type; ?>', <?= $item->total; ?>],
			    <? endforeach; ?>
			  ]);

			  // Create and draw the visualization.
			  new google.visualization.PieChart(document.getElementById('chart_5')).
			      draw(data, {title:"Tipos de reportes en todo el periodo",
			  chartArea:{left:20,top:20,width:"280", height:"300"}});
			}

			function draw_chart_6() {
			  var data = google.visualization.arrayToDataTable([
			    ['Subtipo', 'Reportes'],
			    <? foreach ($reports_subtypes as $item) : ?>
			    ["<?= preg_replace('/^\s+|\n|\r|\s+$/m', '',$item->type_info); ?>", <?= $item->total; ?>],
			    <? endforeach; ?>
			  ]);

			  // Create and draw the visualization.
			  new google.visualization.ColumnChart(document.getElementById('chart_6')).
			      draw(data,
			           {title:"Subtipos más utilizados en los reportes enviados en todo el periodo",
			           hAxis: {minValue:0},
			       		chartArea:{left:30,top:10,width:"500", height:"300"}}
			      );
			}
			function draw_chart_7() {
			  var data = google.visualization.arrayToDataTable([
			    ['Tipo', 'Total'],
			    <? foreach ($reports_vs_fixs as $item) : ?>
			    	['<?= $item->vote_type; ?>', <?= $item->total; ?>],
			    <? endforeach; ?>
			  ]);

			  // Create and draw the visualization.
			  new google.visualization.PieChart(document.getElementById('chart_7')).
			      draw(data, {title:"Reportes vs Fixes en los últimos 7 días",
			 				 chartArea:{left:20,top:20,width:"280", height:"300"}});
			}
			function draw_charts() {
				draw_chart_1();
				draw_chart_2();
				draw_chart_3();
				//draw_chart_4();
				draw_chart_5();
				draw_chart_6();
				draw_chart_7();
			}
		</script>

	</div>
</div>