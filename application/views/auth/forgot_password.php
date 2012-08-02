<div id="container" class="sending login clearfix">
	<div id="content">
		
		<h3>Recuperar contraseña</h3>

		<div id="infoMessage"><?php echo $message;?></div>

		<?php echo form_open("auth/forgot_password");?>

		      <p class="row">
		      	<label class="label">Email:</label>
		      	<?php echo form_input($email);?>
		      </p>
		      
		      <p><?php echo form_submit('submit', 'Recuperar contraseña', 'class="submit button"');?></p>
		      
		<?php echo form_close();?>


	</div>
</div>
