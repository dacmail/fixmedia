<div id="container" class="sending create_user forgot columns login clearfix">
	<div id="content">
    	<h1 class="title">Recuperar contraseña</h1>
		<?php echo form_open("auth/forgot_password");?>
			<? if (!empty($message)) : ?><div id="infoMessage"><?= $message;?></div><? endif;?>
		      <p class="row">
		      	<label class="label">Correo electrónico:</label>
		      	<?php echo form_input($email);?>
		      </p>
		      <p><?php echo form_submit('submit', 'Recuperar contraseña', 'class="submit button"');?></p>
		<?php echo form_close();?>
		<div class="outer_box">Volver al <a href="<?= site_url($this->router->reverseRoute('login')); ?>">Inicio de sesión</a></div>
	</div>
</div>
