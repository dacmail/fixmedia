<!DOCTYPE html>
<html lang="es">
<head>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/styles-fixit.css" />
</head>
<body>
	<?php echo form_open($this->router->reverseRoute('reports-create'), array('target' => '_blank')) ?>
		<input type="hidden" value="<?= $url ?>" name="url" />
		<input class="submit button <?= $style; ?>" type="submit" name="submit" value="<?=$text?>" /> 
	</form>
</body>
</html>