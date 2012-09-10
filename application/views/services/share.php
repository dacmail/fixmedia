<!DOCTYPE html>
<html lang="es">
<head>
	<script type="text/javascript" src="<?php echo base_url(); ?>js/jquery-1.7.2.min.js"></script>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/styles.css" />
</head>
<body>
	<div class="popup">
		<h1 class="title"><?=$title?></h1>
		<p class="text"><?=$content?></p>
		<div class="share-wrap clearfix">
			<a class="icon fb" target="_blank" href="http://www.facebook.com/sharer/sharer.php?u=<?=$url?>">Compartir en Facebook</a>
			<a class="icon tw" target="_blank" href="https://twitter.com/intent/tweet?original_referer=<?=$url?>&text=Mira esta noticia en fixmedia.org&url=<?=$url?>&via=fixmedia_org">Compartir en Twitter</a>
			<a class="icon gp" target="_blank" href="https://plus.google.com/share?url=<?=$url?>">Compartir en Google+</a>
		</div>

	</div>
</body>
</html>