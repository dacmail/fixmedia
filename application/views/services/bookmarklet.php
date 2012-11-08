<!DOCTYPE html>
<html lang="es">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/styles-fixit.css" />
    <script type="text/javascript" src="<?php echo base_url(); ?>js/jquery-1.7.2.min.js"></script>
</head>
<body>
	<div class="bookmarklet clearfix">
		<? if (isset($votes) && $votes>0) : ?>
			<? if ($voted) : ?>
			<h3>¡Ya has hecho fix a esta noticia!</h3>
			<? else :?>
			<h3>Esta noticia ya está en Fixmedia, <strong>¿quieres hacer fix?</strong></h3>
			<? endif; ?>
		<? else : ?>
			<h3>Esta noticia no está en Fixmedia, <strong>¿quieres hacer fix y ser su descubridor?</strong></h3>
		<? endif; ?>
		<? if (isset($report) && $logged_in) : ?>
			<?php echo form_open(site_url(array('services/fix_vote',$report->id)), array('target' => '_blank', 'class' => 'fix_vote clearfix')) ?>
		<? else : ?>
			<?php echo form_open($this->router->reverseRoute('reports-create'), array('target' => '_blank', 'method' => 'get')) ?>
		<? endif; ?>
			<input type="hidden" value="<?= $url ?>" name="url" />
			<input class="submit button <?= $voted ? 'voted' : ''; ?>" type="submit" name="submit" value="FIX" />
			<? if (isset($votes)) : ?>
				<span class="votes"><i></i><u></u><?=$votes?></span>
			<? endif; ?>
		</form>
		<? if (isset($votes) && $votes>0) : ?>
			<p class="actions"><a class="view" href="<?= site_url($this->router->reverseRoute('reports-view', array('slug' => $report->slug))); ?>" target="_blank">ver la noticia en fixmedia</a>
			<a class="report" target="blank" href="<?= site_url($this->router->reverseRoute('reports-send' , array('id' => $report->id))); ?>">arréglala tu mismo</a></p>
		<? endif; ?>
	</div>
</body>
</html>

<script type="text/javascript">
	$(document).ready(function() {
		if ($('.fix_vote').length>0) {
			$('.fix_vote').submit(function(e) {
				link = $(this);
				$.ajax({
					url: $(this).attr('action'),
					dataType: 'json'
				}).done(function ( data ) {
					if (data.valid) {
						$('.votes').html('<i></i><u></u>' + data.total_votes);
						$('.submit').addClass('voted');
					} else {
						alert(data.error);
					}
				});
				e.preventDefault();
			});
		}
	});
</script>