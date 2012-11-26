<div id="container" class="columns static clearfix">
	<div id="content">
		<h1 class="title">¿Qué es Fixmedia?</h1>
		<p class="sub_title sep">Fixmedia es una herramienta que nos permite mejorar las noticias entre todos, pidiendo que alguien las arregle (FIX), ampliando la información o corrigiendo la existente.</p>
		<p>A través de Fixmedia podrás -con dos clics- reportar errores y aportar ampliaciones a las noticias de cualquier sitio online. También podrás valorar las aportaciones de otros usuarios y contrastar diferentes fuentes y opiniones.</p>
		<iframe width="640" height="360" src="http://www.youtube.com/embed/Jt6wBkVCczo?rel=0" frameborder="0" allowfullscreen></iframe>
		<p><strong><a href="http://www.fixmedia.org/estaticas/como-funciona">¿Cómo usar Fixmedia?  Es muy fácil, descúbrelo aquí.</a></strong></p>
	<p class="nav">Ir a... ‘<a href="<?= site_url($this->router->reverseRoute('statics', array('page' => 'como-funciona'))); ?>">Cómo funciona</a>’ o a la ‘<a href="<?= site_url($this->router->reverseRoute('statics', array('page' => 'como-funciona'))); ?>">FAQ</a>’</p>

	</div>
	<?php $this->load->view('includes/sidebar-static'); ?>
</div>