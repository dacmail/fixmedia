<footer id="footer">
	<section class="main-footer">
		<div class="wrap clearfix">
			<div class="block">
				<p class="logo">Fixmedia.org</p>
				<p>fixmedia.org es un proyecto de <a href="http://nxtmdia.com" target="_blank">NXTMDIA</a> para el procomún financiado a través de <a href="http://goteo.org" target="_blank">Goteo.org</a> por <a href="http://www.goteo.org/project/fixmedia.org-mejora-las-noticias/supporters" target="_blank">estas personas.</a></p>
			</div>

			<nav class="clearfix menus">
				<ul class="menu">
					<li class="name">Menú</li>
					<li><a href="<?= site_url(); ?>">Portada</a></li>
					<li><a href="<?= site_url(); ?>">Más urgentes</a></li>
					<li><a href="<?= site_url($this->router->reverseRoute('home-pending')); ?>">Pendientes</a></li>
					<li><a href="<?= site_url($this->router->reverseRoute('home-recents')); ?>">Recientes</a></li>
					<li><a href="<?= site_url($this->router->reverseRoute('users')); ?>">Top usuarios</a></li>
					<li><a href="<?= site_url($this->router->reverseRoute('sources')); ?>">Top fuentes</a></li>
					<li><a href="<?= site_url($this->router->reverseRoute('stats')); ?>">Estadísticas</a></li>
				</ul>
				<ul class="menu">
					<li class="name">Social</li>
					<li><a href="<?= site_url(); ?>">Registro</a></li>
					<li><a href="<?= site_url(); ?>">Entrar</a></li>
					<li><a href="<?= site_url($this->router->reverseRoute('statics', array('page' => 'marcador'))); ?>">Usa nuestro marcador</a></li>
					<li><a href="<?= site_url($this->router->reverseRoute('statics', array('page' => 'periodistas'))); ?>">¿Eres periodista?</a></li>
					<li><a href="<?= site_url($this->router->reverseRoute('statics', array('page' => 'creadores'))); ?>">¿Creas contenido?</a></li>
				</ul>
				<ul class="menu">
					<li class="name">Manual</li>
					<li><a href="<?= site_url($this->router->reverseRoute('statics', array('page' => 'que-es-fixmedia'))); ?>">Qué es fixmedia</a></li>
					<li><a href="<?= site_url($this->router->reverseRoute('statics', array('page' => 'como-funciona'))); ?>">Cómo funciona</a></li>
					<li><a href="<?= site_url($this->router->reverseRoute('statics', array('page' => 'que-queremos-conseguir'))); ?>">Qué queremos conseguir</a></li>
					<li><a href="<?= site_url($this->router->reverseRoute('statics', array('page' => 'equipo'))); ?>">Equipo</a></li>
					<li><a href="<?= site_url($this->router->reverseRoute('statics', array('page' => 'cofinanciadores'))); ?>">Cofinanciadores</a></li>
					<li><a href="<?= site_url($this->router->reverseRoute('statics', array('page' => 'faq'))); ?>">FAQ</a></li>
					<li><a href="<?= site_url($this->router->reverseRoute('statics', array('page' => 'contacto'))); ?>">Contacto</a></li>
					<li><a href="<?= site_url($this->router->reverseRoute('statics', array('page' => 'aviso-legal'))); ?>">Legal</a></li>

				</ul>
			</nav>
		</div>
	</section>
	<section class="logos-footer">
		<div class="wrap clearfix">
			<div class="develop">
				<h3 class="title">Desarrollado por:</h3>
				<a href="http://nxtmdia.com"><img alt="Nxtmdia" src="<?= base_url('images/logos/logo-nxtmdia.jpg'); ?>"/></a>
			</div>
			<div class="cofin">
				<h3 class="title">Cofinanciadores destacados:</h3>
				<a href="http://agitalo.es/"><img alt="Agitalo 3.0" src="<?= base_url('images/logos/logo-agitalo.jpg'); ?>"/></a>
				<a href="http://formadepie.org/"><img alt="Forma de pie" src="<?= base_url('images/logos/logo-formadepie.jpg'); ?>"/></a>
				<a href="http://www.irekia.euskadi.net/"><img alt="Irekia" src="<?= base_url('images/logos/logo-irekia.jpg'); ?>"/></a>
				<a href="http://linkatu.net/"><img alt="Linkatu" src="<?= base_url('images/logos/logo-linkatu.jpg'); ?>"/></a>
			</div>
		</div>
		<p class="server">Alojado en un servidor estable gracias a <a href="http://comvive.es">Comvive</a></p>
	</section>

</footer>
<script type="text/javascript">
  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-30564782-1']);
  _gaq.push(['_trackPageview']);
  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();
</script>
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/es_ES/all.js#xfbml=1";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
	</body>
</html>