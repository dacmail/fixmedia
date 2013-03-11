<div id="container" class="clearfix sending editing profile columns">
	<div id="content">
		<h1 class="title sep"><? _e('Editar perfil'); ?>			  				<a class="edit_profile_link" href="<?=site_url($this->router->reverseRoute('change_password'));?>"><? _e('Cambiar contraseña'); ?></a>
</h1>

		<?php echo form_open($this->router->reverseRoute('user-save'), array('id' => 'form_report', 'class' => 'clearfix')) ?>
			<div class="fields_wrap open">
				<div class="row wrap_title">
					<label class="label" for="name"><? _e('Nombre de usuario'); ?> <span class="tip"><? _e('Tu nombre de usuario no puede modificarse'); ?></span></label>
					<input class="text" type="text" id="" name="username" disabled="disabled" value="<?=htmlspecialchars($user->username);?>" />
				</div>
				<div class="row wrap_title">
					<label class="label" for="name"><? _e('Nombre para mostrar'); ?> <span class="tip"><? _e('Será tu nombre público, puede ser tu nombre y apellidos, nick, etc.'); ?></span></label>
					<input class="text" type="text" id="" name="name" value="<?=htmlspecialchars($user->name);?>" />
					<?php echo form_error('name', '<span class="error">', '</span>'); ?>
				</div>
				<div class="row wrap_title">
					<label class="label" for="name"><? _e('Sobre ti'); ?><span class="tip"><? _e('Puedes escribir una pequeña biografía sobre tí.'); ?></span></label>
					<textarea class="textarea" maxlength="300" id="" name="bio"><?=$user->bio;?></textarea>
					<div class="help">
						<span class="charcount">300</span>
					</div>
				</div>
				<div class="row wrap_title">
					<label class="label" for="name"><? _e('Página web'); ?> <span class="tip"><? _e('Escribe la url de tu blog, web, facebook o lo que quieras.'); ?></span></label>
					<input class="text" type="text" id="" name="url" value="<?php echo (form_error('url') ? set_value('url') : $user->url); ?>" />
					<?php echo form_error('url', '<span class="error">', '</span>'); ?>
				</div>
				<div class="row wrap_twitter">
					<label class="label" for="name"><? _e('Twitter'); ?> <span class="tip"><? _e('Escribe tu nombre de usuario de twitter.'); ?></span></label>
					<span class="prefix">@</span><input class="text wprefix" type="text" id="" name="twitter" value="<?=htmlspecialchars($user->twitter);?>" />
					<?php echo form_error('twitter', '<span class="error">', '</span>'); ?>
				</div>
				<div class="row opt_checkbox">
					<?php echo form_checkbox('allow_mention_twitter', '1', $user->allow_mention_twitter, 'id="allow_mention_twitter"');?>
     				<label for="allow_mention_twitter"><? _e('Permitir que se me mencione en twitter al compartir mis envíos a Fixmedia'); ?></label>
				</div>
				<div class="row wrap_title">
					<label class="label" for="notifications"><? _e('Notificaciones'); ?> <span class="tip"><? _e('Selecciona cuándo quieres recibir notificaciones en tu correo electrónico'); ?></span></label>
					<?= form_dropdown('notifications', array(0 =>  _('No recibir notificaciones en el correo'), 1=>  _('Cuando se produzca la acción'), 2 =>  _('Una vez a día')), $user->notifications, 'class=select');?>
					<?= form_error('notifications', '<span class="error">', '</span>'); ?>
				</div>
				<div class="row wrap_type_info">
					<label class="label" for="notifications_types"><? _e('Tipos de notificaciones'); ?> <span class="tip"><? _e('Elige qué tipos de notificaciones quieres recibir en tu correo'); ?></span></label>
					<p class="notification_option clearfix"><input type="checkbox" id="fix" name="notifications_types[FIX]"  value="1"  <?= ($ntypes['FIX']) ? 'checked' : '' ?> /><label for="fix"><? _e('Cuando alguien hace FIX a una noticia enviada por mí'); ?></label></p>
					<p class="notification_option clearfix"><input type="checkbox" id="report" name="notifications_types[REPORT]"  value="1"  <?= ($ntypes['REPORT']) ? 'checked' : '' ?>  /><label for="report"><? _e('Cuando alguien envía un REPORTE a una noticia enviada por mí<'); ?>/label></p>
					<p class="notification_option clearfix"><input type="checkbox" id="vote" name="notifications_types[VOTE]"  value="1"  <?= ($ntypes['VOTE']) ? 'checked' : '' ?>  /><label for="vote"><? _e('Cuando alguien VALORA un reporte enviado por mí'); ?></label></p>
					<p class="notification_option clearfix"><input type="checkbox" id="solved" name="notifications_types[SOLVED]"  value="1"  <?= ($ntypes['SOLVED']) ? 'checked' : '' ?>  /><label for="solved"><? _e('Cuando alguien dice que un reporte envíado por mí está CORREGIDO en la noticia'); ?></label></p>
				</div>
			</div>
			<input type="submit" class="button submit" name="submit" value="<? _e('Guardar los cambios'); ?>" />
		</form>
		<a href="<?= site_url($this->router->reverseRoute('user-profile', array('username' => $user->username))); ?>" id="cancel" class="cancel"><? _e('Volver al perfil'); ?></a>
	</div>
	<?php $this->load->view('includes/sidebar-user'); ?>
</div>