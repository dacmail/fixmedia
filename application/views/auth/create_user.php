<div id="container" class="columns create_user sending login clearfix">
  <div id="content">
    <h1 class="title">Regístrate</h1>
    <div class="connect clearfix">
      <span class="tip">Con un click</span>
      <?= form_open(site_url($this->router->reverseRoute('login-provider', array('provider' => 'Facebook'))) , array('class' => 'facebook'), array("prev" => $this->session->userdata('prev_url')));?>
        <input type="submit" class="facebook btn-connect" value="Iniciar con Facebook" />
      <?= form_close();?>
      <?= form_open(site_url($this->router->reverseRoute('login-provider', array('provider' => 'Twitter'))) ,array('class' => 'twitter'), array("prev" => $this->session->userdata('prev_url')));?>
        <input type="submit" class="twitter btn-connect" value="Iniciar con Twitter" />
      <?= form_close();?>
      <span class="tip bottom">o usa el formulario</span>
    </div>
    <?php echo form_open("auth/create_user");?>
      <? if (!empty($message)) : ?><div id="infoMessage"><?= $message;?></div><? endif;?>
      <p><label class="label">Usuario:</label>
        <?php echo form_input($username);?>
      </p>
      <p><label class="label">Email:</label>
        <?php echo form_input($email);?>
      </p>
      <p><label class="label">Contraseña:</label>
        <?php echo form_input($password);?>
      </p>
      <p><?php echo form_submit('submit', 'Registrarse', 'class="submit button"');?></p>
    <?php echo form_close();?>
    <div class="outer_box">¿Ya tienes cuenta? <a href="<?= site_url($this->router->reverseRoute('login')); ?>">Inicia sesión</a></div>
  </div>
</div>
