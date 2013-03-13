<div id="container" class="sending create_user forgot columns login clearfix">
	<div id="content">
    	<h1 class="title"><? _e('Completa tu registro'); ?></h1>
		<?php echo form_open("member/save_email");?>
			<? if (!empty($message)) : ?><div id="infoMessage"><?= $message;?></div><? endif;?>
		      <p class="row">
		      	<label class="label"><? _e('Correo electrónico'); ?>:</label>
		      	<?php echo form_input(array(
								'name' => 'email',
								'id' => 'email',
								'class' => 'text'
								));?>
		      </p>
		      <p><?php echo form_submit('submit',  _('Terminar registro'), 'class="submit button"');?></p>
		<?php echo form_close();?>
	</div>
</div>