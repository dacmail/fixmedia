<h1><? echo $page_title; ?></h1>
<div class="validation_errors">
	<?php echo validation_errors(); ?>
</div>
<?php echo form_open('users/do_login'); //$this->router->reverseRoute('reports-send_url') ?>

	<label for="username">Username/Email</label>
	<?php echo form_input(array('name'=>'username','maxlength'=>'100','size'=>'20','class'=>'','id'=>'username')); ?>
	<label for="password">Password</label>
	<?php echo form_password(array('name'=>'password','size'=>'20','class'=>'','id'=>'password')); ?>
	<label for="rememberme">Remember me!</label>
	<?php //echo form_checkbox(array('name'=>'remember_me','value'=>'remember','checked'=>FALSE)); ?>
	<?php echo form_submit(array('name'=>'submit','value'=>'Entrar','class'=>'')); ?>
	
<?php echo form_close(); ?>
</form>