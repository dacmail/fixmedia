<h1><? echo $page_title; ?></h1>
<div class="validation_errors">
	<?php echo validation_errors(); ?>
</div>
<?php 
	echo form_open('users/do_login'); //$this->router->reverseRoute('reports-send')
	echo form_label('Username', 'username');
	echo form_input(array('name'=>'username','maxlength'=>'100','size'=>'20','class'=>'','id'=>'username'));
	echo form_label('Password', 'password');
	echo form_password(array('name'=>'password','size'=>'20','class'=>'','id'=>'password'));
	echo form_label('Remember me!', 'remember');
	echo form_checkbox(array('name'=>'remember','value'=>'remember','checked'=>FALSE));
	echo form_submit(array('name'=>'submit','value'=>'Entrar','class'=>''));
	echo form_close();
?>
</form>