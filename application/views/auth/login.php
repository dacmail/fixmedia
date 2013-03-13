<div id="container" class="columns create_user sending login clearfix">
  <div id="content">

    <h1 class="title"><? _e('Iniciar sesión'); ?></h1>
    <div class="connect clearfix">
      <span class="tip"><? _e('Con un click'); ?></span>
      <?= form_open(site_url($this->router->reverseRoute('login-provider', array('provider' => 'Facebook'))) , array('class' => 'facebook'), array("prev" => $this->session->userdata('prev_url')));?>
        <input type="submit" class="facebook btn-connect" value="Iniciar con Facebook" />
      <?= form_close();?>
      <?= form_open(site_url($this->router->reverseRoute('login-provider', array('provider' => 'Twitter'))) ,array('class' => 'twitter'), array("prev" => $this->session->userdata('prev_url')));?>
        <input type="submit" class="twitter btn-connect" value="<? _e('Iniciar con Twitter'); ?>" />
      <?= form_close();?>
      <span class="tip bottom"><? _e('o usa el formulario'); ?></span>
    </div>
    <?php echo form_open("auth/login",'', array("prev" => $this->session->userdata('prev_url')));?>
    <? if (!empty($message)) : ?><div id="infoMessage"><?= $message;?></div><? endif;?>
    <p class="row">
      <label for="identity" class="label"><? _e('Usuario'); ?></label>
      <?php echo form_input($identity);?>
    </p>
    <p class="row">
      <label for="password" class="label"><? _e('Contraseña'); ?></label>
      <?php echo form_input($password);?>
    </p>
    <p class="row">
      <?php echo form_checkbox('remember', '1', FALSE, 'id="remember"');?>
      <label for="remember"><? _e('Recuérdame'); ?></label>
    </p>
    <p><?php echo form_submit('submit',  _('Iniciar sesión'), 'class="submit button"');?></p>
    <?php echo form_close();?>

    <p><a href="<?= site_url('auth/forgot_password'); ?>"><? _e('¿Olvidaste tu contraseña?'); ?></a></p>
    <div class="outer_box"> <? printf(_('¿Aún no tienes cuenta? <a href="%s">Regístrate</a>'), site_url($this->router->reverseRoute('register'))); ?> </div>
  </div>
</div>
