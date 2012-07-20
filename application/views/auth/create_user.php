<div id="container" class="sending login clearfix">
  <div id="content">

    <h1 class="title">Regístrate</h1>
	
	<div id="infoMessage"><?php echo $message;?></div>
	
    <?php echo form_open("auth/create_user");?>
      
      <p><label class="label">Usuario:</label>
      <?php echo form_input($username);?>
      </p>
      
      <p><label class="label">Email:</label>
      <?php echo form_input($email);?>
      </p>
      
      <p><label class="label">Contraseña:</label>
      <?php echo form_input($password);?>
      </p>
      
      <p><label class="label">Confirma contraseña:</label>
      <?php echo form_input($password_confirm);?>
      </p>
      
      
      <p><?php echo form_submit('submit', 'Create User', 'class="submit button"');?></p>

      
    <?php echo form_close();?>

  </div>
</div>
