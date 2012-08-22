<div id="container" class="clearfix profile columns">
	<div id="content">
		<section class="user_info clearfix">
			  <?=gravatar( $user->email, 150 )?>
			  <div class="data">
			  		<h1 class="name"><?= $user->username; ?></h1>
			  		<p class="when">Mejorando noticias desde el <?= date('d/m/Y', $user->created_on); ?></p>
			  		<p class="bio">Nunc vel turpis, vut habitasse enim rhoncus nec ridiculus duis purus amet, duis dapibus enim, elementum scelerisque ac? Porta? Magnis? Vut a nisi adipiscing eros quis odio! Lorem odio penatibus, sit!</p>
			 		<p class="url">Web: <a href="#">http://google.com/</a></p>
			 		<p class="follow">
			 			<a href="https://twitter.com/<?=$user->username;?>" class="twitter-follow-button" data-show-count="false" data-lang="es">Seguir a @<?=$user->username;?></a>
		<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
			 		</p>
			  </div>
		</section>
		<section class="tabs">
			<ul class="tabs_items">
				<li><a href="#stats">Estadísticas</a></li>
				<li><a href="#fixes">Noticias mejoradas por <?= $user->username; ?></a></li>
			</ul>
			<div id="stats">
				<p>Proin elit arcu, rutrum commodo, vehicula tempus, commodo a, risus. Curabitur nec arcu. Donec sollicitudin mi sit amet mauris. Nam elementum quam ullamcorper ante. Etiam aliquet massa et lorem. Mauris dapibus lacus auctor risus. Aenean tempor ullamcorper leo. Vivamus sed magna quis ligula eleifend adipiscing. Duis orci. Aliquam sodales tortor vitae ipsum. Aliquam nulla. Duis aliquam molestie erat. Ut et mauris vel pede varius sollicitudin. Sed ut dolor nec orci tincidunt interdum. Phasellus ipsum. Nunc tristique tempus lectus.</p>
			</div>
			<div id="fixes">
				<p>Morbi tincidunt, dui sit amet facilisis feugiat, odio metus gravida ante, ut pharetra massa metus id nunc. Duis scelerisque molestie turpis. Sed fringilla, massa eget luctus malesuada, metus eros molestie lectus, ut tempus eros massa ut dolor. Aenean aliquet fringilla sem. Suspendisse sed ligula in ligula suscipit aliquam. Praesent in eros vestibulum mi adipiscing adipiscing. Morbi facilisis. Curabitur ornare consequat nunc. Aenean vel metus. Ut posuere viverra nulla. Aliquam erat volutpat. Pellentesque convallis. Maecenas feugiat, tellus pellentesque pretium posuere, felis lorem euismod felis, eu ornare leo nisi vel felis. Mauris consectetur tortor et purus.</p>
			</div>
		</section>
	</div>
	<?php $this->load->view('includes/sidebar-user'); ?>
</div>