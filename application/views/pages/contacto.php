<div id="container" class="columns static clearfix">
	<div id="content">
		<h1 class="title">Contacto</h1>
		<p class="sub_title sep">Si tienes cualquier cosa que comentarnos, puedes escribirnos a: <a href="mailto:comunidad@fixmedia.org">comunidad@fixmedia.org</a></p>
		<p>A través de Fixmedia cualquier persona puede -con dos clics- reportar errores y aportar ampliaciones a las noticias de cualquier sitio online. Todo con una herramienta común, independiente, neutra y meritocrática, donde la comunidad de personas interesadas en mejorar las noticias podrán valorar la idoneidad (o no) de las correcciones y ampliaciones aportadas.</p>
		<p>Fixmedia es un proyecto de la empresa social <a href="http://nxtmdia.com">Nxtmdia</a>.</p>
		
		<p class="nav">Ir a... ‘<a href="<?= site_url($this->router->reverseRoute('statics', array('page' => 'equipo'))); ?>">Equipo</a>’ o a la ‘<a href="<?= site_url($this->router->reverseRoute('statics', array('page' => 'como-funciona'))); ?>">FAQ</a>’</p>

	</div>
	<?php $this->load->view('includes/sidebar-static'); ?>
</div>