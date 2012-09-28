<aside id="sidebar">
	<section class="likes">
		<a href="https://twitter.com/fixmedia_org" class="twitter-follow-button" data-show-count="false" data-lang="es">Seguir a @fixmedia_org</a>
		<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>

		<div class="fb-like" data-href="http://www.facebook.com/Fixmedia" data-send="false" data-layout="button_count" data-width="150" data-show-faces="false"></div>
	</section>
	<section class="message">
		<p><a href="http://fixmedia.org/estaticas/como-funciona">¿Cómo se usa Fixmedia?</a></p>
		<p><a href="http://www.fixmedia.org/blog/2012/09/25/bienvenidos-a-fixmedia/">En nuestro blog: "Bienvenidos a Fixmedia"</a></p>
	</section>
	<? if (isset($sites_most_fixes)) :?>
	<section class="block ranking">
		<h3 class="title">Fuentes con más fixes</h3>
		<? $pos=0; ?>
		<? foreach ($sites_most_fixes as $site) :?>
			<?$pos++;?>
			<div class="row clearfix">
				<span class="pos"><?=$pos?></span> <span class="site"><a href="<?= site_url($this->router->reverseRoute('source-profile', array('sitename' => $site->site))); ?>"><?= $site->site; ?></a></span> <span class="votes"><?= $site->votes; ?></span>
			</div>
		<? endforeach; ?>
	</section>
	<? endif; ?>
	<? if (isset($sites_most_reported)) :?>
	<section class="block ranking">
		<h3 class="title">Fuentes con más reportes</h3>
		<? $pos=0; ?>
		<? foreach ($sites_most_reported as $site) :?>
			<?$pos++;?>
			<div class="row clearfix">
				<span class="pos"><?=$pos?></span> <span class="site"><a href="<?= site_url($this->router->reverseRoute('source-profile', array('sitename' => $site->site))); ?>"><?= $site->site; ?></a></span> <span class="votes"><?= $site->reports; ?></span>
			</div>
		<? endforeach; ?>
	</section>
	<? endif; ?>
	<? $this->load->view('includes/mini-faqs'); ?>
</aside>