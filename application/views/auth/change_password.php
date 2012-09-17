<div id="container" class="sending login clearfix">
  <div id="content">

    <h1 class="title sep">Cambiar contraseña</h1>
<div id="infoMessage"><?php echo $message;?></div>

<?php echo form_open("auth/change_password");?>

      <p><label class="label">Contraseña antigua:</label>
      <?php echo form_input($old_password);?>
      </p>
      
      <p><label class="label">Nueva contraseña (al menos <?php echo $min_password_length;?> caracteres)</label>
      <?php echo form_input($new_password);?>
      </p>
      
      <p><label class="label">Confirmar contraseña:</label>
      <?php echo form_input($new_password_confirm);?>
      </p>
      
      <?php echo form_input($user_id);?>
      <p><?php echo form_submit('submit', 'Cambiar contraseña', 'class="submit button"');?></p>
      
<?php echo form_close();?>
</div>
</div>
