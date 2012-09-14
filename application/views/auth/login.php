<div id="container" class="columns sending login clearfix">
  <div id="content">

    <h1 class="title">Iniciar sesión</h1>
  	
  	
  	<div id="infoMessage"><?php echo $message;?></div>
  	
      <?php echo form_open("auth/login",'', array("prev" => $this->session->userdata('prev_url')));?>
      	
        <p class="row">
        	<label for="identity" class="label">Usuario</label>
        	<?php echo form_input($identity);?>
        </p>
        
        <p class="row">
        	<label for="password" class="label">Contraseña</label>
        	<?php echo form_input($password);?>
        </p>
        
        <p class="row">
  	      <?php echo form_checkbox('remember', '1', FALSE, 'id="remember"');?>
          <label for="remember">Recuérdame</label>
        </p>
        
        
      <p><?php echo form_submit('submit', 'Iniciar sesión', 'class="submit button"');?></p>

        
      <?php echo form_close();?>

      <p><a href="<?= site_url('auth/forgot_password'); ?>">¿Olvidaste tu contraseña?</a></p>

  </div>
  <div class="reg_column">
    <h1 class="title">¿Tienes invitación?</h1>
    <p class="sub_title">Si tienes un código de invitación, puedes registrarte en Fixmedia.org.</p>
    <div><a href="<?= site_url($this->router->reverseRoute('register')); ?>" class="button">Regístrate ahora</a></div>
    <h1 class="title">¿Quieres una?</h1>
    <p class="sub_title">Si quieres un código de invitación para probar Fixmedia.org, déjanos tu email</p>

  </div>
</div>
