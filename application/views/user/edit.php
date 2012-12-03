<div id="container" class="clearfix sending editing profile columns">
	<div id="content">
		<h1 class="title sep">Editar perfil			  				<a class="edit_profile_link" href="<?=site_url($this->router->reverseRoute('change_password'));?>">Cambiar contraseña</a>
</h1>

		<?php echo form_open($this->router->reverseRoute('user-save'), array('id' => 'form_report', 'class' => 'clearfix')) ?>
			<div class="fields_wrap open">
				<div class="row wrap_title">
					<label class="label" for="name">Nombre de usuario <span class="tip">Tu nombre de usuario no puede modificarse</span></label>
					<input class="text" type="text" id="" name="username" disabled="disabled" value="<?=htmlspecialchars($user->username);?>" />
				</div>
				<div class="row wrap_title">
					<label class="label" for="name">Nombre para mostrar <span class="tip">Será tu nombre público, puede ser tu nombre y apellidos, nick, etc.</span></label>
					<input class="text" type="text" id="" name="name" value="<?=htmlspecialchars($user->name);?>" />
					<?php echo form_error('name', '<span class="error">', '</span>'); ?>
				</div>
				<div class="row wrap_title">
					<label class="label" for="name">Sobre ti<span class="tip">Puedes escribir una pequeña biografía sobre tí.</span></label>
					<textarea class="textarea" maxlength="300" id="" name="bio"><?=$user->bio;?></textarea>
					<div class="help">
						<span class="charcount">300</span>
					</div>
				</div>
				<div class="row wrap_title">
					<label class="label" for="name">Página web <span class="tip">Escribe la url de tu blog, web, facebook o lo que quieras.</span></label>
					<input class="text" type="text" id="" name="url" value="<?php echo (form_error('url') ? set_value('url') : $user->url); ?>" />
					<?php echo form_error('url', '<span class="error">', '</span>'); ?>
				</div>
				<div class="row wrap_twitter">
					<label class="label" for="name">Twitter <span class="tip">Escribe tu nombre de usuario de twitter.</span></label>
					<span class="prefix">@</span><input class="text wprefix" type="text" id="" name="twitter" value="<?=htmlspecialchars($user->twitter);?>" />
					<?php echo form_error('twitter', '<span class="error">', '</span>'); ?>
				</div>
				<div class="row opt_checkbox">
					<?php echo form_checkbox('allow_mention_twitter', '1', $user->allow_mention_twitter, 'id="allow_mention_twitter"');?>
     				<label for="allow_mention_twitter">Permitir que se me mencione en twitter al compartir mis envíos a Fixmedia</label>
				</div>
			</div>
			<input type="submit" class="button submit" name="submit" value="Guardar los cambios" />
		</form>
		<a href="<?= site_url($this->router->reverseRoute('user-profile', array('username' => $user->username))); ?>" id="cancel" class="cancel">Volver al perfil</a>
	</div>
	<?php $this->load->view('includes/sidebar-user'); ?>
</div>