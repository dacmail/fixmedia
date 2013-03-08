<div id="container" class="sending create_user forgot columns login clearfix">
	<div id="content">
    	<h1 class="title"><? _e('Recuperar contraseña'); ?></h1>
		<?php echo form_open("auth/forgot_password");?>
			<? if (!empty($message)) : ?><div id="infoMessage"><?= $message;?></div><? endif;?>
		      <p class="row">
		      	<label class="label"><? _e('Correo electrónico'); ?>:</label>
		      	<?php echo form_input($email);?>
		      </p>
		      <p><?php echo form_submit('submit',  _('Recuperar contraseña'), 'class="submit button"');?></p>
		<?php echo form_close();?>
		<div class="outer_box"> <? printf(_('Volver al <a href="%s">Inicio de sesión</a>'), site_url($this->router->reverseRoute('login'))) ?></div>
	</div>
</div>
