<html>
<body>
	<h1>Es necesaria la activación de la cuenta <?php echo $identity;?></h1>
	<p>Por favor, haz click en el siguiente enlace  <?php echo anchor('auth/activate/'. $id .'/'. $activation, 'para activar tu cuenta');?>.</p>
</body>
</html>