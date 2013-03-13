<div id="container" class="clearfix sending report columns">
	<div id="content">
		<?php $this->load->view('includes/report-info'); ?>
		<section class="tabs notabs">
        	<ul class="tabs_items">
				<li class="ui-state-active"><a href="<?= site_url($this->router->reverseRoute('reports-view', array('slug' => $report->slug))); ?>"><? _e('Reportes'); ?></a></li>
				<li class=""><a href="<?= site_url($this->router->reverseRoute('reports-activity', array('slug' => $report->slug))); ?>"><? _e('Actividad'); ?></a></li>
			</ul>
        </section>
		<? if (count($report->data)) :?>
			<h2 class="action_title"><strong><? _e('¿Qué es mejorable en esta noticia?'); ?></strong> <? _e('Listado de reportes recibidos'); ?></h2>
		<? else: ?>
			<h2 class="action_title"><strong><? _e('¿Qué es mejorable en esta noticia?'); ?></strong> <? _e('No hay reportes recibidos'); ?></h2>
		<? endif; ?>
		<? $count=1; foreach ($report->data as $subreport) :  ?>
			<div id="report-<?= $subreport->id; ?>" class="subreport <?= $subreport->is_solved() ? 'solved' : ''; ?>">
				<div class="clearfix">
					<span class="counter">
						<strong class="count-vote-up-<?= $subreport->id ?> count-vote-down-<?= $subreport->id ?>"><?= $subreport->votes_count ?></strong>
						<div title="Usa las flechas para valorar positiva o negativamente esta mejora concreta" class="votes_buttons clearfix">
							<? if ($logged_in && !$subreport->is_voted($the_user->id)) : ?>
								<a href="<?php echo site_url(array('services/report_vote', $the_user->id ,$subreport->id, 1)); ?>" id="vote-up-<?= $subreport->id ?>" class="report_vote up clearfix vote-<?= $subreport->id ?>">+</a>
							<? else : ?>
								<span id="vote-up-<?= $subreport->id ?>" class="report_vote up clearfix vote-<?= $subreport->id ?>">+</span>
							<? endif; ?>
							<? if ($logged_in && !$subreport->is_voted($the_user->id)) : ?>
								<a href="<?php echo site_url(array('services/report_vote', $the_user->id ,$subreport->id, -1)); ?>" id="vote-down-<?= $subreport->id ?>" class="report_vote down clearfix vote-<?= $subreport->id ?>">-</a>
							<? else : ?>
								<span id="vote-down-<?= $subreport->id ?>" class="report_vote down clearfix vote-<?= $subreport->id ?>">-</span>
							<? endif; ?>
						</div>

					</span>
					<div class="subreport_info">
						<h3 class="subreport_title"><?=$subreport->title; ?></h3>
						<p class="authorship"><? _e('Enviado por'); ?> <a href="<?= site_url($this->router->reverseRoute('user-profile', array('username' => $subreport->user->username))); ?>"><?= $subreport->user->name; ?></a> <? _e('el'); ?> <?= $subreport->created_at->format('d/m/Y'); ?></p>
						<? if ($logged_in && $subreport->is_removable($the_user->id)) : ?>
							<p style="margin-bottom:15px;"><? _e('Este reporte lo has enviado tu y todavía puedes eliminarlo.'); ?> <a href="<?= site_url('reports/delete_subreport/' . $subreport->id); ?>"><? _e('¿Eliminar reporte?'); ?></a></p>
						<? endif; ?>
						<p class="clearfix subreport_types type_<?= preg_replace('/[^a-z0-9]+/i','-',strtolower($subreport->type));?>">
							<span class="type"><?=$subreport->type;?></span>,
							<? if ($subreport->type_info!=$subreport->type) : ?>
							<span class="type_info" title="<?= $subreport->type_info; ?>"><?= character_limiter($subreport->type_info,120); ?></span>
							<? endif; ?>
						</p>
						<? if (!empty($subreport->content) || !empty($subreport->urls[0])) : ?>
						<a href="#" class="toggle_info"><? _e('Ocultar detalles y fuentes'); ?></a>
						<div class="subreport_content">
							<?=$subreport->content;?>
							<? if (count(array_filter($subreport->urls))>0) : ?>
								<h4 class="subreport_urls">Fuentes:</h4>
								<? foreach($subreport->urls as $url) : ?>
								<a href="<?=$url?>" target="_blank" class="source"><?=$url; ?></a>
								<? endforeach; ?>
							<? endif; ?>
						</div>
						<? endif; ?>

						<div class="solved_button clearfix">
							<? if ($logged_in && !$subreport->is_voted($the_user->id, 'SOLVED')) : ?>
								<a class="question"><? _e('¿Arreglado en la noticia original?'); ?></a>
								<a href="<?php echo site_url(array('services/report_solved', $the_user->id ,$subreport->id)); ?>" id="solved-<?= $subreport->id ?>" class="report_solved solved-<?= $subreport->id ?>"><? _e('Sí'); ?></a>
							<? elseif (!$logged_in) : ?>
								<a class="question"><? _e('¿Arreglado en la noticia original?'); ?></a>
								<a href="<?= site_url($this->router->reverseRoute('login')); ?>" class="report_solved_nologin"><? _e('Sí'); ?></a>
							<? endif; ?>
							<span class="solved_counter">
								<? if ($subreport->solved_votes() > 0) : ?>
									<span class="number"><?=$subreport->solved_votes()?></span>
									<? if ($subreport->solved_votes() == 1) : ?>
										<? $and = $logged_in && $subreport->is_voted($the_user->id, 'SOLVED') ?  _('(tú) ') : ' ' ?>
										<? printf(_('persona %s dice que ya está arreglado'), $and); ?>
									<? else : ?>
										<? $and = $logged_in && $subreport->is_voted($the_user->id, 'SOLVED') ?  _('(y tú) ') : ' ' ?>
										<? printf(_('personas %s dicen que ya está arreglado'), $and); ?>
									<? endif; ?>
								<? endif; ?>
							</span>
						</div>
					</div>
				</div>
			</div>
		<? $count++; endforeach; ?>


	</div>

	<aside id="sidebar" class="report">
		<div class="counter">
			<?= $report->is_solved() ? '<span class="solved_ribbon">¡Arreglada!</span>' : ''; ?>
			<div class="wrap-counter">
				<span class="count count-vote-<?= $report->id ?>"><?= $report->votes_count ?></span>
				<? if ($report->votes_count==1 && ($logged_in && $report->is_voted($the_user->id))) : ?>
				persona (tu) quiere que alguien la arregle
				<? elseif ($report->votes_count==1) :?>
				persona quiere que alguien la arregle. ¿Y tú?
				<? else : ?>
				personas quieren que alguien la arregle. ¿Y tú?
				<? endif; ?>
			</div>
			<div class="wrap-fix">
				<? if ($logged_in && !$report->is_voted($the_user->id)) : ?>
					<a title="Haciendo Fix estás diciendo que esta noticia es mejorable en algún aspecto" href="<?php echo site_url(array('services/fix_vote',$report->id)); ?>" id="vote-<?= $report->id ?>" class="button icon fixit fix_vote">
						FIX
					</a>
				<? elseif (!$logged_in) : ?>
					<a title="Haciendo Fix estás diciendo que esta noticia es mejorable en algún aspecto" href="<?=  site_url($this->router->reverseRoute('login')); ?>" id="vote-<?= $report->id ?>" class="button icon fixit">
						FIX
					</a>
				<? elseif ($logged_in && $report->is_voted($the_user->id)) : ?>
					<div class="fix_done">¡Hecho!</div>
				<? endif; ?>
			</div>
		</div>
		<? if ($logged_in && $report->is_voted($the_user->id)) : ?>
			<span class="action-title"><strong>¡Ya has hecho FIX!</strong> ¿Qué quieres hacer ahora?</span>
		<? else: ?>
			<span class="action-title">También puedes...</span>
		<? endif; ?>
		<? $doreport = isset($doreport) ? 'do' : '';?>
		<input type="hidden" id="url_report" value="<?=site_url($this->router->reverseRoute('reports-view' , array('slug' => $report->slug)));?>"/>
		<a href="<?= site_url('services/share/' . $report->slug . '/' . $doreport); ?>" class="action-button share <?= (isset($autoshare) ? 'autoload' : ''); ?>">Compártela</a>
		<hr class="sep"/>
		<a href="<?= site_url($this->router->reverseRoute('reports-send' , array('id' => $report->id))); ?>" class="action-button add_report">Arréglala</a>
		<a href="#" class="continue_voting" data-ajax="<?= site_url('services/next_unvoted_report'); ?>">Sigue valorando</a>
	</aside>
</div>
