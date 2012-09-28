<div id="container" class="sending create_user forgot columns login clearfix">
  <div id="content">

    <h1 class="title">Cambiar contraseña</h1>
	<? if (!empty($message)) : ?><div id="infoMessage"><?= $message;?></div><? endif;?>

<?php echo form_open('auth/reset_password/' . $code);?>

      <p class="row"><label class="label">Nueva contraseña:</label>
      <?php echo form_input($new_password);?>
      </p>

      <p class="row"><label class="label">Repite nueva contraseña:</label>
      <?php echo form_input($new_password_confirm);?>
      </p>

      <?php echo form_input($user_id);?>
      <?php echo form_hidden($csrf); ?>
      <p><?php echo form_submit('submit', 'Cambiar contraseña', 'class="submit button"');?></p>

<?php echo form_close();?>
</div>
</div>
