<div id="container" class="clearfix columns">
	<div id="content">
		<section class="user_info clearfix">
			  <?=gravatar( $the_user->email, 150 )?>
			  <div class="data">
			  		<h1 class="name"><?= $user->username; ?></h1>
			  		<p class="when">Mejorando noticias desde el <?= date('d/m/Y', $user->created_on); ?></p>
			  		<p class="bio">Nunc vel turpis, vut habitasse enim rhoncus nec ridiculus duis purus amet, duis dapibus enim, elementum scelerisque ac? Porta? Magnis? Vut a nisi adipiscing eros quis odio! Lorem odio penatibus, sit!</p>
			 		<p class="url">Web: <a href="#">http://google.com/</a></p>
			  </div>
			  
		</section>
		
	</div>
	<?php $this->load->view('includes/sidebar-user'); ?>
</div>