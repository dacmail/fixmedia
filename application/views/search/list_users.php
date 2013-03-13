<div id="container" class="clearfix search columns">
	<div id="content">
		<h1 class="title"><?=$title?></h1>
		<form action="<?= site_url($this->router->reverseRoute('search')); ?>" method="GET" class="searchform">
           	<input type="text" value="<?= isset($term) ? $term : ''; ?>" name="q" class="input"/>
        </form>
        <section class="tabs notabs">
        	<ul class="tabs_items">
				<li class=""><a href="<?= site_url($this->router->reverseRoute('search')); ?>?q=<?= isset($term) ? $term : ''; ?>"><? _e('Noticias'); ?></a></li>
				<li class=""><a href="<?= site_url($this->router->reverseRoute('search-reports')); ?>?q=<?= isset($term) ? $term : ''; ?>"><? _e('Reportes'); ?></a></li>
				<li class="ui-state-active"><a href="<?= site_url($this->router->reverseRoute('search-users')); ?>?q=<?= isset($term) ? $term : ''; ?>"><? _e('Usuarios'); ?></a></li>
			</ul>
        </section>
        <section class="order clearfix">
        	<span class="label"><? _e('Ordernar por'); ?>:</span>
        	<ul class="orderby clearfix">
        		<li class="item <?= $orderby ? '' : 'active' ?>"><a href="<?= site_url($this->router->reverseRoute('search-users')); ?>?q=<?= isset($term) ? $term : ''; ?>"><? _e('Relevancia'); ?></a></li>
        		<li class="item <?= $orderby ? 'active' : '' ?>"><a href="<?= site_url($this->router->reverseRoute('search-users')); ?>?q=<?= isset($term) ? $term : ''; ?>&order=date"><? _e('Fecha'); ?></a></li>
        	</ul>
        </section>
		<section class="users_list profile">
			<? if (count($users)) : ?>
				<? foreach ($users as $user) : ?>
					<article class="user_info clearfix">
							<a href="<?= site_url($this->router->reverseRoute('user-profile', array('username' => $user->username))); ?>"><?=get_avatar( $user, 150); ?></a>
							<div class="data">
						  		<h2 class="name"><a href="<?= site_url($this->router->reverseRoute('user-profile', array('username' => $user->username))); ?>"><?= $user->name; ?></a></h2>
						  		<p class="when"><? _e('Mejorando noticias desde el'); ?> <?= date('d/m/Y', $user->created_on); ?></p>
						  		<p class="bio"><?= highlight_phrase($user->bio, $term, '<strong>' , '</strong>') ?></p>
						 		<? if ($user->url) : ?><p class="url">Web: <a href="<?= $user->url ?>" target="_blank"><?= $user->url ?></a></p><? endif; ?>
						 		<?= karma_graphic($user->karma); ?>
						 		<? if ($user->twitter) : ?>
						 		<p class="follow">
						 			<a href="https://twitter.com/<?=$user->twitter;?>" class="twitter-follow-button" data-show-count="false" data-lang="es"><? _e('Seguir a'); ?> @<?=$user->twitter;?></a>
					<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
						 		</p>
						 		<? endif; ?>
						  </div>
					</article>
				<? endforeach; ?>
			<? else : ?>
			<p class="sub_title"><? _e('No hay usuarios para la cadena de búsqueda'); ?></p>
			<? endif; ?>
		</section>
		<div class="pagination clearfix"><?=$pagination_links;?></div>
	</div>
	<?php $this->load->view('includes/sidebar'); ?>
</div>
