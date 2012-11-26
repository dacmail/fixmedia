<div id="container" class="clearfix columns">
	<div id="content">
		<h1 class="title"><?=$title?></h1>
		<p class="sub_title sep"><?=$subtitle?></p>
		<section class="users_list">
			<? foreach ($users as $user) : ?>
				<p><?= $user->name; ?></p>
			<? endforeach; ?>
		</section>
		<div class="pagination clearfix"><?=$pagination_links;?></div>
	</div>
	<?php $this->load->view('includes/sidebar'); ?>
</div>