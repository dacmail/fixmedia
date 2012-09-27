<div id="container" class="columns static clearfix">
	<div id="content">
		<h1 class="title">¿Qué es Fixmedia?</h1>
		<p class="sub_title sep">Fixmedia es una herramienta que nos permite mejorar las noticias entre todos, pidiendo que alguien las arregle añadiendo más y mejor información o corrigiendo la existente.</p>
		<iframe width="640" height="360" src="http://www.youtube.com/embed/Jt6wBkVCczo?rel=0" frameborder="0" allowfullscreen></iframe>
		<p>A través de Fixmedia cualquier persona puede -con dos clics- reportar errores y aportar ampliaciones a las noticias de cualquier sitio online. Todo con una herramienta común, independiente, neutra y meritocrática, donde la comunidad de personas interesadas en mejorar las noticias podrán valorar la idoneidad (o no) de las correcciones y ampliaciones aportadas.</p>
		<h2 class="toggle">Un par de ejemplos</h2>
		<div class="wrap-title sep"><p>¿Que un medio de comunicación no atiende a los comentarios de la noticia en los que los lectores avisan de errores u ocultación de hechos en el texto? Se reporta en Fixmedia y queda clasificado y abierto al debate. ¿Que un blog publica un post sobre un tema que conocemos muy bien y consideramos que podríamos ampliar la información, pero el autor no permite comentarios o decide no publicar el nuestro? Lo hacemos a través de Fixmedia.</p></div>
		<h2 class="toggle">Las personas</h2>
		<div class="wrap-title sep"><p>Las personas que participan haciendo ‘fixes’, reportando errores, aportando ampliaciones, valorándolas y difundiendo todo ello ven cómo su dedicación se ve recompensada públicamente en su hoja de servicios a la comunidad, reflejada en su perfil de usuario en forma de listado y de gráficos estadísticos. </p></div>
		<h2 class="toggle">Los medios</h2>
		<div class="wrap-title sep">
			<p>Los medios o las fuentes de dónde proceden las noticias también tienen su perfil en Fixmedia. En él se recopilan todos los ‘fixes’ y reportes recibidos, y nos permite saber qué medios son los más ‘arreglados’ cada semana. Más adelante, además, los periodistas podrán asignarse a sus medios y validar públicamente los reportes de errores y ampliaciones que reciban, aumentando así su reputación y la de su medio.</p>
		</div>
		<h2 class="toggle">Inspiración</h2>
		<div class="wrap-title sep"><p>Fixmedia no es una idea nueva. Nos hemos inspirado en Mediabugs.org, un proyecto también non-profit nacido en Estados Unidos hace ya unos años. Nuestra motivación era darle una vuelta técnica (sobre todo en usabilidad y UX) y de concepto a este proyecto para lograr el mismo objetivo que tenía aquél: mejorar las noticias y democratizar la agenda pública.</p></div>

	<p>El objetivo de Fixmedia es ser un primer paso decisivo en la mejora del periodismo a través de la inteligencia colectiva. </p>

	<p class="nav">Ir a... ‘<a href="<?= site_url($this->router->reverseRoute('statics', array('page' => 'como-funciona'))); ?>">Cómo funciona</a>’ o a la ‘<a href="<?= site_url($this->router->reverseRoute('statics', array('page' => 'como-funciona'))); ?>">FAQ</a>’</p>

	</div>
	<?php $this->load->view('includes/sidebar-static'); ?>
</div>