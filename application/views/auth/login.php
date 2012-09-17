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
    <div class="clearfix have">
      <h1 class="title">¿Tienes invitación?</h1>
      <p class="sub_title">Si tienes un código de invitación, puedes registrarte en Fixmedia.org.</p>
      <div><a href="<?= site_url($this->router->reverseRoute('register')); ?>" class="button">Regístrate ahora</a></div>
    </div>
    <div class="clearfix want">
      <h1 class="title">¿Quieres una?</h1>
      <p class="sub_title">Si todavía no tienes invitación, síguenos en <a href="http://twitter.com/fixmedia_org">@fixmedia_org</a> y envía un twitt incluyendo #InvitaciónFixmedia en el mensaje.</p>
      <a href="https://twitter.com/intent/tweet?button_hashtag=Invitaci%C3%B3nFixmedia&text=Me%20gustar%C3%ADa%20recibir%20la%20" class="twitter-hashtag-button" data-lang="es" data-size="large" data-related="fixmedia_org">Tweet #Invitaci%C3%B3nFixmedia</a>
      <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
    </div>
    
  </div>
</div>
