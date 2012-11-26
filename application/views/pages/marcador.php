<div id="container" class="columns static clearfix">
	<div id="content">
		<h1 class="title sep">Usa nuestro marcador</h1>
		<p>Estamos trabajando para ofrecerte una manera mucho más sencilla (todavía) de usar Fixmedia: un simple botoncito que, arrastrado a la barra de marcadores de tu navegador, desencadene todo el poder de Fixmedia sin necesidad de acudir a la web.</p>
		<p>¿Algo que mejorar en la noticia? Sin salir de la pantalla que estás leyendo, un clic y listo.</p>

		<p>Síguenos para enterarte cuando esté disponible:</p>
		<p><a href="https://twitter.com/fixmedia_org" class="twitter-follow-button" data-show-count="false" data-lang="es">Seguir a @fixmedia_org</a>
		<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script></p>	
		<p class="nav">Ir a... ‘<a href="<?= site_url($this->router->reverseRoute('statics', array('page' => 'equipo'))); ?>">Equipo</a>’ o a la ‘<a href="<?= site_url($this->router->reverseRoute('statics', array('page' => 'como-funciona'))); ?>">FAQ</a>’</p>

	</div>
	<?php $this->load->view('includes/sidebar-static'); ?>
</div>