<!DOCTYPE html>
<html lang="es">
<head>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/styles-fixit.css" />
    <script type="text/javascript" src="<?php echo base_url(); ?>js/jquery-1.7.2.min.js"></script>
</head>
<body>
	<? if (isset($report) && $logged_in) : ?>
		<?php echo form_open(site_url(array('services/fix_vote',$report->id)), array('target' => '_blank', 'class' => 'fix_vote')) ?>
	<? else : ?>
		<?php echo form_open($this->router->reverseRoute('reports-create'), array('target' => '_blank', 'method' => 'get')) ?>
	<? endif; ?>
		<input type="hidden" value="<?= $url ?>" name="url" />
		<input class="submit button <?= $style; ?> <?= $voted ? 'voted' : ''; ?>" type="submit" name="submit" value="<?=$text?>" />
		<? if (isset($votes)) : ?>
			<span class="votes"><i></i><u></u><?=$votes?></span>
		<? endif; ?>
	</form>
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