<div id="container" class="sending create_user forgot columns login clearfix">
	<div id="content">
		
    <h1 class="title">Recuperar contraseña</h1>

		<div id="infoMessage"><?php echo $message;?></div>

		<?php echo form_open("auth/forgot_password");?>

		      <p class="row">
		      	<label class="label">Nombre de usuario:</label>
		      	<?php echo form_input($email);?>
		      </p>
		      
		      <p><?php echo form_submit('submit', 'Recuperar contraseña', 'class="submit button"');?></p>
		      
		<?php echo form_close();?>


	</div>
</div>
