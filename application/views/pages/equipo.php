<div id="container" class="columns static clearfix">     
	<div id="content">         
		<h1 class="title">Equipo</h1>         
		<p class="sub_title sep">Fixmedia es un proyecto pensado y desarrollado por el equipo de <a href="http://nxtmdia.com">Nxtmdia</a>, formado por:</p>         
		<h2>Daniel Aguilar</h2>
		<p>Tecnología. En Fixmedia ha sido el responsable de todo el proceso de programación (¡desde 0!) y maquetación. Por si fuera poco no le ha faltado trabajo en otras áreas como SysAdmin.</p>
		<h2>Rubén Illescas</h2>
		<p>Diseño. En Fixmedia ha sido el pincel que da sentido visual a todo el proyecto. Desde el imagotipo a los colores, distribución y soluciones a cualquier problema de diseño. Fue el primero en ver literalmente Fixmedia (en su cerebro, claro).</p>
		<h2>José A. Gelado</h2>
		<p>Coordinación. En Fixmedia José se ha encargado de mantener el flujo de trabajo al igual que viene haciendo en Nxtmdia. Flexible y ágil, como nuestra forma de trabajar.
		<h2>Nuria López</h2> 
		<p>Periodismo. En Fixmedia Nuria, que ejerce como editora en Bottup.com, ha aportado su conocimiento en edición periodística para diseñar algunas partes críticas del proceso-core de la herramienta, como el formulario de reporte.</p>
		<h2>Olmo Gálvez</h2>
		<p>Commons Marketing. En Fixmedia Olmo ha puesto en práctica su propia teoría y nos ha regalado la posibilidad de ser coherentes con la filosofía del proyecto en algo que salpica tanto como el marketing. La comunidad crece con sus semillas.</p>
		<h2>Pau Llop</h2> 
		<p class="sep">Producto. En Fixmedia Pau ha ideado y prototipado, y ha tratado de coordinar esfuerzos para llegar, al menos, a la primera versión pública de Fixmedia. Sin esos esfuerzos ejercidos por los miembros señalados arriba, aún estaría atascado con el nombre.</p>
		<p>&nbsp;</p>
		<p>Aunque (por desgracia) no forma parte del equipo Nxtmdia, merece mención especial:</p>

		<p><strong>Álvaro Ortiz</strong>. Experiencia por amor al arte. En Fixmedia Álvaro nos ha regalado pragmáticos consejos, tiempo para comidas y largos debates y hasta algún boceto listo para ser diseñado y maquetado (y listo para cambiar de raíz algunos conceptos del proyecto). Sin él Fixmedia existiría igual. Pero peor.</p>
		
		<p><a href="http://nxtmdia.com/">Nxtmdia</a> es una empresa <a href="http://nxtmdia.com/social/">social</a> que financia sus proyectos non-profit como <a href="http://bottup.com">Bottup.com</a> y en parte Fixmedia.org a través de los ingresos que les proporcionan sus trabajos con terceros.</p>

		<p>A las claras: que alquilamos nuestro talento y conocimiento. Si crees que te pueden ser útiles, cerremos el círculo: contratándonos favoreces la existencia de proyectos como estos (y otros muchos de la misma cuerda que nos rondan). <a href="http://nxtmdia.com/contacta/">Aquí nos tienes</a>.</p>

		<p class="nav">Ir a... ‘<a href="<?= site_url($this->router->reverseRoute('statics', array('page' => 'cofinanciadores'))); ?>">Cofinanciadores</a>’ o a la ‘<a href="<?= site_url($this->router->reverseRoute('statics', array('page' => 'como-funciona'))); ?>">FAQ</a>’</p>

	</div>
	<?php $this->load->view('includes/sidebar-static'); ?>
</div>