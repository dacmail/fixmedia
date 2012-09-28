<html>
<body>
	<h1>Reestablecer contraseña para <?php echo $username;?></h1>
	<p>Haz click para <?php echo anchor('auth/reset_password/'. $forgotten_password_code, 'restablecer tu contraseña');?>.</p>
</body>
</html>