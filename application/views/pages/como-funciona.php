<div id="container" class="columns static clearfix">
	<div id="content">
		<h1 class="title">¿Cómo funciona?</h1>
		<p class="sub_title sep">¡Muy simple! Haz “Fix” para sumarte a una petición de mejora o reporta tú mismo la tuya.</p>
		<p>En breve pondremos aquí un ‘prezi’ explicando cada (simple) paso del funcionamiento de Fixmedia :)</p>
		
	<p class="nav">Ir a... ‘<a href="<?= site_url($this->router->reverseRoute('statics', array('page' => 'que-queremos-conseguir'))); ?>">Qué queremos conseguir</a>’ o a la ‘<a href="<?= site_url($this->router->reverseRoute('statics', array('page' => 'como-funciona'))); ?>">FAQ</a>’</p>

	</div>
	<?php $this->load->view('includes/sidebar-static'); ?>
</div>