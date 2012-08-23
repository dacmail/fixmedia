<div id="container" class="clearfix sending editing columns">
	<div id="content">
		<h1 class="title sep">Editar perfil</h1>

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
					<label class="label" for="name">Sobre tí<span class="tip">Puedes escribir una pequeña biografía sobre tí.</span></label>
					<textarea class="textarea" maxlength="350" id="" name="bio"><?=$user->bio;?> </textarea>
				</div>
				<div class="row wrap_title">
					<label class="label" for="name">Página web <span class="tip">Escribe la url de tu blog, web, twitter o lo que quieras.</span></label>
					<input class="text" type="text" id="" name="url" value="<?php echo (form_error('url') ? set_value('url') : $user->url); ?>" />
					<?php echo form_error('url', '<span class="error">', '</span>'); ?>
				</div>
				<div class="row wrap_title">
					<label class="label" for="name">Twitter <span class="tip">Escribe tu nombre de usuario de twitter.</span></label>
					<input class="text" type="text" id="" name="twitter" value="<?=htmlspecialchars($user->twitter);?>" />
					<?php echo form_error('twitter', '<span class="error">', '</span>'); ?>
				</div>
			</div>
			<input type="submit" class="button submit" name="submit" value="Guardar los cambios" /> 
		</form>
	</div>
	<?php $this->load->view('includes/sidebar-user'); ?>
</div>