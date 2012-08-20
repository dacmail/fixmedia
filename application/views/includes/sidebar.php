<aside id="sidebar">
	<section class="likes">
		<a href="https://twitter.com/fixmedia_org" class="twitter-follow-button" data-show-count="false" data-lang="es">Seguir a @fixmedia_org</a>
		<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>

		<div class="fb-like" data-href="http://fixmedia.org" data-send="false" data-layout="button_count" data-width="150" data-show-faces="false"></div>
	</section>
	<section class="block ranking">
		<h3 class="title">Fuentes con más fixes</h3>
		<? foreach ($sites_most_fixes as $site) :?>
			<div class="row clearfix">
				<span class="pos">1</span> <span class="site"><?= $site->site; ?></span> <span class="votes"><?= $site->votes; ?></span>
			</div>
		<? endforeach; ?> 
	</section>
	<section class="block ranking">
		<h3 class="title">Fuentes con más reportes</h3>
		<? foreach ($sites_most_reported as $site) :?>
			<div class="row clearfix">
				<span class="pos">1</span> <span class="site"><?= $site->site; ?></span> <span class="votes"><?= $site->reports; ?></span>
			</div>
		<? endforeach; ?> 
	</section>
	<section class="block">
		<h3 class="title">¿Qué es fixmedia.org?</h3>
		<div class="text">
			<p>Fixmedia es una herramienta que nos permite mejorar las noticias entre todos, pidiendo que alguien las arregle añadiendo más y mejor información o corrigiendo la existente. ¡Haz “Fix” para sumarte a una petición de mejora o reporta tú mismo la tuya!</p>
		</div>
	</section>
	<section class="block">
		<h3 class="title">¿Cómo funciona?</h3>
		<div class="text">
			<p>Lees una noticia en cualquier sitio online y te indignas porque contiene errores, miente o falta información. Acudes a Fixmedia o abres nuestro marcador, haces ‘Fix’ a esa noticia y lo das a conocer a tus contactos para que también hagan ‘Fix’. Cuántos más ‘Fix’ logre tu noticia, más probable será que alguien se anime a arreglarla. Quizá hasta el propio autor :) También, si sabes cómo mejorar esa noticia, puedes hacerlo tú mismo, y pedir a tus contactos que valoren positivamente tu reporte. </p>
		</div>
	</section>
	<section class="block">
		<h3 class="title">¿Por qué?</h3>
		<div class="text">
			<p>Fixmedia pretende aportar su granito de arena a la idea de una ciudadanía consciente y activa. Las noticias son las unidades básicas de la agenda pública, aquella que conforma la opinión pública, que a su vez es la voz ciudadana en democracia. Creemos que es necesario un control de calidad sobre dichas noticias ejercido por los propios interesados: cualquiera.</p>
		</div>
	</section>
	<section class="block">
		<h3 class="title">¿Quiénes?</h3>
		<div class="text">
			<p>Fixmedia la conforman los usuarios de la herramienta: quienes hacen ‘Fix’, quienes reportan, quienes valoran los reportes. También cada uno de los <a href="http://www.goteo.org/project/fixmedia.org-mejora-las-noticias/supporters" target="_blank">170 cofinanciadores</a> del proyecto, las decenas de personas que nos ayudaron y el equipo de <a href="http://nxtmdia.com" target="_blank">Nxtmdia</a>.</p>
		</div>
	</section>
</aside>