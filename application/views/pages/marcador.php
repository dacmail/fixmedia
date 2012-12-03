<div id="container" class="columns static clearfix">
	<div id="content">
		<h1 class="title sep">Usa el marcador Fixmedia</h1>
		<p class="center"><img alt="Hacer fix" src="<?= base_url('static/bookmarklet/bookmarklet-1.png'); ?>"/></p>
		<p>El marcador Fixmedia es un <a href="http://es.wikipedia.org/wiki/Bookmarklet" target="_blank">bookmarklet</a> que te permite arreglar las noticias directamente desde la web donde la estás leyendo, sin necesidad de abrir otra pestaña o ventana para ir a Fixmedia.org a hacer FIX o aportar tu propio reporte.</p>
		<p>Su uso es muy sencillo y no requiere descargas ni instalaciones. Simplemente arrastra el siguiente botón a la barra de marcadores de tu navegador:</p>

		<p><a href="javascript:(function()%7B%20%20_my_script%3Ddocument.createElement(%27SCRIPT%27)%3B%20%20_my_script.type%3D%27text/javascript%27%3B%20%20_my_script.src%3D%27http://fixmedia.org/js/bookmarklet.js%27%3B%20%20document.getElementsByTagName(%27head%27)%5B0%5D.appendChild(_my_script)%3B%7D)()%3B" class="bookmarklet">Hacer FIX</a> <span id="bookmarklet-arrow"></span></p>

		<p>Una vez lo hayas hecho, en la barra de marcadores de tu navegador aparecerá el bookmarklet “Hacer FIX”:</p>

		<p class="center"><img alt="Barra de marcadores" src="<?= base_url('static/bookmarklet/bookmarklet-2.jpg'); ?>"/></p>


		<p>Así, cuando estés leyendo una noticia que creas que debe ser mejorada, podrás hacer FIX directamente haciendo clic en ese marcador. Se te abrirá una ventanita como esta:</p>

		<p class="center"><img alt="Barra de marcadores" src="<?= base_url('static/bookmarklet/bookmarklet-3.jpg'); ?>"/></p>

		<p>Al hacer clic en el botón de FIX, te llevará en otra pestaña a Fixmedia para completar el proceso.</p>

		<p>Si la noticia que estás leyendo ya tiene algún FIX previo, la ventanita te informará de ello:</p>

		<p class="center"><img alt="Barra de marcadores" src="<?= base_url('static/bookmarklet/bookmarklet-4.jpg'); ?>"/></p>
		<p>Como ves, además, te mostrará el número de FIX acumulados y te dará la opción de sumar tu propio FIX (haciendo clic en el botón amarillo), ver la noticia en Fixmedia.org o, incluso, ir directamente a añadir tu propio reporte de mejora.</p>

 		<p>¡Así de fácil!</p>

		<p><strong>Importante</strong>: El marcador de Fixmedia NO guarda ningún tipo de información de tu navegación ni ningún dato personal. Los FIX y reportes que hagas desde tu marcador aparecerán en tu perfil igual que si los hubieras hecho desde Fixmedia.org.</p>

		<p><strong>¿Dudas? ¿Problemas para usar el marcador?</strong> Escríbenos cuando quieras a comunidad(arroba)fixmedia(punto)org</p>

		<p class="nav">Ir a... ‘<a href="<?= site_url($this->router->reverseRoute('statics', array('page' => 'equipo'))); ?>">Equipo</a>’ o a la ‘<a href="<?= site_url($this->router->reverseRoute('statics', array('page' => 'como-funciona'))); ?>">FAQ</a>’</p>

	</div>
	<?php $this->load->view('includes/sidebar-static'); ?>
</div>