<div id="container" class="columns create_user sending login clearfix">
  <div id="content">

    <h1 class="title">Iniciar sesión</h1>
    <?php echo form_open("auth/login",'', array("prev" => $this->session->userdata('prev_url')));?>
    <? if (!empty($message)) : ?><div id="infoMessage"><?= $message;?></div><? endif;?>
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
    <div class="outer_box">¿Aún no tienes cuenta? <a href="<?= site_url($this->router->reverseRoute('register')); ?>">Regístrate</a></div>
  </div>
</div>
