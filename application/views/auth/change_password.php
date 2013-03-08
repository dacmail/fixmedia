<div id="container" class="sending login clearfix">
  <div id="content">

    <h1 class="title sep"><? _e('Cambiar contraseña'); ?></h1>
<? if (!empty($message)) : ?><div id="infoMessage"><?= $message;?></div><? endif;?>

<?php echo form_open("auth/change_password");?>

      <p><label class="label"><? _e('Contraseña actual'); ?>:</label>
      <?php echo form_input($old_password);?>
      </p>

      <p><label class="label"><? printf( _('Nueva contraseña (al menos %s caracteres)'), $min_password_length); ?></label>
      <?php echo form_input($new_password);?>
      </p>

      <p><label class="label"><? _e('Confirmar contraseña'); ?>:</label>
      <?php echo form_input($new_password_confirm);?>
      </p>

      <?php echo form_input($user_id);?>
      <p><?php echo form_submit('submit',  _('Cambiar contraseña'), 'class="submit button"');?></p>

<?php echo form_close();?>
</div>
</div>
