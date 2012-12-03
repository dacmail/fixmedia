<div id="container" class="columns static clearfix">     
	<div id="content">         
		<h1 class="title sep">¿Creas contenido?</h1>         
		<p>Quizá no te consideres a tí mismo como periodista, pero puede que el contenido que creas y difundes online sea tan importante como el que más en la configuración de la agenda pública.</p>         
		
		<p>Muy pronto, en este apartado, te mostraremos algunas formas en las que Fixmedia puede ayudarte a aportar valor a tu contenido a través de la inteligencia colectiva de miles de personas con espíritu crítico y constructivo.</p>

		<p>Síguenos para enterarte cuando esté disponible:</p>
		<p><a href="https://twitter.com/fixmedia_org" class="twitter-follow-button" data-show-count="false" data-lang="es">Seguir a @fixmedia_org</a>
		<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script></p>	


	<p class="nav">Ir a... ‘<a href="<?= site_url($this->router->reverseRoute('statics', array('page' => 'periodistas'))); ?>">¿Eres periodista?</a>’ o a la ‘<a href="<?= site_url($this->router->reverseRoute('statics', array('page' => 'como-funciona'))); ?>">FAQ</a>’</p>

	</div>
	<?php $this->load->view('includes/sidebar-static'); ?>
</div>