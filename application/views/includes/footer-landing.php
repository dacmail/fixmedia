<footer id="footer">
	<section class="logos-footer <?= is_cur_page($this, 'auth','create_user') ? 'create_user' : ''; ?> <?= is_cur_page($this, 'auth','forgot_password') ? 'forgot' : ''; ?>">
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