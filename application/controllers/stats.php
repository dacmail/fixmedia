<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Stats extends MY_Controller {

	public function __construct() {
	   parent::__construct();
	}
	public function index() {
			/*
			Gráfico de dispersión (scatter chart), en donde:
			Donde la Y muestre fixes y la X reportes
			Donde los puntos en el gráfico sean las fuentes (quizá se puede limitar a las 10 más grandes)
			Donde el tamaño del punto (la fuente) se determine o por el karma de la fuente o quizá por la suma de actividad a su alrededor en la votación de sus reportes (si el medio X le han hecho 10 reportes que han sido valorados en total 50 veces, la burbuja será más grande que si le han hecho 20 reportes pero solo han sido valorados 40 veces).
			*/
			$data['global'] = Report::find_by_sql("SELECT r.site, r.votos, rd1.reportes, r.karma
										FROM reports_data rd INNER JOIN
										(SELECT id, site, sum(votes_count) as votos, sum(karma) as karma FROM reports GROUP BY site) as r
										ON rd.report_id=r.id
										INNER JOIN
										(SELECT r.site, count(rd.id) as reportes FROM reports r LEFT JOIN reports_data rd ON rd.report_id=r.id GROUP BY r.site) as rd1
										ON rd1.site = r.site
										GROUP BY r.site ORDER BY r.votos DESC LIMIT 0,10");

			/* Noticias en Fixmedia (fixes totales) En un número, sin gráfico */
			$data['total_fixes'] = count(Vote::find_all_by_vote_type('FIX'));

			/* Gráfico linea temporal de fixes totales por días */
			$data['fixes_by_days'] = Vote::find_by_sql("SELECT SUM(vote_value) as fixes, DATE_FORMAT(created_at, '%d-%m-%y') as fecha
													FROM votes WHERE created_at > date_sub(now(), interval 7 day)
													AND vote_type='FIX' GROUP BY fecha");
			/* Gráfico línea temporal de fixes por días y por fuente (las 3 en cabeza en cada momento)

			Reportes:
			/* Reportes en Fixmedia. En un número, sin gráfico*/
			$data['total_reports'] = count(Reports_data::all());
			/*Gráfico linea temporal de reportes totales por días */
			$data['reports_by_days'] = Reports_data::find_by_sql("SELECT COUNT(id) as total, DATE_FORMAT(created_at, '%d-%m-%y') as fecha
													FROM reports_data WHERE created_at > date_sub(now(), interval 7 day)
													GROUP BY fecha");
			/*Gráfico línea temporal de reportes por días y por fuente (las 3 en cabeza en cada momento)*/

			/*Tarta de reportes por tipo (corrección/ampliación) (global, el total ene se momento)*/
			$data['reports_types'] = Reports_data::find_by_sql("SELECT type, count(id) FROM reports_data GROUP BY type");

			/*Gráficos de barras de reportes por subtipos (corrección: subtipos, ampliación: subtipos)  (global, el total en ese momento) */
			$data['reports_subtypes'] = Reports_data::find_by_sql("SELECT type,  type_info, count(id) as total
													FROM reports_data WHERE  type!=type_info
													GROUP BY type_info ORDER BY type, total DESC");
			/* Tarta Reportes vs Fixes (global y última semana)*/
			$data['reports_vs_fixs'] = Vote::find_by_sql("SELECT vote_type, count(DISTINCT item_id) total
												FROM votes WHERE created_at > date_sub(now(), interval 7 day)
												GROUP BY vote_type");
			echo '<pre>';
			var_dump($data);
			echo '</pre>';
	}
}

?>