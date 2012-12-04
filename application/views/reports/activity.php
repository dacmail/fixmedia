<div id="container" class="clearfix sending report columns activity">
	<div id="content">
		<?php $this->load->view('includes/report-info'); ?>
		<section class="tabs notabs">
        	<ul class="tabs_items">
				<li class=""><a href="<?= site_url($this->router->reverseRoute('reports-view', array('slug' => $report->slug))); ?>">Reportes</a></li>
				<li class="ui-state-active"><a href="<?= site_url($this->router->reverseRoute('reports-activity', array('slug' => $report->slug))); ?>">Actividad</a></li>
			</ul>
        </section>
		<h2 class="action_title"><strong>Están contribuyendo a mejorar esta noticia</strong> Listado de usuarios comprometidos</h2>
		<section class="reporting_users search profile clearfix">
			<h3 class="section_title">Usuarios que han reportado</h3>
			<? foreach ($reporting_users as $user) :  ?>
				<article class="user_info clearfix">
						<a href="<?= site_url($this->router->reverseRoute('user-profile', array('username' => $user->username))); ?>"><?=gravatar( $user->email, 150, true, base_url('static/avatar-user-150.jpg'), 'x', array('title' => 'Reputación ' . $user->karma) )?></a>
						<div class="data">
					  		<h2 class="name"><a href="<?= site_url($this->router->reverseRoute('user-profile', array('username' => $user->username))); ?>"><?= $user->name; ?></a></h2>
					  		<p class="when">Mejorando noticias desde el <?= date('d/m/Y', $user->created_on); ?></p>
					 		<? if ($user->twitter) : ?>
					 		<p class="follow">
					 			<a href="https://twitter.com/<?=$user->twitter;?>" class="twitter-follow-button" data-show-count="false" data-lang="es">Seguir a @<?=$user->twitter;?></a>
				<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
					 		</p>
					 		<? endif; ?>
					  </div>
				</article>
			<? endforeach; ?>
		</section>
		<section class="reporting_votes_users clearfix">
			<h3 class="section_title">Usuarios que han valorado positivamente un reporte</h3>
			<ul class="users_list medium">
			<? foreach ($reporting_votes_users as $user) :  ?>
				<li class="user_info clearfix">
						<a class="link_wrap" href="<?= site_url($this->router->reverseRoute('user-profile', array('username' => $user->username))); ?>">
							<?=gravatar( $user->email, 75, true, base_url('static/avatar-user-150.jpg'), 'x', array('title' => 'Reputación ' . $user->karma) )?>
							<div class="name_wrap">
								<span class="name"><?= (strlen($user->name)>7) ? substr($user->name,0,7) . '...' : $user->name; ?></span>
								<span class="name over"><?= $user->name; ?></span>
							</div>
						</a>
				</li>
			<? endforeach; ?>
			</ul>
		</section>
		<section class="only_fixes_users clearfix">
			<h3 class="section_title">Usuarios que solo han hecho fix</h3>
			<ul class="users_list small">
			<? foreach ($only_fixes_users as $user) :  ?>
				<li class="user_info clearfix">
						<a class="link_wrap" href="<?= site_url($this->router->reverseRoute('user-profile', array('username' => $user->username))); ?>">
							<?=gravatar( $user->email, 50, true, base_url('static/avatar-user-150.jpg'), 'x', array('title' => 'Reputación ' . $user->karma) )?>
							<div class="name_wrap">
								<span class="name"><?= (strlen($user->name)>6) ? substr($user->name,0,6) . '...' : $user->name; ?></span>
								<span class="name over"><?= $user->name; ?></span>
							</div>
						</a>
				</li>
			<? endforeach; ?>
			</ul>
		</section>
	</div>

	<aside id="sidebar" class="report">
		<div class="counter">
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
					<a title="Haciendo Fix estás diciendo que esta noticia es mejorable en algún aspecto" href="<?php echo base_url("index.php/auth/login"); ?>" id="vote-<?= $report->id ?>" class="button icon fixit">
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

	</aside>
</div>
