<div id="container" class="columns static clearfix">     
	<div id="content">         
		<h1 class="title sep">¿Eres periodista?</h1>         
		<p>Si eres periodista y creas contenido informativo que se difunde online, tanto si trabajas para un medio grande, pequeño o para tí mismo, en Fixmedia muy pronto tendrás nuevas funcionalidades pensadas expresamente para tí.</p>         
		
		<p>Pequeñas cosas que te ayudarán a mejorar tu reputación y credibilidad como profesional de la información.</p>
		<p>Y te las mostraremos en esta página :)</p>

		<p>Síguenos para enterarte cuando esté disponible:</p>
		<p><a href="https://twitter.com/fixmedia_org" class="twitter-follow-button" data-show-count="false" data-lang="es">Seguir a @fixmedia_org</a>
		<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script></p>	


	<p class="nav">Ir a... ‘<a href="<?= site_url($this->router->reverseRoute('statics', array('page' => 'creadores'))); ?>">¿Creas contenido?</a>’ o a la ‘<a href="<?= site_url($this->router->reverseRoute('statics', array('page' => 'como-funciona'))); ?>">FAQ</a>’</p>

	</div>
	<?php $this->load->view('includes/sidebar-static'); ?>
</div>