<div id="container" class="clearfix search top columns">
	<div id="content">
		<h1 class="title"><?=$title?></h1>
		<p class="sub_title"><?=$subtitle?></p>
		<form action="<?= site_url($this->router->reverseRoute('search-users')); ?>" method="GET" class="searchform">
           	<input type="text" placeholder="<? _e('buscar usuarios'); ?>" name="q" class="input"/>
        </form>
        <section class="tabs notabs">
        	<ul class="tabs_items">
				<li class="<?= is_cur_page($this, 'members','index') ? 'ui-state-active' : ''; ?>"><a href="<?= site_url($this->router->reverseRoute('users')); ?>"><? _e('Global'); ?></a></li>
				<li class="<?= is_cur_page($this, 'members','fixes') ? 'ui-state-active' : ''; ?>"><a href="<?= site_url($this->router->reverseRoute('users-fixes')); ?>"><? _e('Fixes'); ?></a></li>
				<li class="<?= is_cur_page($this, 'members','reports') ? 'ui-state-active' : ''; ?>"><a href="<?= site_url($this->router->reverseRoute('users-reports')); ?>"><? _e('Reportes'); ?></a></li>
				<li class="<?= is_cur_page($this, 'members','news') ? 'ui-state-active' : ''; ?>"><a href="<?= site_url($this->router->reverseRoute('users-news')); ?>"><? _e('Descubrimientos'); ?></a></li>
			</ul>
        </section>
		<section class="users_list list profile">
			<? $position=1 + (($page-1)*10);?>
			<? foreach ($users as $user) : ?>
				<article class="user_info clearfix">
					<? if ($position<=3) :?>
						<div class="avatar podium">
							<a href="<?= site_url($this->router->reverseRoute('user-profile', array('username' => $user->username))); ?>"><?=get_avatar( $user, 150); ?></a>
							<div class="position"><?=$position;?></div>
						</div>
					<? else : ?>
						<div class="avatar others">
							<a href="<?= site_url($this->router->reverseRoute('user-profile', array('username' => $user->username))); ?>"><?=get_avatar( $user, 100); ?></a>
							<div class="position"><?=$position;?></div>
						</div>
					<? endif; ?>
						<div class="data">
					  		<h2 class="name"><a href="<?= site_url($this->router->reverseRoute('user-profile', array('username' => $user->username))); ?>"><?= $user->name; ?></a></h2>
					  		<p class="when"><? _e('Mejorando noticias desde el'); ?> <?= date('d/m/Y', $user->created_on); ?></p>
					  		<?= karma_graphic($user->karma); ?>
					  		<p class="counter <?= is_cur_page($this, 'members','fixes') ? 'highlight' : ''; ?>"><? _e('Fixes acumulados'); ?>: <strong><?= $user->fixes_accumulated(); ?></strong></p>
					  		<p class="counter <?= is_cur_page($this, 'members','reports') ? 'highlight' : ''; ?>"><? _e('Reportes enviados'); ?>: <strong><?= count($user->subreports); ?></strong></p>
					  		<p class="counter <?= is_cur_page($this, 'members','news') ? 'highlight' : ''; ?>"><? _e('Descubrimientos'); ?>: <strong><?= count($user->reports); ?></strong></p>

					  </div>
				</article>
			<? $position++; endforeach; ?>
		</section>
		<div class="pagination clearfix"><?=$pagination_links;?></div>
	</div>
	<?php $this->load->view('includes/sidebar'); ?>
</div>
