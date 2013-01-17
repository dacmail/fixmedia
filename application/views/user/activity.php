<div id="container" class="clearfix profile columns">
	<div id="content">
		<section class="user_info clearfix">
			<div class="gravatar">
				<?=gravatar( $user->email, 150, true, base_url('static/avatar-user-150.jpg'), 'x', array('title' => 'Reputación ' . $user->karma) )?>
			  	<? if ($logged_in && $user->id==$the_user->id) : ?>
			  	<a class="change_gravatar" href="http://es.gravatar.com/" target="blank">Cambiar gravatar</a>
			  	<? endif; ?>
			</div>
			<div class="data">
				<h1 class="name"><?= $user->name; ?>
					<? if ($logged_in && $user->id==$the_user->id) : ?>
						<a class="edit_profile_link" href="<?=site_url($this->router->reverseRoute('user-edit'));?>">Editar perfil</a>
					<? endif; ?>
				</h1>
				<p class="when">Mejorando noticias desde el <?= date('d/m/Y', $user->created_on); ?></p>
				<p class="bio"><?= $user->bio ?></p>
				<? if ($user->url) : ?><p class="url">Web: <a href="#"><?= $user->url ?></a></p><? endif; ?>
				<? if ($user->twitter) : ?>
				<p class="follow">
					<a href="https://twitter.com/<?=$user->twitter;?>" class="twitter-follow-button" data-show-count="false" data-lang="es">Seguir a @<?=$user->twitter;?></a>
					<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
				</p>
				<? endif; ?>
			</div>
		</section>
		<section class="tabs notabs">
			<ul class="tabs_items">
				<li><a href="<?= site_url($this->router->reverseRoute('user-profile', array('username' => $the_user->username))); ?>">Estadísticas</a></li>
				<li><a href="<?= site_url($this->router->reverseRoute('user-profile', array('username' => $the_user->username))); ?>#fixes">Noticias mejoradas por <?= $user->name; ?></a></li>
				<li class="ui-state-active"><a href="#activity">Actividad <? if (count($the_user->unread_activity)) : ?> (<?= count($the_user->unread_activity); ?>)<? endif; ?></a></li>
			</ul>
			<div id="activity">
				<? if (count($activity)) : ?>
				<? foreach ($activity as $a) : ?>
					<li class="activity-item clearfix <?= strtolower($a->notification_type); ?> <?= $a->read ? 'read' : 'unread'; ?>">
						<?=gravatar( $a->sender->email, 30, true, base_url('static/avatar-user-30.jpg'), 'x', array('title' => 'Avatar de ' . $the_user->name) )?>
						<p class="activity-text"><a href="<?= site_url($this->router->reverseRoute('user-profile', array('username' => $a->sender->username))); ?>"><?= $a->sender->name ?></a> <?= get_activity_text($a, $this); ?>
						<span class="date"><?= relative_time($a->created_at->format('db')); ?></span></p>
						<i class="icon"><?= $a->read ? 'Leido' : 'Nueva'; ?></i>
						</li>
				<? endforeach; ?>
				<div class="pagination clearfix"><?=$pagination_links;?></div>
				<? else: ?>
				<p>No hay actividad que mostrar</p>
				<? endif; ?>
			</div>
		</section>
		<p class="more-actions">Ir a... <a href="<?= site_url($this->router->reverseRoute('reports-create')); ?>">Mejorar una noticia ahora</a></p>
	</div>
	<?php $this->load->view('includes/sidebar-user'); ?>
</div>