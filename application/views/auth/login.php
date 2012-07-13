<div id="container">
  <div id="content">

  	<h3 class="pageTitle">Login</h3>
      <div class="pageTitleBorder"></div>
  	
  	
  	<div id="infoMessage"><?php echo $message;?></div>
  	
      <?php echo form_open("auth/login",'', array("prev" => $this->session->userdata('prev_url')));?>
      	
        <p>
        	<label for="identity">Username:</label>
        	<?php echo form_input($identity);?>
        </p>
        
        <p>
        	<label for="password">Password:</label>
        	<?php echo form_input($password);?>
        </p>
        
        <p>
  	      <label for="remember">Remember Me:</label>
  	      <?php echo form_checkbox('remember', '1', FALSE, 'id="remember"');?>
  	  </p>
        
        
        <p><?php echo form_submit('submit', 'Login');?></p>

        
      <?php echo form_close();?>

      <p><a href="forgot_password">Forgot your password?</a></p>

  </div>
</div>
